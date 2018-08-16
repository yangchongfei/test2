<?php
use think\Db;
use com\IpLocation;

use Aliyun\Core\Config;
use Aliyun\Core\Profile\DefaultProfile;
use Aliyun\Core\DefaultAcsClient;
use Aliyun\Api\Sms\Request\V20170525\SendSmsRequest;
use Aliyun\Api\Sms\Request\V20170525\QuerySendDetailsRequest;//短信发送记录查询使用

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

header("Content-type: text/html; charset=utf-8");

/**
 * [aliyun_sendsms  阿里云云通信发送短息]
 * @author [忘尘]
 * @param $mobile 接收手机号
 * @param $code 验证码
 * @param string $tplCode   短信模板ID
 * @return array
 */
function aliyun_sendsms($mobile,$code,$tplCode='')
{
    if( empty($mobile))
        return array('msg'=>'缺少参数','code'=>'Error');
    if(!isMobile($mobile))
        return array('msg'=>'无效的手机号','code'=>'Error');

    require_once '../extend/aliyundysmssdk/api_sdk/vendor/autoload.php';

    // 加载区域结点配置
    Config::load();
    //产品名称:云通信流量服务API产品,开发者无需替换
    $product = "Dysmsapi";
    //产品域名,开发者无需替换
    $domain = "dysmsapi.aliyuncs.com";

    //配置文件
    $config = get_config();
    $accessKeyId = $config['alisms_appkey']; // AccessKeyId
    $accessKeySecret = $config['alisms_appsecret']; // AccessKeySecret

    // 暂时不支持多Region
    $region = "cn-hangzhou";
    // 服务结点
    $endPointName = "cn-hangzhou";
    //初始化acsClient,暂不支持region化
    $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);
    // 增加服务结点
    DefaultProfile::addEndpoint($endPointName, $region, $product, $domain);
    // 初始化AcsClient用于发起请求
    $acsClient = new DefaultAcsClient($profile);
    // 初始化SendSmsRequest实例用于设置发送短信的参数
    $request = new SendSmsRequest();
    // 必填，设置短信接收号码
    $request->setPhoneNumbers($mobile);
    // 必填，设置签名名称，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
    $request->setSignName($config['alisms_signname']);

    // 必填，设置模板CODE，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
    $request->setTemplateCode($config['alisms_templatecode']);

    // 可选，设置模板参数, 假如模板中存在变量需要替换则为必填项
    $request->setTemplateParam(json_encode(array(  // 短信模板中字段的值
        "code"=>$code,
        "product"=>"dsd"
    ), JSON_UNESCAPED_UNICODE));

    // 可选，设置流水号
    $request->setOutId("yourOutId");

    // 选填，上行短信扩展码（扩展码字段控制在7位或以下，无特殊需求用户请忽略此字段）
    $request->setSmsUpExtendCode("1234567");

    // 发起访问请求
    $acsResponse = $acsClient->getAcsResponse($request);

    //返回请求结果
    $result = json_decode(json_encode($acsResponse),true);

    return $result;
}

/**
 * [aliyun_sendsms  示例 阿里云云通信发送短息]
 * @author [忘尘]
 * @param $mobile 接收手机号
 * @param $code 验证码
 * @param string $tplCode   短信模板ID
 * @return array
 */
