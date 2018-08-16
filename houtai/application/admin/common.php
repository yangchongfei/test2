<?php
use think\Db;

/**
 * 将字符解析成数组
 * @param $str
 */
function parseParams($str)
{
    $arrParams = [];
    parse_str(html_entity_decode(urldecode($str)), $arrParams);
    return $arrParams;
}


/**
 * 子孙树 用于菜单整理
 * @param $param
 * @param int $pid
 */
function subTree($param, $pid = 0)
{
    static $res = [];
    foreach($param as $key=>$vo){

        if( $pid == $vo['pid'] ){
            $res[] = $vo;
            subTree($param, $vo['id']);
        }
    }

    return $res;
}


/**
 * 记录日志
 * @param  [type] $uid         [用户id]
 * @param  [type] $username    [用户名]
 * @param  [type] $description [描述]
 * @param  [type] $status      [状态]
 * @return [type]              [description]
 * @return [type] $type        0正确  -1错误日志
 */
function writelog($description,$type=0)
{
    $data['admin_id'] = session('uid') ? session('uid') : '';
    $data['admin_name'] = session('username') ? session('username') : '';
    $data['description'] = $description;
    $data['status'] = $type<0 ? -1: 1;
    $data['ip'] = request()->ip();
    $data['create_time'] = time();
    Db::name('log_admin')->insert($data);
}


/**
 * 整理菜单树方法
 * @param $param
 * @return array
 */
    function prepareMenu($param)
    {
    $parent = []; //父类
    $child = [];  //子类

    foreach($param as $key=>$vo){
        if($vo['pid'] == 0){
            $vo['href'] = '#';
            $parent[] = $vo; //一级菜单
        }else{
            $vo['href'] = url($vo['name']); //跳转地址
            $child[] = $vo; //一级菜单
        }
    }

    //从每一级菜单找到相应的二级菜单
    foreach($parent as $key=>$vo){
        foreach($child as $k=>$v){
            if($v['pid'] == $vo['id']){
                $parent[$key]['child'][] = $v;
            }
        }
    }

    unset($child);

    return $parent;
}


/**
 * 格式化字节大小
 * @param  number $size      字节数
 * @param  string $delimiter 数字和单位分隔符
 * @return string            格式化后的带单位的大小
 */
function format_bytes($size, $delimiter = '') {
    $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
    for ($i = 0; $size >= 1024 && $i < 5; $i++) {
        $size /= 1024;
    }
    return $size . $delimiter . $units[$i];
}


/**
 * 后台通用化数据输出
 * @param int $status 业务状态码
 * @param string $message 信息提示
 * @param [] $data  数据
 * @return array
 */
function admin_json($code, $msg, $data= [], $url = '', $wait = 3) {
    $join = [
        'code' => $code,
        'msg' => $msg,
        'data' => $data,
        'url' => $url,
        'wait' => $wait
    ];
    return json($join);
}