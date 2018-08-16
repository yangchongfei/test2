<?php

namespace app\admin\controller;
use app\common\model\Config as ConfigModel;
use think\Db;

class Config extends Base
{
    /**
     * [index  获取配置参数]
     * @author [忘尘]
     * @return mixed
     */
    public function index() {
        $configModel = new ConfigModel();
        $list = $configModel->getAllConfig();
        $config = [];
        foreach ($list as $k => $v) {
            $config[trim($v['name'])] = $v['value'];
        }
        //显示时加密
        $config['alisms_appkey'] = md5($config['alisms_appkey']);
        $config['alisms_appsecret'] = md5($config['alisms_appsecret']);
        $config['smtp_pwd'] = md5($config['smtp_pwd']);
        $config['alisms_templatecode'] = md5($config['alisms_templatecode']);

        writelog('查看配置');

        return $this->fetch('',[
            'config'=>$config,
        ]);
    }


    /**
     * [save  批量保存配置]
     * @author [忘尘]
     * @param $config
     */
    public function save($config){
        $configModel = new ConfigModel();
        if($config && is_array($config)){          
            foreach ($config as $name => $value) {
                $map = array('name' => $name);
                $configModel->SaveConfig($map,$value);
            }
        }
        cache('db_config_data',null);
        writelog('修改配置');

        $this->success('保存成功！');
    }


    /**
     * [sendEmail  发送测试邮件]
     * @author [忘尘]
     * @throws \PHPMailer\PHPMailer\Exception
     * @throws \phpmailerException
     */
    public function sendEmail(){
        $email = input('post.test_eamil');
        $res = send_email($email,'后台测试','测试发送验证码:'.mt_rand(10000,99999));
        writelog('发送测试邮件');
        exit(json_encode($res));
    }

}