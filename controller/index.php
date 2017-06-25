<?php
/**
 * Created by PhpStorm.
 * User: amir's dell
 * Date: 6/21/2017
 * Time: 7:17 PM
 */
namespace controller;
use model\data_access\access;
use model\data_access\lang;

function __autoload($class_name){
    $path = str_replace("\\", "/",$class_name.".php");
    require_once $path;
}

if (!isset($_REQUEST["act"])) {
    exit;
}

switch ($_REQUEST["act"]) {
    case 'register':
        //not complete
        $userid = login::getUserId();
        if($userid){
            check_validation(array("username", "email", "password"));
            $insert = access::set_users($_REQUEST['username'], $_REQUEST['password'], $_REQUEST['email'], $userid);
            response::check_insert($insert);
        }
        break;
    case 'login':
        check_validation(array("email", "pass"));
        $user = access::get_users_by(array("email" => $_REQUEST['email']));
        if($user){
            if($user['password'] == $_REQUEST['pass']){
                session::set("user", $user);
                //update last_login
                response::send_result(array('Result' => 'index.html', 'act' => 'location'));
            }else{
                //update_failed_login
                response::send_msg(lang::$wrong_login, lang::$error);
            }
        }
        break;
    case 'get_all_category':
        $data = access::get_all_category();
        response::check_data($data);
        break;
    case 'get_all_city':
        $data = access::get_all_city();
        response::check_data($data);
        break;
    case 'get_all_dodger':
        $data = access::get_all_dodger();
        response::check_data($data);
        break;
    case 'get_all_groups':
        $data = access::get_all_groups();
        response::check_data($data);
        break;
    case 'get_all_slider':
        $data = access::get_all_slider();
        response::check_data($data);
        break;
    case 'get_all_users':
        $data = access::get_all_users();
        response::check_data($data);
        break;
    case 'get_category_by_id':
        check_validation(array("id"));
        $data = access::get_category_by_id($_REQUEST['id']);
        response::check_data($data);
        break;
    case 'get_city_by_id':
        check_validation(array("id"));
        $data = access::get_city_by_id($_REQUEST['id']);
        response::check_data($data);
        break;
    case 'get_dodger_by_id':
        check_validation(array("id"));
        $data = access::get_dodger_by_id($_REQUEST['id']);
        response::check_data($data);
        break;
    case 'get_groups_by_id':
        check_validation(array("id"));
        $data = access::get_groups_by_id($_REQUEST['id']);
        response::check_data($data);
        break;
    case 'get_slider_by_id':
        check_validation(array("id"));
        $data = access::get_groups_by_id($_REQUEST['id']);
        response::check_data($data);
        break;
    case 'set_category':
        $userid = login::getUserId();
        if($userid){
            check_validation(array("groupid", "name"));
            $insert = access::set_category($_REQUEST['groupid'], $_REQUEST['name'], $userid);
            response::check_insert($insert);
        }
        break;
    case 'set_city':
        $userid = login::getUserId();
        if($userid){
            check_validation(array("name"));
            $insert = access::set_city($_REQUEST['name'], $userid);
            response::check_insert($insert);
        }
        break;
    case 'set_groups':
        $userid = login::getUserId();
        if($userid){
            check_validation(array("cityid", "name"));
            $insert = access::set_groups($_REQUEST['cityid'], $_REQUEST['name'], $userid);
            response::check_insert($insert);
        }
        break;
    case 'set_dodger':
        $userid = login::getUserId();
        if($userid){
            check_validation(array("categoryid", "brand", "tell", "address", "off"));
            $insert = access::set_dodger($_REQUEST['categoryid'], $_REQUEST['brand'], $_REQUEST['tell'], $_REQUEST['address'], $_REQUEST['off'], $userid);
            response::check_insert($insert);
        }
        break;
    case 'set_slider':
        $userid = login::getUserId();
        if($userid){
            check_validation(array("title", "url", "content"));
            $insert = access::set_slider($_REQUEST['title'], $_REQUEST['url'], $_REQUEST['content'], $userid);
            response::check_insert($insert);
        }
        break;
    case 'set_seen':
        check_validation(array("dodgerid"));
        $mackip = "";
        $insert = access::set_seen($_REQUEST['dodgerid'], $mackip);
        break;
    case 'delete_category':
        $userid = login::getUserId();
        if($userid){
            check_validation(array("id"));
            $res = access::delete_category($_REQUEST['id']);
            response::check_update_delete($res);
        }
        break;
    case 'delete_city':
        $userid = login::getUserId();
        if($userid){
            check_validation(array("id"));
            $res = access::delete_city($_REQUEST['id']);
            response::check_update_delete($res);
        }
        break;
    case 'delete_groups':
        $userid = login::getUserId();
        if($userid){
            check_validation(array("id"));
            $res = access::delete_groups($_REQUEST['id']);
            response::check_update_delete($res);
        }
        break;
    case 'delete_dodger':
        $userid = login::getUserId();
        if($userid){
            check_validation(array("id"));
            $res = access::delete_dodger($_REQUEST['id']);
            response::check_update_delete($res);
        }
        break;
    case 'delete_slider':
        $userid = login::getUserId();
        if($userid){
            check_validation(array("id"));
            $res = access::delete_slider($_REQUEST['id']);
            response::check_update_delete($res);
        }
        break;
    case 'update_category':
        $userid = login::getUserId();
        if($userid){
            check_validation(array("id", "gruopid", "name"));
            $res = access::update_category($_REQUEST['id'], $_REQUEST['groupid'], $_REQUEST['name']);
            response::check_update_delete($res);
        }
        break;
    case 'update_city':
        $userid = login::getUserId();
        if($userid){
            check_validation(array("id", "name"));
            $res = access::update_city($_REQUEST['id'], $_REQUEST['name']);
            response::check_update_delete($res);
        }
        break;
    case 'update_dodger':
        $userid = login::getUserId();
        if($userid){
            check_validation(array("id", "categoryid", "brand", "tell", "address", "off"));
            $res = access::update_dodger($_REQUEST['id'], $_REQUEST['categoryid'], $_REQUEST['brand'], $_REQUEST['tell'], $_REQUEST['address'], $_REQUEST['off']);
            response::check_update_delete($res);
        }
        break;
    case 'update_groups':
        $userid = login::getUserId();
        if($userid){
            check_validation(array("id", "cityid", "name"));
            $res = access::update_groups($_REQUEST['id'], $_REQUEST['cityid'], $_REQUEST['name']);
            response::check_update_delete($res);
        }
        break;
    case 'update_slider':
        $userid = login::getUserId();
        if($userid){
            check_validation(array("id", "title", "url", "content"));
            $res = access::update_slider($_REQUEST['id'], $_REQUEST['title'], $_REQUEST['url'], $_REQUEST['content']);
            response::check_update_delete($res);
        }
        break;
    default:
        response::send_msg(lang::$invalid_command, lang::$error);
        break;
}

function check_validation($field){
    $result['is_valid'] = true;
    for ($i = 0; count($field) > $i; $i++){
        if (isset($_REQUEST[$field[$i]])) {
            $result[$field[$i]] = $_REQUEST[$field[$i]];
        } else {
            $result[$field[$i]] = false;
            $result['is_valid'] = false;
        }
    }
    response::check_validation($result);
}