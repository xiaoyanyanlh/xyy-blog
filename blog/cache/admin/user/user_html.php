<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="renderer" content="webkit">
<title></title>
<link rel="stylesheet" href="public/admin/css/pintuer.css">
<link rel="stylesheet" href="public.admin/css/admin.css">
<script src="public/admin.js/jquery.js"></script>
<script src="public/admin/js/pintuer.js"></script>
</head>
<body>
<form method="post" action="" id="listform">
  <div class="panel admin-panel">
    <table class="table table-hover text-center">
      <tr>
        <th>用户ID</th>
        <th>用户名</th>
        <th>用户类型</th>
        <th>用户邮箱</th>
        <th>操作</th>
      </tr>
      <volist name="list" id="vo">
      <?php foreach($data as $value):?>
        <tr>
          <td align='center'>
            <input type="checkbox" name="bid[]" value="<?=$value['uid'];?>" />
          </td>
          <td font color="#00CC99">
            <input type="text" name="title" value="<?=$value['uname'];?>"/>
          </td>
          <td>
            <?php if($value['type'] == 1):?> 
                <input type="text" name="title" value="管理员"/>
                <?php else: ?>
                  <?php if($value['type'] == 0):?>
                      <input type="text" name="title" value="普通用户"/>
                  <?php endif;?>
            <?php endif;?>
          </td>
          <td>
            <input type="text" name="createTime" value="<?=$value['email'];?>">
          </td>
          <td>
            <div class="button-group">
              <a class="button border-main" href="http://localhost/1707/superior/blog/index.php?m=admin&c=user&a=update&uid=<?=$value['uid'];?>">
                <span class="icon-edit"></span>修改
              </a>
              <a class="button border-red" href="http://localhost/1707/superior/blog/index.php?m=admin&c=user&a=delete&uid=<?=$value['uid'];?>" onclick="return del(1,1,1)">
              <span class="icon-trash-o"></span>删除
              </a>
            </div>
          </td>
        </tr>
      <?php endforeach;?>
    </table>
  </div>
</form>
<script type="text/javascript">

//搜索
function changesearch(){    
        
}

//单个删除
function del(id,mid,iscid){
    if(confirm("您确定要删除吗?")){    
    }
}

//全选
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

//批量删除
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
        $("#listform").submit();        
    }
    else{
        alert("请选择您要删除的内容!");
        return false;
    }
}

//批量排序
function sorts(){
    var Checkbox=false;
     $("input[name='id[]']").each(function(){
      if (this.checked==true) {     
        Checkbox=true;  
      }
    });
    if (Checkbox){  
        
        $("#listform").submit();        
    }
    else{
        alert("请选择要操作的内容!");
        return false;
    }
}


//批量首页显示
function changeishome(o){
    var Checkbox=false;
     $("input[name='id[]']").each(function(){
      if (this.checked==true) {     
        Checkbox=true;  
      }
    });
    if (Checkbox){
        
        $("#listform").submit();    
    }
    else{
        alert("请选择要操作的内容!");        
    
        return false;
    }
}

//批量推荐
function changeisvouch(o){
    var Checkbox=false;
     $("input[name='id[]']").each(function(){
      if (this.checked==true) {     
        Checkbox=true;  
      }
    });
    if (Checkbox){
        
        
        $("#listform").submit();    
    }
    else{
        alert("请选择要操作的内容!");    
        
        return false;
    }
}

//批量置顶
function changeistop(o){
    var Checkbox=false;
     $("input[name='id[]']").each(function(){
      if (this.checked==true) {     
        Checkbox=true;  
      }
    });
    if (Checkbox){      
        
        $("#listform").submit();    
    }
    else{
        alert("请选择要操作的内容!");        
    
        return false;
    }
}


//批量移动
function changecate(o){
    var Checkbox=false;
     $("input[name='id[]']").each(function(){
      if (this.checked==true) {     
        Checkbox=true;  
      }
    });
    if (Checkbox){      
        
        $("#listform").submit();        
    }
    else{
        alert("请选择要操作的内容!");
        
        return false;
    }
}

//批量复制
function changecopy(o){
    var Checkbox=false;
     $("input[name='id[]']").each(function(){
      if (this.checked==true) {     
        Checkbox=true;  
      }
    });
    if (Checkbox){  
        var i = 0;
        $("input[name='id[]']").each(function(){
            if (this.checked==true) {
                i++;
            }       
        });
        if(i>1){ 
            alert("只能选择一条信息!");
            $(o).find("option:first").prop("selected","selected");
        }else{
        
            $("#listform").submit();        
        }   
    }
    else{
        alert("请选择要复制的内容!");
        $(o).find("option:first").prop("selected","selected");
        return false;
    }
}

</script>
</body>
</html>