function demo_sendsms($mobile,$tplCode,$code)
{
    if( empty($mobile) || empty($tplCode) )
        return array('msg'=>'缺少参数','code'=>'Error');
    if(!isMobile($mobile))
        return array('msg'=>'无效的手机号','code'=>'Error');

    require_once '../extend/aliyundysmssdk/api_sdk/vendor/autoload.php';

    // 加载区域结点配置
    Config::load();
    //产品名称:云通信流量服务API产品,开发者无需替换
    $product = "Dysmsapi";
    //产品域名,开发者无需替换
    $domain = "dysmsapi.aliyuncs.com";

    //配置文件
    $config = get_config();
    $accessKeyId = $config['alisms_appkey']; // AccessKeyId
    $accessKeySecret = $config['alisms_appsecret']; // AccessKeySecret

    // 暂时不支持多Region
    $region = "cn-hangzhou";
    // 服务结点
    $endPointName = "cn-hangzhou";
    //初始化acsClient,暂不支持region化
    $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);
    // 增加服务结点
    DefaultProfile::addEndpoint($endPointName, $region, $product, $domain);
    // 初始化AcsClient用于发起请求
    $acsClient = new DefaultAcsClient($profile);
    // 初始化SendSmsRequest实例用于设置发送短信的参数
    $request = new SendSmsRequest();
    // 必填，设置短信接收号码
    $request->setPhoneNumbers($mobile);
    // 必填，设置签名名称，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
    $request->setSignName($config['alisms_signname']);

    // 必填，设置模板CODE，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
    $request->setTemplateCode($tplCode ? $tplCode : $config['alisms_templatecode']);

    // 可选，设置模板参数, 假如模板中存在变量需要替换则为必填项
    $request->setTemplateParam(json_encode(array(  // 短信模板中字段的值
        "code"=>$code,
        "product"=>"dsd"
    ), JSON_UNESCAPED_UNICODE));

    // 可选，设置流水号
    $request->setOutId("yourOutId");

    // 选填，上行短信扩展码（扩展码字段控制在7位或以下，无特殊需求用户请忽略此字段）
    $request->setSmsUpExtendCode("1234567");

    // 发起访问请求
    $acsResponse = $acsClient->getAcsResponse($request);

    //返回请求结果
    $result = json_decode(json_encode($acsResponse),true);

    return $result;
}


/**
 * [get_config  获取配置]
 * @author [忘尘]
 * @return array
 */
function get_config(){
    $list = Db::name('config')->select();
    $config = [];
    foreach ($list as $k => $v) {
        $config[trim($v['name'])] = $v['value'];
    }
    return $config;
}

/**
 * 邮件发送
 * @param $to    接收人
 * @param string $subject   邮件标题
 * @param string $content   邮件内容(html模板渲染后的内容)
 * @throws Exception
 * @throws phpmailerException
 *
 * 调用前头部引入
 * use PHPMailer\PHPMailer\PHPMailer;
 * use PHPMailer\PHPMailer\Exception;
 */
function send_email($to,$subject='',$content=''){

    //判断openssl是否开启
    $openssl_funcs = get_extension_funcs('openssl');
    if(!$openssl_funcs){
        return array('status'=>-1 , 'msg'=>'请先开启openssl扩展');
    }
    $mail = new PHPMailer;
    //配置信息
    $config = get_config();
    if(empty($config['smtp_server']) || empty($config['smtp_port']) || empty($config['smtp_user']) || empty($config['smtp_pwd'])){
        return array("error"=>1,"message"=>'邮箱配置不完整');
    }

    $mail->CharSet  = 'UTF-8'; //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
    $mail->isSMTP();
    //Enable SMTP debugging
    // 0 = off (for production use)
    // 1 = client messages
    // 2 = client and server messages
    $mail->SMTPDebug = 0;
    //调试输出格式
    //$mail->Debugoutput = 'html';
    //smtp服务器
    $mail->Host = $config['smtp_server'];
    //端口 - likely to be 25, 465 or 587
    $mail->Port = $config['smtp_port'];

    if($mail->Port == 465) $mail->SMTPSecure = 'ssl';// 使用安全协议
    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;
    //用户名
    $mail->Username = $config['smtp_user'];
    //密码
    $mail->Password = $config['smtp_pwd'];
    //Set who the message is to be sent from
    $mail->setFrom($config['smtp_user']);
    //回复地址
    $mail->addReplyTo($config['smtp_user'], '忘尘');
    //设置抄送人
    //$mail->addCC($config['']);
    //密送者，Mail Header不会显示密送者信息
    //$mail->addBCC($config['']);

    //接收邮件方
    if(is_array($to)){
        foreach ($to as $v){
            $mail->addAddress($v);
        }
    }else{
        $mail->addAddress($to);
    }
    $mail->isHTML(true);// send as HTML
    //标题
    $mail->Subject = $subject;
    //HTML内容转换
    $mail->msgHTML($content);
    //Replace the plain text body with one created manually
    //$mail->AltBody = 'This is a plain-text message body';
    //添加附件 (填绝对路径) 可以设定名字
    //$mail->addAttachment('images/phpmailer_mini.png', 'name.jpg');
    //send the message, check for errors
    try{
        if($mail->send());
            return array('status'=>1 , 'msg'=>'邮件发送成功');
    } catch (Exception $e) {
        return array('status'=>-1 , 'msg'=>'发送失败: '.$mail->ErrorInfo);
    }
}





