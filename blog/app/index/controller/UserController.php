<?php
namespace index\controller;
use index\controller\BaseController;
use xyy\framework\VerifyCode;
use index\model\User;

class UserController extends BaseController
{
    protected $user;

    public function _init()
    {
        $this->user = new User();
    }

    public function login()
    {
        $this->display();
    }

    public function yzm()
    {
        $vc = new VerifyCode();
        $vc->outputImage();
        $_SESSION['code'] = $vc->getCode();
    }
    //登录处理
    public function doLogin()
    {
        $uname = $_POST['uname'];
        $password = $_POST['password'];
        $code = $_POST['code'];
        $result = $this->user->checkLogin($uname,$password)[0];
        
        if ($result && count($result)>0) {
            if ($code == $_SESSION['code']) {
                unset($_SESSION['code']);
                $_SESSION['uname'] = $uname;
                $_SESSION['type'] = $result['type'];
                $_SESSION['uid'] = $result['uid'];
                $this->success('登录成功！','http://localhost/1707/superior/blog/index.php');
            } else {
                $this->error('验证码错误');
            }
        } else {
            $this->error('登录失败');
            
        }
    }
    
    //注册
    public function register()
    {
        $this->display();
    }

    //处理注册
    public function doRegister()
    {
        $uname = $_POST['uname'];
        $password = trim($_POST['password']);
        $confirm = trim($_POST['confirm']);
        $email = $_POST['email'];

        if(empty($uname)) {
            $this->error('用户名不能为空!<br/>');
            die;
        }

        if($this->user->unameRepeat($uname)) {
            $this->error('用户名重复');
            die;
        }

        if (strlen($password) < 3 || strlen($password) > 12) {
            $this->error('密码不得少于3位或者大于12位<br/>');
            die;
        } 

        if ($password != $confirm) {
            $this->error('两次密码输入不一致<br/>');
            die;
        }

        $reg = '/\w+@(\w+\.)+(com|cn|net)$/i';
        if (!preg_match($reg,$email,$matches)) {
            $this->error('邮箱格式不正确!');
            die;
        }

        $result = $this->user->checkregister($uname,$password,$email);
        if ($result) {
            $_SESSION['uname'] = $uname;
            $_SESSION['type'] = $result['type'];
            $_SESSION['uid'] = $result['uid'];
            $this->success('注册成功','http://localhost/1707/superior/blog/index.php',3);
        } else {
            $this->error('注册失败!<br/>');
        }
    }

    public function logout()
    {
        $_SESSION = [];
        session_destroy();
        $this->success('退出成功','http://localhost/1707/superior/blog/index.php',3);
    }
}