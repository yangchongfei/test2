<?php

namespace app\admin\controller;
use think\Db;

class Demo extends Base
{
    /**
     * [sms  发送短信]
     * @author [忘尘]
     * @return mixed|\think\response\Json
     */
    public function sms(){
        if(request()->isAjax()){
            $param = input('param.');
            $mobile = $param['mobile'];     //手机号
            $tplCode = $param['tplcode'];   //模板ID
            $tplParam = $param['code'];//验证码
            $msgStatus = demo_sendsms($mobile,$tplCode,$tplParam);

            writelog('发送号码信息--'.$mobile);

            return json(['code' => $msgStatus['Code'], 'msg' => $msgStatus['Message']]);
        }
        return $this->fetch();      
    }


    /**
     * [getMobileAddress  根据手机号码获取地址]
     * @author [忘尘]
     * @param string $mobile
     * @return array
     */
    public function getMobileAddress($mobile='')
    {
        if(request()->isPost())
        {
            if(strlen(trim($mobile)) !=11 || !isMobile($mobile))
                exception('请输入正确的手机号码！');

            $map['phone'] = ['eq',substr($mobile,0,7)];
            $data = '';
            $data = Db::name('phone_address')->where($map)->find();

            if(empty($data))
            {
                $data = get_mobile_address($mobile);
                $data['service_provider']=$data['catName'];
            }

            $data['mobile'] = $mobile;
            writelog('查询号码信息--'.$mobile);

            return admin_json(1,'',$data);
        }

        return $this->fetch('getMobileAddress');
    }
}