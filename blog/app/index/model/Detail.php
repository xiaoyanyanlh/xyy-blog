<?php
namespace index\model;
use index\model\BaseModel;

class Detail extends BaseModel
{
    public function blogDetail()
    {
        $bid = $_GET['bid'];
        return $this->where("bid=$bid")->field('bid,title,createTime,content')->select();
        //var_dump($a);
    }
}