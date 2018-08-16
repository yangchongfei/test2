<?php

namespace app\admin\controller;
use app\common\model\Log as LogModel;
use think\Db;
use com\IpLocation;
 
class Log extends Base
{

    /**
     * [adminLog 后台操作日志]
     * @return [type] [description]
     * @author [忘尘]
     */
    public function adminLog()
    {
        $model = new LogModel();
        $arr=Db::name("admin_user")->column("id,username"); //获取用户列表

        if(request()->isAjax())
        {
            $data = input('param.');
            $map = [];
            //报错信息超管才有权限
            if(session('roleid') != 1)
                $map['status'] = ['gt',0];

            if(is_array($data)){
                if(!empty($data['key']))
                    $map['admin_id'] = ['eq',$data['key']];
            }

            $this->getPageAndSize($data);

            try{
                $count =$model->getAdminLogCountByCondition($map);
                $allpage = intval(ceil($count / $this->size));//总页面
                $lists = $model->getAdminLogByCondition($map, $this->from, $this->size);//列表

                $Ip = new IpLocation('UTFWry.dat'); // 实例化类 参数表示IP地址库文件
                foreach($lists as $k=>$v){
                    $lists[$k]['ipaddr'] = $Ip->getlocation($lists[$k]['ip']);
                    $lists[$k]['ipaddrcountry'] = $lists[$k]['ipaddr']['country'];
                    $lists[$k]['ipaddrarea'] = $lists[$k]['ipaddr']['area'];
                }

            }catch (\Exception $e)
            {
                writelog($e->getMessage(),-1);
                exception($e->getMessage());
            }

            if(empty($lists))
                return '';

            return $this->fetch('ajax_adminlog_list',[
                'count' => $count,//总记录数
                'allpage' => $allpage,
                'lists' => $lists,
                "val"=>$data['key'],
            ]);
        }
        writelog('查看后台日志列表');

        return $this->fetch('adminlog',[
            "search_user"=>$arr,
            "val"=>0,
        ]);
    }


    /**
     * [loghome  前台日志]
     * @author [忘尘]
     * @return array
     */
    public function homelog()
    {
        $log = new LogModel();
        if(request()->isAjax())
        {
            $data = input('param.');
            $map = [];
            if(is_array($data) && !empty($data['key'])){
                $map['do_content|user_id'] = ['like',"%" . $data['key'] . "%"];
            }

            $this->getPageAndSize($data);

            try{
                $count =$log->getHomeLogCountByCondition($map);
                $allpage = intval(ceil($count / $this->size));//总页面
                $lists = $log->getHomeLogByCondition($map, $this->from, $this->size);//列表

                $Ip = new IpLocation('UTFWry.dat'); // 实例化类 参数表示IP地址库文件
                foreach($lists as $k=>$v){
                    $lists[$k]['ipaddr'] = $Ip->getlocation(long2ip($lists[$k]['click_ip']));
                    $lists[$k]['ipaddrcountry'] = $lists[$k]['ipaddr']['country'];
                    $lists[$k]['ipaddrarea'] = $lists[$k]['ipaddr']['area'];
                }
            }catch (\Exception $e)
            {
                writelog($e->getMessage(),-1);

                exception($e->getMessage());
            }

            writelog('查看前台日志列表');

            if(empty($lists))
                return '';

            return $this->fetch('ajax_homelog_list',[
                'count' => $count,//总记录数
                'allpage' => $allpage,
                'lists' => $lists,
                'user' => alluser(),
            ]);
        }
        return $this->fetch();
    }
 
}