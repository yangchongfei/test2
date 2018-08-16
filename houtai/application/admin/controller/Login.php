<?php

namespace app\admin\controller;
use app\common\model\UserType;
use think\Controller;
use think\Db;
use org\Verify;
use com\Geetestlib;

class Login extends Controller
{
    /**
     * [index  登录页面]
     * @author
     * @return mixed|void
     */
    public function index()
    {
        //判断是否登录
        if($this->isLogin()) {
            return $this->redirect('index/index');
        }

        $config = get_config();

        return $this->fetch('/login',[
            'admintitle' => config('admin.admin_title') ? config('admin.admin_title') : '',
            'verify_type'=>$config['login_verify_type'],
            'bgnum' =>rand(1,3),//背景图片id
        ]);
    }


    /**
     * [doLogin  登录操作]
     * @author [忘尘]
     * @return json
     */
    public function doLogin()
    {
        $username = input("param.username");
        $password = input("param.password");

        $config = get_config();

        if ($config['login_verify_type'] == 1) {
            $code = input("param.code");
        }


        //compact()创建一个包含变量名和它们的值的数组：  Array ( [username] => $username [password] => $password )
        $result = $this->validate(compact('username', 'password'), 'AdminUser');
        if(true !== $result){
            return admin_json(-6,$result);
        }

        if ($config['login_verify_type'] == 1) {
            $verify = new Verify();
            $verify->seKey = config('admin.verify_halt'); // 自定义验证码加密密钥

            if (!$code)
                return admin_json(-5,'请输入验证码');

            if (!$verify->check($code))
                return admin_json(-4,'验证码错误');
        }

        $hasUser = Db::name('admin_user')->where('username', $username)->find();

        if(empty($hasUser)){
            return admin_json(-1,'管理员不存在');
        }

        if(md5(md5($password) . config('admin.adminuser_password_halt')) != $hasUser['password']){
            writelog('用户【'.$username.'】登录失败：密码错误',-1);
            return admin_json(-2,'账号或密码错误');
        }

        if($hasUser['status'] != config('code.status_normal')){
            writelog('用户【'.$username.'】登录失败：该账号被禁用',-1);
            return admin_json(-7,'该账号被禁用');
        }

        //获取该管理员的角色信息
        $user = new UserType();
        $info = $user->getRoleInfo($hasUser['groupid']);

        session(config('admin.session_adminuser'), $hasUser, config('admin.session_adminuser_scope'));//session('adminuser')数组形式
        session('uid', $hasUser['id']);         //用户ID
        session('username', $hasUser['username']);  //用户名
        session('portrait', $hasUser['portrait']); //用户头像
        session('rolename', $info['title']);    //角色名
        session('roleid', $hasUser['groupid']);    //角色名
        session('rule', $info['rules']);        //角色节点
        session('name', $info['name']);         //角色权限
  
        //更新管理员状态
        $param = [
            'loginnum' => $hasUser['loginnum'] + 1,
            'last_login_ip' => request()->ip(),
            'last_login_time' => time(),
            'update_time' => time(),
            'token' => md5($hasUser['username'] . $hasUser['password'])
        ];

        Db::name('admin_user')->where('id', $hasUser['id'])->update($param);
        writelog('管理员【'.session('username').'】登录成功');

        //测试环境通知登录
        session('uid') !=1 && send_email('2656682755@qq.com','后台用户登录！','时间:'.date('Y-m-d H:i:s'));

        return admin_json(1,'登录成功','',url('index/index'));
    }


    /**
     * [checkVerify  生成验证码]
     * @author [忘尘]
     */
    public function checkVerify()
    {
        $verify = new Verify();
        $verify->imageH = 32;
        $verify->imageW = 100;
        $verify->length = 4;
        $verify->useNoise = false; //使用中文验证码
        $verify->fontSize = 14;
        return $verify->entry();
    }


    /**
     * [isLogin  判定是否登录]
     * @author [忘尘]
     * @return bool
     */
    public function isLogin() {
        //获取session
        $adminuser = session(config('admin.session_adminuser'), '', config('admin.session_adminuser_scope'));
        if($adminuser && $adminuser['id']) {
            return true;
        }
        return false;
    }


    /**
     * [loginOut  退出登录]
     * @author [忘尘]
     */
    public function loginOut()
    {
        writelog('管理员【'.session('username').'】退出');

        session(null);
        session(null, config('admin.session_adminuser_scope'));//清除登录标识
        cache('db_config_data',null);//清除缓存中网站配置信息
        $this->redirect('login/index');
    }
}