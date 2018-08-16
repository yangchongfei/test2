<?php
namespace app\common\lib;

/**
 * 获取13位时间戳
 * Class IAuth
 */
class Time
{
    /**
     * [get13TimeStamp  获取13位时间戳]
     * @author [忘尘]
     * @return int
     */
    public static function get13TimeStamp()
    {
        list($t1, $t2) = explode(' ', microtime());

        //$t1=1515563772   $t2 =0.01694200
        return $t2.ceil($t1*1000);
    }

}