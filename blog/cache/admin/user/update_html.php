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
<div class="panel admin-panel">
  <div class="panel-head"><strong><span class="icon-pencil-square-o"></span>修改用户</strong></div>
  <div class="body-content">
    <form method="post" class="form-x" action="http://localhost/1707/superior/blog/index.php?m=admin&c=user&a=checkUpdate&uid=<?=$data[0]['uid'];?>" enctype="multiple/form-data">      
      <div class="form-group">
        <div class="label">
          <label>用户名</label>
        </div>
        <div class="field">
          <input type="text" class="input" name="uname" value="<?=$data[0]['uname'];?>" />
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>用户类型:</label>
        </div>
        <div class="field">
            <input type="text" placeholder="0:普通用户 1:管理员" id="url1" name="type" class="input tips" style="width:25%; float:left;"  value="<?=$data[0]['type'];?>"/>
        </div>
        <div class="field">
          <div class="tipss">用户邮箱</div>
         <input type="text" class="input" name="email" value="<?=$data[0]['email'];?>" />
        </div>
      </div>
      <div class="field">
          <button class="button bg-main icon-check-square-o" type="submit">修改</button>
        </div>
      </div>
    </form>
  </div>
</div>
</body>
</html>