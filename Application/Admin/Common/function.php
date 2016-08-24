<?php
/**
 * Created by PhpStorm.
 * User: dongyou02
 * Date: 2016/4/29
 * Time: 15:08
 */
/**
 * 获取栏目类型
 * @param int $id
 * @return mixed
 */
function get_column_type($id=0){
    $result = array('默认','列表页','下载页','单页面','4封面页','表单页','跳转页');
    return $result[$id];
}

/**
 * 获取礼券类型
 * @param $id
 * @return mixed
 */
function get_coupons_type($id){
    $result = array('实物','折扣','现金');
    return $result[$id];
}

/**
 * 获取使用信息
 * @param $id
 * @return string
 */
function get_coupons_used($id){
    $coupons = M('coupons')->find($id);
   if(!empty($coupons['coupons_use_user'])){
       return $coupons['coupons_use_user']."|".$coupons['coupons_use_order']."|".$coupons['coupons_use_date'];
   }else{
       return "暂无使用信息";
   }
}

/**
 * 密码加密函数
 */
function getEncyptStr($val) {
    vendor ( 'Encrypt' );
    return \EncryptCopy::encryptByKey ( $val, ENCRYPT_KEY );
}
/**
 * 密码解密函数
 */
function getDeEncyptStr($val) {
    vendor ( 'Encrypt' );
    return \EncryptCopy::decryptByKey ( $val, ENCRYPT_KEY );
}