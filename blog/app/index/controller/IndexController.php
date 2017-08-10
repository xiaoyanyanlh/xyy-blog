<?php
//index 前台模块名
namespace index\controller;
use index\controller\BaseController;
use index\model\Home;
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
        //首页,一个控制器对应app/index/view下的一个目录，目录名从url中获取
        //一个方法对应一个模板文件index.html
        $this->display();
    }
}