/**
 * 字符串截取，支持中文和其他编码
 */
function msubstr($str, $start = 0, $length, $charset = "utf-8", $suffix = true) {
	if (function_exists("mb_substr"))
		$slice = mb_substr($str, $start, $length, $charset);
	elseif (function_exists('iconv_substr')) {
		$slice = iconv_substr($str, $start, $length, $charset);
		if (false === $slice) {
			$slice = '';
		}
	} else {
		$re['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
		$re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
		$re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
		$re['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
		preg_match_all($re[$charset], $str, $match);
		$slice = join("", array_slice($match[0], $start, $length));
	}
	return $suffix ? $slice . '...' : $slice;
}



/**
 * 读取配置
 * @return array 
 */
function load_config(){
    $list = Db::name('config')->select();
    $config = [];
    foreach ($list as $k => $v) {
        $config[trim($v['name'])]=$v['value'];
    }

    return $config;
}


/**
* 验证手机号是否正确
* @author honfei
* @param number $mobile
*/
function isMobile($mobile) {
    if (!is_numeric($mobile)) {
        return false;
    }
    return preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $mobile) ? true : false;
}




//生成网址的二维码 返回图片地址
function Qrcode($token, $url, $size = 8){ 
    $md5 = md5($token);
    $dir = date('Ymd'). '/' . substr($md5, 0, 10) . '/';
    $patch = 'qrcode/' . $dir;
    if (!file_exists($patch)){
        mkdir($patch, 0755, true);
    }
    $file = 'qrcode/' . $dir . $md5 . '.png';
    $fileName =  $file;
    if (!file_exists($fileName)) {

        $level = 'L';
        $data = $url;
        QRcode::png($data, $fileName, $level, $size, 2, true);
    }
    return $file;
}



/**
 * 循环删除目录和文件
 * @param string $dir_name
 * @return bool
 */
function delete_dir_file($dir_name) {
    $result = false;
    if(is_dir($dir_name)){
        if ($handle = opendir($dir_name)) {
            while (false !== ($item = readdir($handle))) {
                if ($item != '.' && $item != '..') {
                    if (is_dir($dir_name . DS . $item)) {
                        delete_dir_file($dir_name . DS . $item);
                    } else {
                        unlink($dir_name . DS . $item);
                    }
                }
            }
            closedir($handle);
            if (rmdir($dir_name)) {
                $result = true;
            }
        }
    }

    return $result;
}

/**
 * [make_dir  创建目录]
 * @author [忘尘]
 * @param $path
 * @param int $mode
 * @param bool $recursive
 * @return bool
 */
function make_dir($path , $mode = 0755, $recursive = true)
{
    if(!is_dir($path))
    {
        mkdir($path,$mode,$recursive);
        chmod($path,$mode);
    }
    return true;
}



//时间格式化1
function formatTime($time) {
    $now_time = time();
    $t = $now_time - $time;
    $mon = (int) ($t / (86400 * 30));
    if ($mon >= 1) {
        return '一个月前';
    }
    $day = (int) ($t / 86400);
    if ($day >= 1) {
        return $day . '天前';
    }
    $h = (int) ($t / 3600);
    if ($h >= 1) {
        return $h . '小时前';
    }
    $min = (int) ($t / 60);
    if ($min >= 1) {
        return $min . '分钟前';
    }
    return '刚刚';
}


//时间格式化2
function pincheTime($time) {
     $today  =  strtotime(date('Y-m-d')); //今天零点
      $here   =  (int)(($time - $today)/86400) ; 
      if($here==1){
          return '明天';  
      }
      if($here==2) {
          return '后天';  
      }
      if($here>=3 && $here<7){
          return $here.'天后';  
      }
      if($here>=7 && $here<30){
          return '一周后';  
      }
      if($here>=30 && $here<365){
          return '一个月后';  
      }
      if($here>=365){
          $r = (int)($here/365).'年后'; 
          return   $r;
      }
     return '今天';
}


function getRandomString($len, $chars=null){
    if (is_null($chars)){
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    }  
    mt_srand(10000000*(double)microtime());
    for ($i = 0, $str = '', $lc = strlen($chars)-1; $i < $len; $i++){
        $str .= $chars[mt_rand(0, $lc)];  
    }
    return $str;
}


function random_str($length){
    //生成一个包含 大写英文字母, 小写英文字母, 数字 的数组
    $arr = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));
 
    $str = '';
    $arr_len = count($arr);
    for ($i = 0; $i < $length; $i++)
    {
        $rand = mt_rand(0, $arr_len-1);
        $str.=$arr[$rand];
    }
 
    return $str;
}

