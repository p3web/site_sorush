<?php
/**
 * Created by PhpStorm.
 * User: amir's dell
 * Date: 6/21/2017
 * Time: 7:14 PM
 */
namespace model\data_access;
use model\database\data;
use controller\file;

class access{

    public static function set_category($groupid, $name, $createBy){
        return data::insert("`category`", "`id`, `groupid`, `name`, `isDelete`, `createBy`, `creationDate`", "NULL, '$groupid', '$name', '0', '$createBy', CURRENT_TIMESTAMP");
    }

    public static function set_city($name, $createBy){
        $res = file::upload("image");
        $url = $res['url'];
        return data::insert("city", "`id`, `name`, `image`, `isDelete`, `createBy`, `creationDate`", "NULL, '$name', '$url', '0', '$createBy', CURRENT_TIMESTAMP");
    }

    public static function set_dodger($categoryid, $brand, $tell, $address, $off, $createBy){
        $res = file::upload("image");
        $url = $res['url'];
        return data::insert("dodger", "`id`, `categoryid`, `brand`, `tell`, `address`, `off`, `image`, `seenCount`, `createBy`, `creationDate`", "NULL, '$categoryid', '$brand', '$tell', '$address', '$off', '$url', '0', '$createBy', CURRENT_TIMESTAMP");
    }

    public static function set_groups($cityid, $name, $createBy){
        $res = file::upload("image");
        $url = $res['url'];
        return data::insert("groups", "`id`, `cityid`, `name`, `image`, `isDelete`, `createBy`, `creationDate`", "NULL, '$cityid', '$name', '$url', '0', '$createBy', CURRENT_TIMESTAMP");
    }

    public static function set_slider($title, $url, $content, $createBy){
        $res = file::upload("image");
        $image = $res['url'];
        return data::insert("slider", "`id`, `title`, `url`, `content`, `image`, `createBy`, `creationDate`", "NULL, '$title', '$url', '$content', '$image', '$createBy', CURRENT_TIMESTAMP");
    }

    public static function set_users($username, $password, $email, $createBy){
        return data::insert("users", "`id`, `username`, `password`, `email`, `mobile`, `avatar`, `lastLogin`, `lastModify`, `failedCount`, `isDelete`, `createBy`, `creationDate`", "NULL, '$username', '$password', '$email', '0', 'avatar', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '0', '0', '$createBy', CURRENT_TIMESTAMP");
    }

    public static function set_seen($dodgerid, $mackip){
        return data::select("seen", "`id`, `dodgerid`, `mackip`, `creationDate`", "NULL, '$dodgerid', '$mackip', CURRENT_TIMESTAMP");
    }

    public static function get_all_category(){
        return data::select("category", "*", "`isDelete` = 0");
    }

    public static function get_all_city(){
        return data::select("city", "*", "`isDelete` = 0");
    }

    public static function get_all_dodger(){
        return data::select("dodger", "*");
//        "select dodger.*, category.name as category_name
//FROM dodger
//JOIN category
//on dodger.categoryid = category.id
//join groups
//on category.groupid = groups.id";
    }

    public static function get_all_groups(){
        return data::select("groups", "*", "`isDelete` = 0");
    }

    public static function get_all_slider(){
        return data::select("slider", "*");
    }

    public static function get_all_users(){
        return data::select("users", "*", "`isDelete` = 0");
    }

    public static function get_category_by_id($id){
        return data::select("category", "*", "`id` = $id and `isDelete` = 0");
    }

    public static function get_city_by_id($id){
        return data::select("city", "*", "`id` = $id and `isDelete` = 0");
    }

    public static function get_dodger_by_id($id){
        return data::select("dodger", "*", "`id` = $id");
    }

    public static function get_groups_by_id($id){
        return data::select("groups", "*", "`id` = $id and `isDelete` = 0");
    }

    public static function get_slider_by_id($id){
        return data::select("slider", "*", "`id` = $id");
    }

    public static function get_users_by_id($id){
        return data::select("users", "*", "`id` = $id and `isDelete` = 0");
    }

    public static function get_category_by($val1, $val2 = false){
        if($val2 != false){
            return data::select("`category`", "*","`$val1` = '$val2' and `isDelete` = 0");
        }else{
            if(is_array($val1)){
                return data::select("`category`", "*", data::makeWhere($val1)." and `isDelete` = 0");
            }
            return false;
        }
    }

