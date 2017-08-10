<?php
namespace admin\model;
use admin\model\BaseModel;
class Blog extends BaseModel
{
    //查询评论
    public function remark()
    {
        return  $this->field('bid,content,createTime,rid')->where('rid!=0')->select();
    }

    //查询博客
    public function detail()
    {
        return $this->field('bid,rid,title,content,createTime')->where('rid=0')->select();
    }

    //检测博客上传
    public function checkPost($title,$picture,$content)
    {
       return $this->insert(["title" => $title,'picture' => $picture,'content' => $content]);
    }

    //删除博客
    public function deleteBlog()
    {
        $bid = $_GET['bid'];
       return $this->where("bid=$bid")->delete(); 
    }

    //更新博客
    public function updateBlog()
    {
        $bid = $_GET['bid'];
        return $this->where("bid=$bid")->select();
    }

    //更新博客处理
    public function doUpdate($title,$picture,$content)
    {
        $bid = $_GET['bid'];
        return $this->where("bid=$bid")->update(['title' => $title,'picture' => $picture,'content' => $content]);
    }

    //删除评论
    public function deleteRe()
    {
        $bid = $_GET['bid'];
        return $this->where("bid=$bid")->delete();
    }
}