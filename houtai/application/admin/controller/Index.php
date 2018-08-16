<?php

namespace app\admin\controller;
use think\Config;
use think\Loader;
use think\Db;

class Index extends Base
{
    /**
     * [index  主页]
     * @author [忘尘]
     * @return mixed
     */
    public function index()
    {
        return $this->fetch('/index');
    }


    /**
     * [indexPage 后台首页]
     * @return [type] [description]
     * @author [忘尘]
     */
    public function indexPage()
    {
         //今日新增会员
        $today = strtotime(date('Y-m-d 00:00:00'));//今天开始日期
        $map['create_time'] = array('egt', $today);
        $newusercount = Db::name('user')->where($map)->count();
        //总会员数
        $usercount = Db::name('user')->count();
        //活跃用户
        $starttime = strtotime(date("Y-m-d",strtotime("-14 day")));
        $activeusercount = Db::name('log_home')->field('click_ip')->distinct(true)->where('click_time','>=',$starttime)->select();
        //访问量
        $viewscount = Db::name('log_home')->field('click_ip')->distinct(false)->where('click_time','>=',$today)->select();

        $info = array(
            'web_server' => $_SERVER['SERVER_SOFTWARE'],
            'onload'     => ini_get('upload_max_filesize'),
            'think_v'    => THINK_VERSION,
            'phpversion' => phpversion(),
        );

        /*************************图表数据处理***************************/
        //日访问数据
        $mStart = strtotime(date('Y-m-01 00:00:00'));
        $viewEveryday = Db::name('log_home')
            ->field("FROM_UNIXTIME(click_time, '%d') as dStr, count(click_ip) as everydayview")
            ->group("FROM_UNIXTIME(click_time, '%Y-%m-%d')")
            ->where('click_time','>=',$mStart)
            ->select();

        $everydayview = array_column($viewEveryday, 'everydayview');
        $dayStr = array_column($viewEveryday, 'dStr');
        $dViewStr = implode(',',$everydayview);//日访问数
        $dStr = implode(',',$dayStr);//天数字符串

        //月访问数据
        $yStart = strtotime(date('Y-01-01 00:00:00'));

        $viewEverymoon = Db::name('log_home')
            ->field("FROM_UNIXTIME(click_time, '\'%b\'') as mStr, count(click_ip) as everyMoonView")
            ->group("FROM_UNIXTIME(click_time, '%Y-%m')")
            ->where('click_time','>=',$yStart)
            ->select();

        $everyMoonview = array_column($viewEverymoon, 'everyMoonView');
        $moonStr = array_column($viewEverymoon, 'mStr');
        $mViewStr = implode(',',$everyMoonview);//日访问数
        $mStr = implode(',',$moonStr);//天数字符串

        writelog('查看后台首页');

        return $this->fetch('index',[
            'newusercount'=> $newusercount,
            'usercount'=> $usercount,
            'viewscount'=> count($viewscount),
            'activeusercount'=> count($activeusercount),
            'info' => $info,
            'dViewStr' => $dViewStr,
            'dStr' => $dStr,
            'mViewStr' => $mViewStr,
            'mStr' => $mStr,
        ]);
    }



    /**
     * [userEdit 修改密码]
     * @return [type] [description]
     * @author [忘尘]
     */
    public function editpwd(){

        if(request()->isAjax()){
            $param = input('post.');

            $user=Db::name('admin_user')->where('id='.session('uid'))->find();

            if(md5(md5($param['old_password']) . config('admin.adminuser_password_halt'))!= $user['password'])
            {
                return admin_json(-1,'旧密码错误');
            }
            else
            {
                $pwd['password']=md5(md5($param['password']) . config('admin.adminuser_password_halt'));//新密码
                Db::name('admin_user')->where('id='.$user['id'])->update($pwd);
                writelog('修改管理员密码--'.session('uid'));

                return admin_json(1,'密码修改成功,请重新登录!','',url('login/loginOut'));
            }
        }
        return $this->fetch();
    }


    /**
     * 清除缓存
     */
    public function clear() {
        if (delete_dir_file(CACHE_PATH) && delete_dir_file(TEMP_PATH)) {
            writelog('清除缓存数据');
            return admin_json(1,'清除缓存成功');
        } else {
            return admin_json(-1,'清除缓存失败');
        }
    }
}
