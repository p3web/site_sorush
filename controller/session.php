<?php
/**
 * Created by PhpStorm.
 * User: amir's dell
 * Date: 6/3/2017
 * Time: 9:41 PM
 */
namespace controller;

class session{

    private static function start(){
        if(!self::check()) {
            @session_start();
            return true;
        }
        return true;
    }

    public static function set($key, $value){
        if(self::start()){
            $_SESSION[$key] = $value;
            return true;
        }
        return false;
    }

    public static function get($name, $key = false){
        if(self::start()){
            if($key != false){
                if(isset($_SESSION[$name][$key]))
                    return $_SESSION[$name][$key];
            }else{
                if(isset($_SESSION[$name]))
                    return $_SESSION[$name];
            }
        }
        return false;
    }

    public static function checkSession($key){
        if(self::start()){
            if(isset($_SESSION[$key])){
                return true;
            }
            else{
                return false;
            }
        }
    }

    private static function check($key = false){
        if(!isset($_SESSION))
            return false;
        return true;
    }

    public static function display(){
        if(self::start()){
            echo '<pre>';
            echo print_r($_SESSION);
            echo '</pre>';
        }
    }

    public static function destroy($key = false){
        if(self::start()){
            if($key != false){
                unset($_SESSION[$key]);
            }else{
                session_unset();
                session_destroy();
            }
        }
    }
}