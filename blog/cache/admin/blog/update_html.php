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
  <div class="panel-head"><strong><span class="icon-pencil-square-o"></span>发表博文</strong></div>
  <div class="body-content">
    <form method="post" class="form-x" action="http://localhost/1707/superior/blog/index.php?m=admin&c=blog&a=checkUpdate&bid=<?=$data[0]['bid'];?>" enctype="multiple/form-data">      
      <div class="form-group">
        <div class="label">
          <label>标题</label>
        </div>
        <div class="field">
          <input type="text" class="input" name="title" value="<?=$data[0]['title'];?>" />
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>图片:</label>
        </div>
        <div class="field">
          <img src="" alt="">
          <input type="file" name='picture' class="button bg-blue margin-left" id="image1" value=""  style="float:left;">
          <div class="tipss">图片尺寸：500*200</div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>内容：</label>
        </div>
        <div class="field">
          <textarea name="content"><?=$data[0]['content'];?></textarea>
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <button class="button bg-main icon-check-square-o" type="submit"> 提交</button>
        </div>
      </div>
    </form>
  </div>
</div>
</body>
</html>