/**
 * 通用化API接口数据输出
 * [api_show  ]
 * @author [默默]
 * @param $status 业务状态码
 * @param $message 信息提示
 * @param array $data 数据
 * @param int $httpCode http状态码
 * @return \think\response\Json
 */
function api_show($status, $message, $data=[], $httpCode=200) {

    $jsondata = [
        'status' => $status,
        'msg' => $message,
        'data' => $data,
    ];
    return json($jsondata, $httpCode);
}

/*验证$ip地址函数,真IP返回true,假IP返回false*/
function CheckIsIP($ip){
    return !strcmp(long2ip(sprintf('%u',ip2long($ip))),$ip) ? true : false;
}

/*获得客户端ip地址,调用方法getIP()*/
function getIP() {
    if(getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"),"unknown")) {
        $ip = getenv("HTTP_CLIENT_IP");
    }
    else if(getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"),"unknown")) {
        $ip = getenv("HTTP_X_FORWARDED_FOR");
    }
    else if(getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"),"unknown")) {
        $ip = getenv("REMOTE_ADDR");
    }
    else if(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'],"unknown")) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    else {
        $ip = "unknown";
    }
    return CheckIsIP($ip) ? $ip : "unknown" ;
}

//*************************************字符串处理函数集***********************************
/*utf8中文字串截取函数*/
function strcut($str,$start,$len){
    if($start < 0)
        $start = strlen($str)+$start;
    $retstart = $start+getOfFirstIndex($str,$start);
    $retend = $start + $len -1 + getOfFirstIndex($str,$start + $len);
    return substr($str,$retstart,$retend-$retstart+1);
}
//判断字符开始的位置
function getOfFirstIndex($str,$start){
    $char_aci = ord(substr($str,$start-1,1));
    if(223<$char_aci && $char_aci<240)
        return -1;
    $char_aci = ord(substr($str,$start-2,1));
    if(223<$char_aci && $char_aci<240)
        return -2;
    return 0;
}

/*$num必须为英文字符或数字0-9*/
function getNums($num) {
    return (ctype_alnum($num));
}
/*匹配电子邮件地址*/
function getEmail($email) {
    return strlen($email)>6 && preg_match("/^\w+@(\w+\.)+[com]|[cn]$/" , $email);
}
/*生成email连接*/
function emailconv($email,$tolink=1) {
    $email=str_replace(array('@','.'),array('@','.'),$email);
    return $tolink ? '<a href="mailto: '.$email.'">'.$email.'</a>':$email;
}

/*$char必须为英文字符,全是返回1true，有中文返回0false*/
function getChar($char) {
    return (ctype_alpha($char));
}
/*匹配$QQ(5-12)位,是返回1,否返回0*/
function getQQ($QQ) {
    return preg_match("/^\b[0-9]{5,12}\b/",$QQ);
}
/*检查$str是否为数字,是返回true,否返回false*/
function CheckIsNum($str){
    return ereg("^[0-9]+$",$str) ? true : false;
}


/*容量大小计算函数*/
function sizecount($filesize) {
    if($filesize >= 1073741824) {
        $filesize = round($filesize / 1073741824 * 100) / 100 . ' G'; //round 四舍五入
    } elseif($filesize >= 1048576) {
        $filesize = round($filesize / 1048576 * 100) / 100 . ' M';
    } elseif($filesize >= 1024) {
        $filesize = round($filesize / 1024 * 100) / 100 . ' K';
    } else {
        $filesize = $filesize . ' bytes';
    }
    return $filesize;
}

