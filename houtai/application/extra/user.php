<?php
/**
 * Created by PhpStorm.
 * User: baidu
 * Date: 17/7/28
 * Time: 上午12:29
 */

return [
    'user_password_halt' => 'JUD6FCtZsqrn3O8gAhxbSlH9wfPN',// 密码加密盐

    'aeskey' => 'sg45747ss23455h',//aes 密钥 , 服务端和客户端必须保持一致

    'apptypes' => [
        'ios',
        'android',
    ],

    'app_sign_time' => 10,// sign失效时间
    'app_sign_cache_time' => 20,// sign 缓存失效时间

    'login_time_out_day' => 7,// 登录token的失效时间
];