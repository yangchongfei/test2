<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;


//news
Route::resource('api/:ver/news', 'api/:ver.news');


//短信
Route::post('api/:ver/identify', 'api/:ver.identify/save');



//登录
Route::post('api/:ver/login', 'api/:ver.login/save');


//用户
Route::resource('api/:ver/user', 'api/:ver.user');


//图片上传
Route::resource('api/:ver/image', 'api/:ver.image');