    public static function get_city_by($val1, $val2 = false){
        if($val2 != false){
            return data::select("`city`", "*","`$val1` = '$val2' and `isDelete` = 0");
        }else{
            if(is_array($val1)){
                return data::select("`city`", "*",data::makeWhere($val1)." and `isDelete` = 0");
            }
            return false;
        }
    }

    public static function get_dodger_by($val1, $val2 = false){
        if($val2 != false){
            return data::select("`dodger`", "*","`$val1` = '$val2'");
        }else{
            if(is_array($val1)){
                return data::select("`dodger`", "*",data::makeWhere($val1));
            }
            return false;
        }
    }

    public static function get_groups_by($val1, $val2 = false){
        if($val2 != false){
            return data::select("`groups`", "*","`$val1` = '$val2' and `isDelete` = 0");
        }else{
            if(is_array($val1)){
                return data::select("`groups`", "*",data::makeWhere($val1)." and `isDelete` = 0");
            }
            return false;
        }
    }

    public static function get_slider_by($val1, $val2 = false){
        if($val2 != false){
            return data::select("`slider`", "*","`$val1` = '$val2'");
        }else{
            if(is_array($val1)){
                return data::select("`slider`", "*",data::makeWhere($val1));
            }
            return false;
        }
    }

    public static function get_users_by($val1, $val2 = false){
        if($val2 != false){
            return data::select("`users`", "*","`$val1` = '$val2' and `isDelete` = 0");
        }else{
            if(is_array($val1)){
                return data::select("`users`", "*",data::makeWhere($val1)." and `isDelete` = 0");
            }
            return false;
        }
    }

    public static function delete_category($id){
        return data::update("category", "`isDelete` = '1'", "`id` = $id");
    }

    public static function delete_city($id){
        return data::update("city", "`isDelete` = '1'", "`id` = $id");
    }

    public static function delete_dodger($id){
        return data::delete("dodger", "`id` = $id");
    }

    public static function delete_groups($id){
        return data::update("groups", "`isDelete` = '1'", "`id` = $id");
    }

    public static function delete_slider($id){
        return data::delete("slider", "`id` = $id");
    }

    public static function delete_users($id){
        return data::update("users", "`isDelete` = '1'", "`id` = $id");
    }

    public static function update_category($id, $groupid, $name){
        return data::update("category", "`groupid` = '$groupid', `name` = '$name'", "`id` = $id");
    }

    public static function update_city($id, $name){
        if(file::check("image")){
            $city = self::get_city_by_id($id);
            file::delete($city['image']);
            $image = file::upload('image');
            $url   = $image['url'];
            return data::update("city", "`name` = '$name', `image` = '$url'", "`id` = $id");
        }else{
            return data::update("city", "`name` = '$name'", "`id` = $id");
        }
    }

    public static function update_dodger($id, $categoryid, $brand, $tell, $address, $off){
        if(file::check("image")){
            $city = self::get_dodger_by_id($id);
            file::delete($city['image']);
            $image = file::upload('image');
            $url   = $image['url'];
            return data::update("dodger", "`categoryid` = '$categoryid', `brand` = '$brand', `tell` = '$tell', `address` = '$address', `off` = '$off', `image` = '$url'", "`id` = $id");
        }else{
            return data::update("dodger", "`categoryid` = '$categoryid', `brand` = '$brand', `tell` = '$tell', `address` = '$address', `off` = '$off'", "`id` = $id");
        }
    }

    public static function update_groups($id, $cityid, $name){
        if(file::check("image")){
            $city = self::get_groups_by_id($id);
            file::delete($city['image']);
            $image = file::upload('image');
            $url   = $image['url'];
            return data::update("groups", "`cityid` = '$cityid', `name` = '$name', `image` = '$url'", "`id` = $id");
        }else{
            return data::update("groups", "`cityid` = '$cityid', `name` = '$name'", "`id` = $id");
        }
    }


    public static function update_slider($id, $title, $url, $content){
        if(file::check("image")){
            $city = self::get_slider_by_id($id);
            file::delete($city['image']);
            $image = file::upload('image');
            $url   = $image['url'];
            return data::update("slider", "`title` = '$title', `url` = '$url', `content` = '$content', `image` = '$image'", "`id` = $id");
        }else{
            return data::update("slider", "`title` = '$title', `url` = '$url', `content` = '$content'", "`id` = $id");
        }
    }

    public static function update_users($id, $username, $password, $email){
        return data::update("users", "`username` = '$username', `password` = '$password', `email` = '$email'", "`id` = $id");
    }

}