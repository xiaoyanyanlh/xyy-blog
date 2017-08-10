<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title></title>  
    <link rel="stylesheet" href="public/admin/css/pintuer.css">
    <link rel="stylesheet" href="public/admin/css/admin.css">
    <script src="public/admin/js/jquery.js"></script>
    <script src="public/admin/js/pintuer.js"></script>  
</head>
<body>
<form method="post" action="http://localhost/1707/superior/blog/index.php?m=admin&c=blog&a=remark">
  <div class="panel admin-panel">
    <div class="panel-head"><strong class="icon-reorder">评论管理</strong></div>
    <div class="padding border-bottom">
      <ul class="search">
        <li>
          <button type="button"  class="button border-green" id="checkall"><span class="icon-check"></span> 全选</button>
          <button type="submit" class="button border-red"><span class="icon-trash-o"></span>批量删除</button>
        </li>
      </ul>
    </div>
    <table class="table table-hover text-center">
      <tr>
        <th>ID</th>     
        <th>回复内容</th>
        <th>回复时间</th>
        <th>操作</th>       
      </tr> 
      <?php foreach($data as $value):?>
        <tr>
          <td>
            <input type="checkbox" name="bid[]" value="<?=$value['bid'];?>"/>
          </td>
          <td>
            <input type="text" name="title" value="<?=$value['content'];?>"/>
          </td>
          <td>
            <input type="text" name="createTime" value="<?=$value['createTime'];?>"/>
              
          </td>
          <td>
            <div class="button-group">
              <a class="button border-red" href="http://localhost/1707/superior/blog/index.php?m=admin&c=blog&a=deleteRemark&bid=<?=$value['bid'];?>" onclick="return del(1)">
                <span class="icon-trash-o"></span>删除
              </a>
            </div>
          </td>
        </tr>
      <?php endforeach;?>    
      <!-- <tr>
        <td colspan="8"><div class="pagelist"> <a href="">上一页</a> <span class="current">1</span><a href="">2</a><a href="">3</a><a href="">下一页</a><a href="">尾页</a> </div></td>
      </tr> -->
    </table>
  </div>
</form>
<script type="text/javascript">

function del(id){
	if(confirm("您确定要删除吗?")){
		
	}
}

$("#checkall").click(function(){ 
  $("input[name='id[]']").each(function(){
	  if (this.checked) {
		  this.checked = false;
	  }
	  else {
		  this.checked = true;
	  }
  });
})

function DelSelect(){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){
		var t=confirm("您确认要删除选中的内容吗？");
		if (t==false) return false; 		
	}
	else{
		alert("请选择您要删除的内容!");
		return false;
	}
}

</script>
</body></html>