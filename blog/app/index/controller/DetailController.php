<?php
namespace index\controller;
use index\controller\BaseController;
use index\model\Detail;

class DetailController extends BaseController
{
    protected $detail;

    public function _init()
    {
        $this->detail = new Detail();
    }
}