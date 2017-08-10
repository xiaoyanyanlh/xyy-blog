<?php
namespace index\controller;
use index\controller\BaseController;
use index\model\Blog;

class BlogController extends BaseController
{
    protected $blog;

    public function _init()
    {
        $this->blog = new Blog();
    }

    public function blog()
    {
        $data = $this->blog->blogList();
        $this->assign('data',$data);
        $this->display();
    }
     public function blogDetail()
    {
        $bid = $_GET['bid'];
        $data = $this->blog->blogDetail();
        if (!empty($_POST)){
            $data1 = $this->blog->blogRemark();
        }
        $result = $this->blog->blogSelect();
        $this->assign('data',$data);
        $this->assign('result',$result);
        $this->display();
    }

    public function checkBlog()
    {
        
    }

    public function blogRemark()
    {
        $bid = $_GET['bid'];
         $data = $this->blog->blogSelect();
        $this->assign('data',$data);
        $this->display();
    }
}