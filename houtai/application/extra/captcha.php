<?php
/*
 * 验证码配置
 * Created by PhpStorm.
 * User: baidu
 * Date: 17/7/28
 * Time: 上午12:29
 */

return [
   'captcha' =>[
       // 验证码字体大小
       'fontSize'    =>    30,
       // 验证码位数
       'length'      =>    5,
       // 关闭验证码杂点
       'useNoise'    =>    false,
       //是否画混淆曲线
       'useCurve' => false,
       //验证成功后是否重置
       'reset' => true,
   ],
];