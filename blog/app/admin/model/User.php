<?php
namespace admin\model;
use xyy\framework\Model;
class User extends Model
{
    //查询用户信息
    public function user()
    {
        return $this->field('uid,uname,type,email')->select();
    }

    //查询需要更改的用户信息
    public function updateUser()
    {
        $uid = $_GET['uid'];
        return $this->where("uid=$uid")->select();
    }

    //更改用户信息
     public function doUpdate($uname,$type,$email)
    {
        $uid = $_GET['uid'];
        return $this->where("uid=$uid")->update(['uname' => $uname,'type' => $type,'email' => $email]);
    }

    //删除
    public function doDelete()
    {
        $uid = $_GET['uid'];
        return $this->where("uid=$uid")->delete();
    }
}