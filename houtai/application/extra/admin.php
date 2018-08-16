<?php
/**
 * Created by PhpStorm.
 * User: baidu
 * User: baidu
 * Date: 17/7/29
 * Time: 下午11:27
 */
return [
    'formal_host' => 'zjty.safeandsound.vip',
    'test_host' => 'zjty-demo.safeandsound.vip',

    /************************************** 验证*************************************************/
    'verify_halt' => 'doK97Kl5ljoebjaJC8kojdg9gid886lkd',

    'admin_title' =>'芙源管理系统',

    /***************************************管理员**********************************************/
    'session_adminuser' => 'adminuser', //保存登录管理员信息session名
    'session_adminuser_scope' => 'wangchen_zjty', //保存登录管理员信息session作用域
    'adminuser_password_halt' => 'JUD6FCtZsqrmVXc2apev4TRn3O8gAhxbSlH9wfPN',    //管理员密码加密盐KEY

    'status_delete' => -1,  //假删除
    'status_normal' => 1,   //正常
    'status_pending' => 0,  //待审核、禁用

    /*************************************跳过权限验证方法列表*****************************************************/
    'permission_authlist' => [
        'admin/index/index',
        'admin/index/indexpage',
        'admin/upload/upload',
        'admin/upload/uploadface',
        'admin/upload/webuploaderimages', //webUploader插件上传图片
    ],
    //文章作者
  //  'writer' => '忘尘',
    //'qrcode_logo' => 'qrcode/logo.png', //二维码logo

   // 'joingroup' => '<a href="https://jq.qq.com/?_wv=1027&k=5x29z1o" style="color: rgb(255, 0, 0); text-decoration: underline;">点击加入群聊获取</a>',
];