/**
 * [home_log  前台日志]
 * @author [忘尘]
 * @param array $logdata
 * @return int|string
 * @throws Exception
 */
function home_log($content)
{
   if(empty($content))
       exception('参数不正确');

    $logdata=array(
        'user_id'=> !empty(session('user')) ? session('user.id') : 2,//2为游客标识
        'click_ip' => ip2long(getIP()),
        'os_broswer' => get_os().'--'.get_broswer(),
        'do_content' => $content,
        'click_time' => time()
    );

    $res = Db::name('log_home')->insert($logdata);
    return $res;
}

/**
 * [create_qrcode  生成二维码]
 * @author [忘尘]
 * @param $text 二维码内容
 * @param bool $filename 生成二维码文件名
 * @param bool $logo logo文件名
 * @param bool $show 是否展示
 * @param bool $type 是否返回二维码路径
 * @param string $errorCorrectionLevel 容错级别
 * @param int $matrixPointSize 生成图片大小
 * @return string
 */
function create_qrcode($text,$filename=false,$logo=false,$show=false,$type=false,$errorCorrectionLevel='H',$matrixPointSize=10)
{
    require_once EXTEND_PATH .'phpqrcode/phpqrcode.php';
    if($filename)
        $filename = 'qrcode/'.$filename;

    $object = new \QRcode();
    $object->png($text,$filename, $errorCorrectionLevel, $matrixPointSize, 2);

    !$filename && exit();//直接输出到页面

    if ($logo !== FALSE) {
        $QR = $filename;//已经生成的原始二维码图
        $logo = 'qrcode/'.$logo;
        $QR = imagecreatefromstring(file_get_contents($QR));
        $logo = imagecreatefromstring(file_get_contents($logo));
        $QR_width = imagesx($QR);//二维码图片宽度
        $QR_height = imagesy($QR);//二维码图片高度
        $logo_width = imagesx($logo);//logo图片宽度
        $logo_height = imagesy($logo);//logo图片高度
        $logo_qr_width = $QR_width / 5;
        $scale = $logo_width/$logo_qr_width;
        $logo_qr_height = $logo_height/$scale;
        $from_width = ($QR_width - $logo_qr_width) / 2;
        //重新组合图片并调整大小
        imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
        //输出图片
        imagepng($QR, $filename);
    }

    if($show)
        echo '<img src="/'.$filename.'">';

    if($type)
        return '/'.$filename;
}

/**
 * [is_really_writable  判断文件或目录是否有写的权限]
 * @author [忘尘]
 * @param $file
 * @return bool
 */
function is_really_writable($file)
{
    if (DIRECTORY_SEPARATOR == '/' AND @ ini_get("safe_mode") == FALSE)
    {
        return is_writable($file);
    }
    if (!is_file($file) OR ($fp = @fopen($file, "r+")) === FALSE)
    {
        return FALSE;
    }

    fclose($fp);
    return TRUE;
}


/**
 * [ip_address  根据ip获取地点]
 * @author [忘尘]
 * @param string $ip
 * @return mixed
 */
function ip_address($ip = '')
{
    if(empty($ip))
        $ip = getIP();

    $Ip = new IpLocation('UTFWry.dat'); // 实例化类 参数表示IP地址库文件
    $ipdata = $Ip->getlocation($ip);

    return $ipdata['country'];
}

/**
 * [check_user_password  检查用户密码]
 * @author [忘尘]
 * @param $str
 * @return string
 */
function check_user_password($str){
    return  md5(md5($str) . config('user.user_password_halt'));
}

/**
 * 检查手机号码格式
 * @param $mobile 手机号码
 */
function check_mobile($mobile){
    if(preg_match('/1[34578]\d{9}$/',$mobile))
        return true;
    return false;
}

/**
 * 检查固定电话
 * @param $mobile
 * @return bool
 */
function check_telephone($mobile){
    if(preg_match('/^([0-9]{3,4}-)?[0-9]{7,8}$/',$mobile))
        return true;
    return false;
}

/**
 * 检查邮箱地址格式
 * @param $email 邮箱地址
 */
