<?php
namespace index\controller;
use xyy\framework\Template;
class BaseController extends Template
{
    public function __construct()
    {
        parent::__construct('cache/index','app/index/view');
        $this->_init();
    }

    /**
     * [_init 子类初始化方法]
     * @return [type] [description]
     */
    public function _init()
    {

    }

    public function display($viewFile=null,$isExtract=true)
    {
        if (empty($viewFile)) {
            $viewFile = $_GET['c'] . '/' . $_GET['a'] . '.html';
        }
        parent::display($viewFile,$isExtract);
    }

    //信息提示
    public function notice($msg,$code=1,$url=null,$wait=3)
    {
        if (empty($url)) {
            $url = $_SERVER['HTTP_REFERER'];
        }

        include 'app/index/view/notice.html';
    }

    //成功时通知
    public function success($msg,$url=null,$wait=3)
    {
        $this->notice($msg,1,$url,$wait);
    }

    //失败时通知
    public function error($msg,$url=null,$wait=3)
    {
        $this->notice($msg,0,$url,$wait);
    }
}