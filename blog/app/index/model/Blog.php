<?php
namespace index\model;
use index\model\BaseModel;
class Blog extends BaseModel
{
    /**
     * [blogList 获取博客文章列表]
     * @return [type] [文章数组]
     */
    public function blogList()
    {
        $a = $this->field('bid,title,createTime')->where('rid=0')->select();
        return $a;
    }

    public function blogDetail()
    {
        $bid = $_GET['bid'];
        return $this->where("bid=$bid")->field('bid,title,createTime,content')->select();
    }

    public function blogRemark()
    {
        $bid = $_GET['bid'];
        $content = $_POST['content'];
        return $this->insert(['content' => $content,'rid'=>$bid]);
    }

    public function blogSelect()
    {
         $bid = $_GET['bid'];
        return $this->where("rid=$bid")->select();
    }
}
