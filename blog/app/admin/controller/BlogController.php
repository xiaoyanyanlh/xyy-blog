<?php
namespace admin\controller;
use admin\controller\BaseController;
use admin\model\Blog;
use xyy\framework\Upload;
class BlogController extends BaseController
{
    protected $blog;
    public function _init()
    {
        $this->blog = new Blog();
    }

    //评论博客
    public function remark()
    {

        $data = $this->blog->remark();
        $this->assign('data',$data);
        $this->display();
    }

    //博客详情
    public function detail()
    {
        $data = $this->blog->detail();
        //var_dump($data);
        $this->assign('data',$data);
        $this->display();
    }

    //发表博文
    public function post()
    {
        $this->display();
    }

    //处理发表的博文
     public function doPost()
    {
        $title = $_POST['title'];
        $picture = $_POST['picture'];
        $content = $_POST['content'];
        $result = $this->blog->checkPost($title,$picture,$content);
        if ($result) {
           $this->success('发表博文成功！','http://localhost/1707/superior/blog/index.php?m=admin&c=blog&a=detail');
        } else {
            $this->error('发表失败');
        }
    }

    //删除
    public function delete()
    {
        $bid = $_GET['bid'];
        if (is_array($bid)) {
            $bid = join(',',$bid);
        }
        $result = $this->blog->deleteBlog();
        if ($result) {
            $this->success('删除成功!',"index.php?m=admin&c=blog&a=detail");
        }
    }

    //修改
    public function update()
    {
        $bid = $_GET['bid'];
        $data = $this->blog->updateBlog();
        $this->assign('data',$data);
        $this->display();
    }

    public function checkUpdate()
    {
        $bid = $_GET['bid'];
        $title = $_POST['title'];
        $picture = $_POST['picture'];
        $content = $_POST['content'];
        $result = $this->blog->doUpdate($title,$picture,$content);
        if ($result) {
            $this->success('修改成功!',"index.php?m=admin&c=blog&a=detail");
        } else {
            $this->error('修改失败!');
        }
    }

    public function deleteRemark()
    {
        $bid = $_GET['bid'];
        $result = $this->blog->deleteRe();
        if ($result) {
            $this->success('删除评论成功!',"index.php?m=admin&c=blog&a=remark");
        } else {
            $this->error('删除评论失败!');
        }
    }
}