function check_email($email){
    if(filter_var($email,FILTER_VALIDATE_EMAIL))
        return true;
    return false;
}


/**
 * 获取客户端操作系统信息包括win10
 * @param  null
 * @author  Jea杨
 * @return string
 */
function get_os(){
    $agent = $_SERVER['HTTP_USER_AGENT'];
    $os = false;

    if (preg_match('/win/i', $agent) && strpos($agent, '95'))
    {
        $os = 'Windows 95';
    }
    else if (preg_match('/win 9x/i', $agent) && strpos($agent, '4.90'))
    {
        $os = 'Windows ME';
    }
    else if (preg_match('/win/i', $agent) && preg_match('/98/i', $agent))
    {
        $os = 'Windows 98';
    }
    else if (preg_match('/win/i', $agent) && preg_match('/nt 6.0/i', $agent))
    {
        $os = 'Windows Vista';
    }
    else if (preg_match('/win/i', $agent) && preg_match('/nt 6.1/i', $agent))
    {
        $os = 'Windows 7';
    }
    else if (preg_match('/win/i', $agent) && preg_match('/nt 6.2/i', $agent))
    {
        $os = 'Windows 8';
    }else if(preg_match('/win/i', $agent) && preg_match('/nt 10.0/i', $agent))
    {
        $os = 'Windows 10';#添加win10判断
    }else if (preg_match('/win/i', $agent) && preg_match('/nt 5.1/i', $agent))
    {
        $os = 'Windows XP';
    }
    else if (preg_match('/win/i', $agent) && preg_match('/nt 5/i', $agent))
    {
        $os = 'Windows 2000';
    }
    else if (preg_match('/win/i', $agent) && preg_match('/nt/i', $agent))
    {
        $os = 'Windows NT';
    }
    else if (preg_match('/win/i', $agent) && preg_match('/32/i', $agent))
    {
        $os = 'Windows 32';
    }
    else if (preg_match('/linux/i', $agent))
    {
        $os = 'Linux';
    }
    else if (preg_match('/unix/i', $agent))
    {
        $os = 'Unix';
    }
    else if (preg_match('/sun/i', $agent) && preg_match('/os/i', $agent))
    {
        $os = 'SunOS';
    }
    else if (preg_match('/ibm/i', $agent) && preg_match('/os/i', $agent))
    {
        $os = 'IBM OS/2';
    }
    else if (preg_match('/Mac/i', $agent) && preg_match('/PC/i', $agent))
    {
        $os = 'Macintosh';
    }
    else if (preg_match('/PowerPC/i', $agent))
    {
        $os = 'PowerPC';
    }
    else if (preg_match('/AIX/i', $agent))
    {
        $os = 'AIX';
    }
    else if (preg_match('/HPUX/i', $agent))
    {
        $os = 'HPUX';
    }
    else if (preg_match('/NetBSD/i', $agent))
    {
        $os = 'NetBSD';
    }
    else if (preg_match('/BSD/i', $agent))
    {
        $os = 'BSD';
    }
    else if (preg_match('/OSF1/i', $agent))
    {
        $os = 'OSF1';
    }
    else if (preg_match('/IRIX/i', $agent))
    {
        $os = 'IRIX';
    }
    else if (preg_match('/FreeBSD/i', $agent))
    {
        $os = 'FreeBSD';
    }
    else if (preg_match('/teleport/i', $agent))
    {
        $os = 'teleport';
    }
    else if (preg_match('/flashget/i', $agent))
    {
        $os = 'flashget';
    }
    else if (preg_match('/webzip/i', $agent))
    {
        $os = 'webzip';
    }
    else if (preg_match('/offline/i', $agent))
    {
        $os = 'offline';
    }
    else
    {
        //$os = '未知操作系统';
        $os = get_device_type();
    }
    return $os;
}


/**
 * 获取客户端浏览器信息 添加win10 edge浏览器判断
 * @param  null
 * @author  Jea杨
 * @return string
 */
