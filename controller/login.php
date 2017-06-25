<?php
/**
 * Created by PhpStorm.
 * User: amir's dell
 * Date: 6/6/2017
 * Time: 2:33 PM
 */
namespace controller;
use model\database\data;
use model\data_access\lang;

class login{

    public static $salt = "ECH";

    public static function login($login, $password, $remember = false){
        $respond = array("ok" => false);
        $res = data::select("`tbl_users`", "*", "`username` = '$login'", false, false, false, false);
        if ($res) {
            $cryptPassword = $password;
            if ($cryptPassword == $res['password']) {
                session::set("user", $res);
                if ($remember == true) {
                    $userData = array("remember_username" => $login, "remember_password" => $cryptPassword);
                    //save to cookie!
                    cookie::setCookie("remember", json_encode($userData), 30);
                }
                $respond['ok'] = true;
                $respond['message'] = lang::$success_login;
                $respond['act'] = "redirect";
                $respond['location'] = url."dashboard";
            } else {
                //wrong password
                $respond['message'] = lang::$wrong_login;
            }
        } else {
            // Email Not Exist
            $respond['message'] = lang::$not_exist_login;
        }
        return $respond;
    }

    public static function ReLogin(){}

    public static function register(){}

    public static function logout(){
        if(session::checkSession('user'))
        {
            session::destroy("user");
            session::destroy("last_activity");
        }
        if(cookie::exist("remember")){
            cookie::destroy("remember");
        }
    }

    public static function checkLogin(){
        if(session::checkSession('user')){
            return true;
        }
        return false;
    }

    public static function getUserId(){
        if(self::checkLogin()){
            return session::get('user', 'id');
        }else{
            return false;
        }
    }

    public static function getName(){
        if(self::checkLogin()){
            return session::get('user', 'fname'). " ". session::get('user', 'lname');
        }else{
            return null;
        }
    }

}