<?php
/**
 * Created by PhpStorm.
 * User: amir's dell
 * Date: 6/24/2017
 * Time: 5:09 PM
 */

namespace controller;
use model\data_access\lang;

class response{

    public static function send_msg($msg, $title,$type = "error", $btn = ""){
        self::send_result(array('msg' => $msg, 'title' => $title, 'type'=>$type , 'btn'=>$btn ,  'act' => 'message' ));
    }

    public static function send_result($res){
        echo json_encode($res);
        exit;
    }

    public static function check_data($data){
        if($data){
            self::send_result($data);
        }else{
            self::send_msg(lang::$not_data_here, lang::$error);
        }
    }

    public static function check_insert($insert){
        if(is_numeric($insert)){
            self::send_msg(lang::$success, lang::$message, lang::$success_type);
        }else{
            self::send_msg(lang::$failed, lang::$error);
        }
    }

    public static function check_update_delete($result){
        if($result){
            self::send_msg(lang::$success, lang::$message, lang::$success_type);
        }else{
            self::send_msg(lang::$failed, lang::$error);
        }
    }

    public static function check_validation($valid_data){
        if (!isset($valid_data['is_valid']) || $valid_data['is_valid'] == false) {
            self::send_msg(lang::$invalid_data, lang::$error);
        }
    }

}