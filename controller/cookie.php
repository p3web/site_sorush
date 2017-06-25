<?php
/**
 * Created by PhpStorm.
 * User: amir's dell
 * Date: 6/3/2017
 * Time: 9:41 PM
 */
namespace controller;

class cookie{

    public static function setCookie($name, $value, $day){
        if(is_array($value))
            $value = json_encode($value);
        setcookie($name,$value,time() + (3600 * $day) , "/");
        $_COOKIE[$name] = $value;
    }

    public static function getCookie($name){
        if(self::exist($name)){
            return $_COOKIE[$name];
        }
    }

    public static function exist($name){
        if(isset($_COOKIE[$name]))
            return true;
        return false;
    }

    public static function getArray($name, $key = false){
        if(self::exist($name)){
            $cookie = json_decode($_COOKIE[$name], TRUE);
            return $key?$cookie[$key]:$cookie;
        }
        return false;
    }

    public static function destroy($name){
        if(self::exist($name)){
            unset($_COOKIE[$name]);
            setcookie($name,null,-1,"/");
            return true;
        }
        return false;
    }

}