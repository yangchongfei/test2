<?php
/**
 * Created by PhpStorm.
 * User: baidu
 * Date: 17/7/28
 * Time: 上午12:27
 */
namespace app\common\lib;
use app\common\lib\Aes;
use think\Cache;
/**
 * Iauth相关
 * Class IAuth
 */
class IAuth {

    /**
     * 生成每次请求的sign
     * @param array $data
     * @return string
     */
    public static function setSign($data = []) {
        // 1 按字段排序
        ksort($data);
        // 2拼接字符串数据  &
        $string = http_build_query($data);
        // 3通过aes来加密
        $string = (new Aes())->encrypt($string);

        return $string;
    }

    /**
     * 检查sign是否正常
     * @param array $data
     * @param $data
     * @return boolen
     */
    public static function checkSignPass($data) {
        $str = (new Aes())->decrypt($data['sign']);

        if(empty($str)) {
            return false;
        }

        //parse_str()把diid=xx&app_type=android转化成数组并赋值给第2个参数
        parse_str($str, $arr);
        if(!is_array($arr) || empty($arr['did']) || $arr['did'] != $data['did'] || $arr['version'] != $data['version']) {
            return false;
        }

        //应用模式下调用（应用上线调用，开发测试跳过）
        if(config('app_debug') === false)
        {
            //检验有sign是否过期
            //注：客户端和服务端要求时间一致，
            //解决方案：客户端请求服务端api/time/index接口获取服务器时间，客户端根据实际情况 + - 时间值
            if((time()-ceil($arr['time']/1000)) > config('app.app_sign_time'))
            {
                return false;
            }

            //检测sign唯一性
            if(Cache::get($data['sign']))
            {
                return false;
            }
        }

        return true;
    }

    /**
     * 设置登录的token  - 唯一性的
     * @param string $phone
     * @return string
     */
    public  static function setAppLoginToken($phone = '') {
        $str = md5(uniqid(md5(microtime(true)), true));
        $str = sha1($str.$phone);
        return $str;
    }

}