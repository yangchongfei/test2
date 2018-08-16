<?php
/**
 * Created by PhpStorm.
 * User: baidu
 * Date: 17/7/31
 * Time: 上午12:29
 */
namespace app\common\lib;

/**
 * 极光推送封装
 * Class Jpush
 * @package app\common\lib
 */
class Jpush {
    /**
     * 推送信息
     * @param $title
     * @param int $newId
     * @param string $type
     */
    public static function push($title, $newId = 0, $type = 'android') {
        try {
            $client = new \JPush\Client("cd82f4c316f53232010dda5b", "e856ea857842749ceccb7813");
            $client->push()
                ->setPlatform('all')
                ->addAllAudience()
                ->setNotificationAlert($title)
                ->androidNotification($title, array(
                    'title' => $title,
                    // 'builder_id' => 2,
                    'extras' => array(
                        'id' => $newId,
                        //'catid' =>
                    ),
                ))
                ->send();
        }catch(\Exception $e) {
            echo $e->getMessage();// test
            return false;
        }
        return true;
    }
}