function get_broswer(){
    $sys = $_SERVER['HTTP_USER_AGENT'];  //获取用户代理字符串
    if (stripos($sys, "Firefox/") > 0) {
        preg_match("/Firefox\/([^;)]+)+/i", $sys, $b);
        $exp[0] = "Firefox";
        $exp[1] = $b[1];  //获取火狐浏览器的版本号
    } elseif (stripos($sys, "Maxthon") > 0) {
        preg_match("/Maxthon\/([\d\.]+)/", $sys, $aoyou);
        $exp[0] = "傲游";
        $exp[1] = $aoyou[1];
    } elseif (stripos($sys, "MSIE") > 0) {
        preg_match("/MSIE\s+([^;)]+)+/i", $sys, $ie);
        $exp[0] = "IE";
        $exp[1] = $ie[1];  //获取IE的版本号
    } elseif (stripos($sys, "OPR") > 0) {
        preg_match("/OPR\/([\d\.]+)/", $sys, $opera);
        $exp[0] = "Opera";
        $exp[1] = $opera[1];
    } elseif(stripos($sys, "Edge") > 0) {
        //win10 Edge浏览器 添加了chrome内核标记 在判断Chrome之前匹配
        preg_match("/Edge\/([\d\.]+)/", $sys, $Edge);
        $exp[0] = "Edge";
        $exp[1] = $Edge[1];
    } elseif (stripos($sys, "Chrome") > 0) {
        preg_match("/Chrome\/([\d\.]+)/", $sys, $google);
        $exp[0] = "Chrome";
        $exp[1] = $google[1];  //获取google chrome的版本号
    } elseif(stripos($sys,'rv:')>0 && stripos($sys,'Gecko')>0){
        preg_match("/rv:([\d\.]+)/", $sys, $IE);
        $exp[0] = "IE";
        $exp[1] = $IE[1];
    }else {
        //$exp[0] = "未知浏览器";
        //$exp[1] = "";

        //是否微信打开
        $exp[0] = is_wechat_open();
        $exp[1] = "";
        return $exp[0];
    }
    return $exp[0].'('.$exp[1].')';
}


/**
 * [alluser  所有会员]
 * @author [忘尘]
 * @return array 数组下标为userid
 */
function alluser(){
    $arr = [];
    $user = Db::name('user')->select();
    foreach($user as $k => $v)
        $arr[$v['id']] = $v;

    return $arr;
}


/**
 * [array_sort  多维数组 按某个键值排序]
 * @author [忘尘]
 * @param $array 要排序的数组
 * @param $keys 用来排序的键名
 * @param string $type 默认为升序排序
 * @return array
 */
function array_sort($array,$keys,$type='asc'){
    $keysvalue = $new_array = array();
    foreach ($array as $k=>$v){
        $keysvalue[$k] = $v[$keys];
    }
    if($type == 'asc'){
        asort($keysvalue);
    }else{
        arsort($keysvalue);
    }
    reset($keysvalue);
    foreach ($keysvalue as $k=>$v){
        $new_array[$k] = $array[$k];
    }
    return $new_array;
}


/**
 * [get_device_type  判断设备ios或android]
 * @author [忘尘]
 * @return string
 */
function get_device_type() {
    //全部变成小写字母
     $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
     $type = 'other';
     //分别进行判断
     if(strpos($agent, 'iphone') || strpos($agent, 'ipad'))
     {
         $type = 'ios';
     }
     if(strpos($agent, 'android'))
     {
         $type = 'android';
     }
     return $type;
}

/**
 * [is_wechat_open  是否微信打开]
 * @author [忘尘]
 * @return string
 */
function is_wechat_open()
{
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    if (strpos($user_agent, 'MicroMessenger') === false) {
        // 非微信浏览器禁止浏览
        //echo "HTTP/1.1 401 Unauthorized";
        //return '未知浏览器';
        return '其它浏览器';
    } else {
        // 微信浏览器，允许访问
        // 获取版本号
        preg_match('/.*?(MicroMessenger\/([0-9.]+))\s*/', $user_agent, $matches);
        return  '微信Version:'.$matches[2];
    }
}


/**
 * [create_captcha  自定义生成验证吧]
 * @author [忘尘]
 * @return \think\Response
 */
function create_captcha()
{
 $config = config('captcha.captcha');//验证码配置
 $captcha = new \think\captcha\Captcha($config);
 return $captcha->entry();
}

