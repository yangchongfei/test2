<?php
namespace app\common\lib\exception;
use think\exception\Handle;

class ApiHandleException extends Handle
{
    /**
     * http状态码
     * @var int
     */
    public $httpCode = 500;

    /**
     * 系统内部不可预知的错误输出优化
     * [render  重写Handle类中render方法]
     * @author [忘尘]
     * @param Exception $e
     * @return array|\think\Response
     */
    public function render(\Exception $e)
    {
        if(config('app_debug') === true)
            return parent::render($e);//调试模式用TP自带定义的render()
        if($e instanceof ApiException)
            $this->httpCode = $e->httpCode;//获取ApiException类定义的http状态码

        return api_show(0, $e->getMessage(), [], $this->httpCode);
    }
}



