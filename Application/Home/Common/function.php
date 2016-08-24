<?php
/**
 * Created by PhpStorm.
 * User: 魏巍
 * Date: 2016/5/11
 * Time: 14:46
 */
/**
 * 发送短信
 * @param string $mobile    手机号码
 * @param string $var       信息变量
 * @param string $content   发送信息
 * @return mixed
 */
function sendSMS($mobile='',$var='',$content=''){
    $_result = array(
        'status'=>1,
        'msg'=>'短信发送成功，请注意查收'
    );
    if(empty($mobile)){
        $_result['status'] = 0;
        $_result['msg'] = '短信发送失败，手机号码不能为空！';
        return $_result;
    }
    if (empty($content)){
        $_result['status'] = 0;
        $_result['msg'] = '短信发送失败，发送信息不能为空！';
        return $_result;
    }

    //判断是否是非法请求
    if($var != session('var')){
        $_result['status'] = 0;
        $_result['msg'] = '短信发送失败，非法的请求！';
        return $_result;
    }

    $url = 'https://106.ihuyi.com/webservice/sms.php?method=Submit';
    $account = 'cf_dongyou';
    $apikey = 'df4ae9833d7da0ec2f22e69d4fb0af15';
    $time = time();
    //$password = md5($account.$apikey.$mobile.$content.$time);

    $post_data = 'account='.$account.'&password='.$apikey.'&mobile='.$mobile.'&content='.rawurlencode($content);

    return xml_to_array(PostCurlSms($post_data,$url));
    //return $_result;
}

/**
 * 处理订单函数
 * 更新订单状态，写入订单支付后返回的数据
 * @param $parameter
 */
function orderhandle($parameter){
    $ordid=$parameter['out_trade_no'];
    $data['payment_trade_no']      =$parameter['trade_no'];
    $data['payment_trade_status']  =$parameter['trade_status'];
    $data['payment_notify_id']     =$parameter['notify_id'];
    $data['payment_notify_time']   =$parameter['notify_time'];
    $data['payment_buyer_email']   =$parameter['buyer_email'];
    $data['ordstatus']             =1;
    $ord=M('Orderlist');
    $ord->where('ordid='.$ordid)->save($data);
}

/**
 * 获取订单号
 * @return string
 */
function get_order_trade_no(){
    $order_number = date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    return $order_number;
}

/**
 * 转换网址
 * @param $parameter
 * @return mixed
 */
function get_visit_url($parameter){
    $url = $parameter['url'];
    $orderId = $parameter['ordid'];
    $url = $url.'?sid=sid|'.$orderId.'|'.time();
    $appid = 'a78cc9e1b994ea1a4c90bb7cf9c21b3b';
    $url='http://ni2.org/api/create.json?url='.$url.'&user_key='.$appid;
    $res = json_decode(PostCurlSms('',$url),true);
     return str_replace('http://ni2.org','http://dzx.com/t',$res['url']);
}

//请求CURL
function PostCurlSms($curlPost,$url){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_NOBODY, true);
    curl_setopt($curl, CURLOPT_POST, true);
    if($curlPost){
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
    }
    $return_str = curl_exec($curl);
    curl_close($curl);
    return $return_str;
}
//读取xml
function xml_to_array($xml){
    $reg = "/<(\w+)[^>]*>([\\x00-\\xFF]*)<\\/\\1>/";
    if(preg_match_all($reg, $xml, $matches)){
        $count = count($matches[0]);
        for($i = 0; $i < $count; $i++){
            $subxml= $matches[2][$i];
            $key = $matches[1][$i];
            if(preg_match( $reg, $subxml )){
                $arr[$key] = xml_to_array( $subxml );
            }else{
                $arr[$key] = $subxml;
            }
        }
    }
    return $arr;
}
//验证码
function random($length = 6 , $numeric = 0) {
    PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);
    if($numeric) {
        $hash = sprintf('%0'.$length.'d', mt_rand(0, pow(10, $length) - 1));
    } else {
        $hash = '';
        $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghjkmnpqrstuvwxyz';
        $max = strlen($chars) - 1;
        for($i = 0; $i < $length; $i++) {
            $hash .= $chars[mt_rand(0, $max)];
        }
    }
    return $hash;
}

/**
 * 获取产品介绍格式
 * @param $str
 * @return string
 */
function get_pro_details($str){
    $arr = explode('，',$str);
    $_result='';
    if(count($arr)<1){
        $_result=$str;
    }else{
        foreach ($arr as $v){
            $_result.="<p>$v</p>";
        }
    }
    return $_result;
}

function get_pro_right($str){
    $arr = explode('，',$str);
    return $arr[1];
}
function get_pro_left($str){
    $arr = explode('，',$str);
    return $arr[0];
}

function get_pro_details1($str){
    $arr = explode('，',$str);
    $_result='';
    if(count($arr)<1){
        $_result=$str;
    }else{
        foreach ($arr as $v){
            $_result.="<h2>$v</h2>";
        }
    }
    return $_result;
}

/**
 * 获取产品名称
 * @param $id
 * @return mixed
 */
function get_product_name($id){
    $article = M('article')->find($id);
    return $article['title'];
}