<?php

namespace app\common\lib\exception;
use think\Exception;

class ApiException extends Exception
{

    public $message = '';
    public $httpCode = 500;
    public $code = 0;


    /**
     *因为 exception('msg','code') 原函数第二个参数为业务层状态码,非http状态码
     * 内部抛异常定义输出httpCode
     * ApiException constructor.
     * @param string $message
     * @param int $httpCode
     * @param int $code
     */
    public function __construct($message = '', $httpCode = 0, $code = 0)
    {
        $this->httpCode = $httpCode;
        $this->message = $message;
        $this->code = $code;
    }
}