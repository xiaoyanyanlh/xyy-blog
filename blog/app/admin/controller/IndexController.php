<?php
namespace admin\controller;
use admin\controller\BaseController;
use admin\model\Home;
class IndexController extends BaseController
{
    protected $home;

    public function _init()
    {
        //实例化model类对象
        $this->home = new Home();
    }

    public function index()
    {
        $data = $this->home->home();
        $this->assign('data',$data);
        $this->display();
    }
}