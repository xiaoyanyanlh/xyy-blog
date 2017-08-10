<?php
namespace index\model;
use xyy\framework\Model;
class User extends Model
{
    public function checkLogin($uname,$password)
    {
        $password = md5(trim($password));
        
        return $this->where("uname='$uname' and password='$password'")
                    ->limit('1')
                    ->field('uid,uname,type')
                    ->select();
    }

    //判断用户名是否重复
    public function unameRepeat($uname)
    {
        $data = $this->where("uname='$uname'")
                    ->select();
        return !empty($data[0]);
    }

    public function checkregister($uname,$password,$email)
    {   
        $password = md5(trim($password));
        return $this->insert(["uname" => $uname,"password" => $password,"email" => $email]);
    }
}