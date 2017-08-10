<?php
namespace admin\controller;
use admin\controller\BaseController;
use admin\model\User;
class UserController extends BaseController
{
    protected $user;
    public function _init()
    {
        $this->user = new User();
    }

    //查询用户信息
    public function user()
    {
        $data = $this->user->user();
        $this->assign('data',$data);
        $this->display();
    }

   //修改用户信息
    public function update()
    {
        $bid = $_GET['uid'];
        $data = $this->user->updateUser();
        $this->assign('data',$data);
        $this->display();
    }

    //检查修改信息
    public function checkUpdate()
    {
        $uid = $_GET['uid'];
        $uname = $_POST['uname'];
        $type = $_POST['type'];
        $email = $_POST['email'];
        $result = $this->user->doUpdate($uname,$type,$email);
        if ($result) {
            $this->success('修改成功!',"index.php?m=admin&c=user&a=user");
        } else {
            $this->error('修改失败!');
        }
    }

    //删除用户信息
    public function delete()
    {
        $uid = $_GET['uid'];
        $result = $this->user->doDelete();
        if ($result) {
            $this->success('删除成功!',"index.php?m=admin&c=user&a=user");
        } else {
             $this->error('修改失败!');
        }
    }

    //退出登录
     public function logout()
    {
        $_SESSION = [];
        session_destroy();
        $this->success('退出成功','http://localhost/1707/superior/blog/index.php',3);
    }
}