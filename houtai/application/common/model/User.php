<?php
/**
 * Created by PhpStorm.
 * User: baidu
 * Date: 17/7/27
 * Time: 下午5:57
 */
namespace app\common\model;


class User extends Base {

    /**
     * [getUserByCondition  根据搜索条件获取用户列表信息]
     * @author [忘尘]
     * @param $map
     * @param $from
     * @param $size
     * @return array
     */
    public function getUserByCondition($map, $from=0, $size = 5)
    {
        $order = ['u.id' => 'desc'];

        $join = [
            ['think_group g','g.id = u.group_id'],
        ];

        $result = $this->alias('u')
            ->field('u.*,g.group_name')
            ->join($join)
            ->where($map)
            ->limit($from, $size)
            ->order($order)
            ->select();

        return $result;
    }

    /**
     * [getUserCountByCondition  满足搜索条件的总条数]
     * @author [忘尘]
     * @param $map
     * @return int|string
     */
    public function getUserCountByCondition($map = [])
    {
        return $this->where($map)->count();
    }

    /**
     * 插入信息
     */
    public function insertMember($param)
    {
        try{
            $result = $this->validate('MemberValidate')->allowField(true)->save($param);
            if(false === $result){
                return ['code' => -1, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' => '', 'msg' => '添加成功'];
            }
        }catch( PDOException $e){
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    /**
     * 编辑信息
     * @param $param
     */
    public function editMember($param)
    {
        try{
            $result =  $this->allowField(true)->save($param, ['id' => $param['id']]);
            if(false === $result){
                return ['code' => 0, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' => '', 'msg' => '编辑成功'];
            }
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }


    /**
     * 根据管理员id获取角色信息
     * @param $id
     */
    public function getOneMember($id)
    {
        return $this->where('id', $id)->find();
    }


    /**
     * 删除管理员
     * @param $id
     */
    public function delUser($id)
    {
        try{

            $this->where('id', $id)->delete();
            Db::name('auth_group_access')->where('uid', $id)->delete();
            return ['code' => 1, 'data' => '', 'msg' => '删除成功'];

        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }


    public function delMember($id)
    {
        try{
            $map['status']=-1;
            $this->save($map, ['id' => $id]);
            return ['code' => 1, 'data' => '', 'msg' => '删除成功'];
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }


    /**
     *
     * @param array $userIds
     */
    public function getUsersUserId($userIds = []) {
        $data = [
            'id' => ['in', implode(',', $userIds)],// in
            'status' => 1,
        ];

        $order = [
            'id' => 'desc',
        ];
        return $this->where($data)
            ->field(['id', 'username', 'image'])
            ->order($order)
            ->select();
    }


    /**
     * [login  登陆]
     * @author [忘尘]
     * @param $username
     * @param $password
     * @return array
     */
    public function login($username,$password,$url)
    {
        if (!$username || !$password) {
            return array('status' => -1, 'msg' => '请填写账号或密码');
        }
        $user = $this->where("account", $username)->whereOr('mobile', $username)->find();
        if (!$user)
            $result = array('status' => -2, 'msg' => '账号不存在!');
        elseif (check_user_password($password) != $user['password'])
            $result = array('status' => -3, 'msg' => '密码错误!');
        elseif ($user['status'] != 1)
            $result = array('status' => -4, 'msg' => '账号异常已被锁定或待审核！！！');
        else
            $result = array('status' => 1, 'msg' => '登陆成功', 'result' => $user,'url'=>$url);

        //增加访问数
        $result['status']==1 && $this->addVisitorNum($username) && home_log($username.'登录！');
        return $result;
    }


    /**
     * [checkRegister  检查注册]
     * @author [忘尘]
     * @param $username
     * @return array|bool
     */
    public function checkRegister($username,$password,$url,$codeStr){
        if(check_mobile($username))
        {
            $mobile = $this->field('id')->where('account',$username)->whereOr('mobile',$username)-> find();
            if($mobile)
                return array('status' => -1, 'msg' => '该帐号已被注册！');
        }
        elseif(check_email($username))
        {
            $email = $this->field('id')->where('account',$username)-> find();
            if($email)
                return array('status' => -2, 'msg' => '该帐号已被注册！');
        }
        else
        {
            return array('status' => -3, 'msg' => '请输入正确手机或邮箱注册！');
        }

        if(strlen($password)<8)
            return array('status' => -2, 'msg' => '密码长度小于8!');

        if(empty($codeStr))
            return array('status' => -3, 'msg' => '验证码不能为空!');

        //验证code
        $code = cookie('code');

        if(!$code || ($codeStr != session('code')))
            return array('status' => -4, 'msg' => '验证码错误!');

        return true;
    }

    /**
     * [register  注册]
     * @author [忘尘]
     * @param $username
     * @param $password
     * @param $url
     * @return mixed
     */
    public function register($username,$password,$url,$codeStr='')
    {
        $check = $this->checkRegister($username,$password,$url,$codeStr);
        if($check !== true)
            return $check;

        $arr = [
            'account' => $username,
            'password' => check_user_password($password),
            'create_time' => time(),
            'status' => config('home.user_status'),
            'group_id' => config('home.register_user_groupid'),
        ];

        $id = $this->save($arr);
        cookie('code', null);
        //增加访问数
        home_log('新用户注册'.$username);
        $result = array('status' => 1, 'msg' => '注册成功', 'result' => $id,'url'=>$url);

        return $result;
    }


    /**
     * [addVisitorNum  增加访问数]
     * @author [忘尘]
     * @param $username
     * @return int|true
     * @throws \think\Exception
     */
    public function addVisitorNum($username)
    {
        return $this->where('account','=',$username)->setInc('login_num');
    }
}