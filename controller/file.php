<?php
/**
 * Created by PhpStorm.
 * User: amir's dell
 * Date: 5/18/2017
 * Time: 6:05 PM
 */

namespace controller;
use model\data_access\lang;
class file{

    private static $file_extensions  = array();
    private static $image_extensions = array("image/jpg", "image/jpeg", "image/png");
    private static $path             = "public/images/uploaded";
    public static function upload($name, $type = "image"){
        $res = array("error" => false);
        if(self::check("image")){
            $file = $_FILES[$name];
        }else{
            $res['error'] = true;
            $res['message'] = lang::$file_not_set;
            response::send_msg($res['message'], lang::$error);
        }
        if(!file_exists(self::$path)){
            mkdir(self::$path);
        }
        $file_name  = $file['name'];
        $file_size  = $file['size'];
        $file_tmp   = $file['tmp_name'];
        $file_type  = $file['type'];
        $file_error = $file['error'];
        if($file_error == 1){
            $error = true;
        }
        if($type == "image"){
            if(in_array($file_type,self::$image_extensions)=== false){
                $res['error']   = true;
                $res['message'] = lang::$error_file;
            }
        }else{
            if(in_array($file_type,self::$file_extensions)=== false){
                $res['error']   = true;
                $res['message'] = lang::$error_file;
            }
        }
//            if($file_size > 1048576){
//                $error = true;
//            }
        if(!$res['error']){
            $filePath = self::$path."/".$file_name;
            $i = 0;
            while (file_exists($filePath)){
                $name = explode(".", $file_name);
                $filePath = self::$path."/".$name[0]."[$i].".$name[1];
                $i ++;
            }
            if(move_uploaded_file($file_tmp,$filePath)){
                $res['name'] = $file_name;
                $res['url']  = str_replace("../","" , $filePath);
            }
        }else{
            response::send_msg($res['message'], lang::$error);
        }
        return $res;
    }

    public static function move($path){
        //move file for update
    }

    public static function delete($path){
        if($path){
            $path = "../$path";
            if(file_exists($path)){
                unlink($path);
            }
        }
    }

    public static function check($name){
        if(isset($_FILES[$name]) && !empty($_FILES[$name]))
            return true;
        return false;
    }
}