/**
 * [getMillisecond  获取毫秒级别的时间戳]
 * @author [忘尘]
 * @return array|string
 */
 function getMillisecond()
{
    //获取毫秒的时间戳
    $time = explode ( " ", microtime () );
    $time = $time[1] . ($time[0] * 1000);
    $time2 = explode( ".", $time );
    $time = $time2[0];
    return $time;
}

/**
 * [is_from_mobileorpc  判断设备是手机还是PC]
 * @author [忘尘]
 * @return bool true为手机
 */
function is_from_mobileorpc()
{
    $useragent=isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
    $useragent_commentsblock=preg_match('|\(.*?\)|',$useragent,$matches)>0?$matches[0]:'';
    function CheckSubstrs($substrs,$text){
        foreach($substrs as $substr)
            if(false!==strpos($text,$substr)){
                return true;
            }
        return false;
    }
    $mobile_os_list=array('Google Wireless Transcoder','Windows CE','WindowsCE','Symbian','Android','armv6l','armv5','Mobile','CentOS','mowser','AvantGo','Opera Mobi','J2ME/MIDP','Smartphone','Go.Web','Palm','iPAQ');
    $mobile_token_list=array('Profile/MIDP','Configuration/CLDC-','160×160','176×220','240×240','240×320','320×240','UP.Browser','UP.Link','SymbianOS','PalmOS','PocketPC','SonyEricsson','Nokia','BlackBerry','Vodafone','BenQ','Novarra-Vision','Iris','NetFront','HTC_','Xda_','SAMSUNG-SGH','Wapaka','DoCoMo','iPhone','iPod');

    $found_mobile=CheckSubstrs($mobile_os_list,$useragent_commentsblock) || CheckSubstrs($mobile_token_list,$useragent);

    if ($found_mobile){
        return true;
    }else{
        return false;
    }
}


/**
 * http请求
 * @param  string  $url    请求地址
 * @param  boolean|string|array $params 请求数据
 * @param  integer $ispost 0/1，是否post
 * @param  array  $header
 * @param  $verify 是否验证ssl
 * return string|boolean          出错时返回false
 */
function httpUrl($url, $params = false, $ispost = 0, $header = array(), $verify = false) {
    $httpInfo = array();
    $ch = curl_init();
    if(!empty($header)){
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    }
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    //忽略ssl证书
    if($verify === true){
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    } else {
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    }
    if ($ispost) {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_URL, $url);
    } else {
        if (is_array($params)) {
            $params = http_build_query($params);
        }
        if ($params) {
            file_put_contents('url.txt', $url . '?' . $params);
            curl_setopt($ch, CURLOPT_URL, $url . '?' . $params);
        } else {
            curl_setopt($ch, CURLOPT_URL, $url);
        }
    }
    $response = curl_exec($ch);
    if ($response === FALSE) {
        trace("cURL Error: " . curl_errno($ch) . ',' . curl_error($ch), 'error');
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
        trace($httpInfo, 'error');
        return false;
    }
    curl_close($ch);
    return $response;
}


/**
 * [get_mobile_address 淘宝api  获取电话号码地址信息]
 * @author [忘尘]
 * @param string $mobile
 * @return bool|mixed
 */
function get_mobile_address($mobile = '')
{
    if (!is_numeric($mobile) || !isMobile($mobile)) {
        return false;
    }

    $url = "https://tcc.taobao.com/cc/json/mobile_tel_segment.htm?tel=".$mobile."&t=".time();
    $data = httpUrl($url);

    $ret = null;
    if (!empty($data)) {
        preg_match_all("/(\w+):'([^']+)/", $data, $res);
        $items = array_combine($res[1], $res[2]);
        foreach ($items as $itemKey => $itemVal) {
            $ret[$itemKey] = iconv('GB2312', 'UTF-8', $itemVal);//乱码转编码
        }
    }

    return $ret; //array(7) { ["mts"]=> string(7) "1375000" ["province"]=> string(6) "广东" ["catName"]=> string(12) "中国移动" ["telString"]=> string(11) "13750006078" ["areaVid"]=> string(5) "30517" ["ispVid"]=> string(7) "3236139" ["carrier"]=> string(12) "广东移动" }
}