<?php

namespace app\admin\controller;
use app\common\model\Node;
use think\Controller;

class Base extends Controller
{
    /**
     * page当前页码
     * @var string
     */
    public $page = '';
    /**
     * 每页显示多少条
     * @var string
     */
    public $size = '';
    /**
     * 查询条件的起始值
     * @var int
     */
    public $from = 0;


    public function _initialize()
    {
        //判断是否登录
        if($this->isLogin() === false) {
            return $this->redirect('login/index');
        }

        $auth = new \com\Auth();   
        $module     = strtolower(request()->module());
        $controller = strtolower(request()->controller());
        $action     = strtolower(request()->action());
        $url        = $module."/".$controller."/".$action;

        if(session('uid')!=1){
            if(!in_array($url, config('admin.permission_authlist')))
            {
                if(!$auth->check($url,session('uid')))
                {
                    $this->error('抱歉，您没有操作权限!');
                }
            }
        }

        $node = new Node();
        $this->assign([
            'username' => session('username'),  //用户名
            'portrait' => session('portrait'),  //肖像
            'rolename' => session('rolename'),  //角色名
            'menu' => $node->getMenu(session('rule'))   //session('rule')权限列表ID
        ]);


      $config = load_config();
       cache('db_config_data',$config);

        //后台网站设置配置，如：分页列表数
       config($config);

        if(config('web_site_close') == 0 && session('uid') !=1 ){
            $this->error('站点已经关闭，请稍后访问~');
        }

        if(config('admin_allow_ip') && session('uid') !=1 ){          
            if(in_array(request()->ip(),explode('#',config('admin_allow_ip')))){
                $this->error('403:禁止访问');
            }
        }

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
     * [getPageAndSize  获取分页page size 内容]
     * @author []
     * @param $data
     */
    public function getPageAndSize($data) {
        $this->page = !empty($data['page']) ? $data['page'] : 1;
        $this->size = !empty(config('list_rows')) ? config('list_rows') : config('paginate.list_rows');//后台设置显示条数、配置文件显示条数
        $this->from = ($this->page - 1) * $this->size;
    }
}