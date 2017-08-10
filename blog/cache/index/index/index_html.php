
<!DOCTYPE>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>xiaoyanyan's blog</title>
    <link rel="stylesheet" type="text/css" href="public/index/style.css" />
  </head>
  <body>
    <div class="bg_top">
      <div class="header_bg">
      <div class="header">
      <?php if(empty($_SESSION['uname'])):?>
        <a href="http://localhost/1707/superior/blog?c=user&a=register" title="注册" class="lan en" >注册</a>
        <a href="http://localhost/1707/superior/blog?c=user&a=login" title="登录" class="lan cn" style="background-position:left top;">登录</a>

        <?php else: ?>
          <div class="lan en" >欢迎<?=$_SESSION['uname'];?></div>
          <?php if($_SESSION['type'] == 1):?>
              <div class="lan cn" style="background-position:left top;">
                <a href="http://localhost/1707/superior/blog/index.php?m=admin&c=index&a=index">管理中心</a>
              </div>
          <?php endif;?>
      <?php endif;?> 
      </div>
      </div>
    </div>
    <div class="page_box" style="height:646px;">
      <div class="index_left"></div>
      <div class="index_right"><a href=""><img src="public/index/img/cloud_05.jpg" alt="xiaoyanyan's blog" /></a></div>
      <div class="index_menu">  
        <ul>
          <li class="menu_1">
            <a href="http://localhost/1707/superior/blog/index.php?c=blog&a=blog" title="博客列表"></a>
          </li>
          <li class="menu_5">
            <a href="http://localhost/1707/superior/blog/index.php?c=user&a=logout" title="退出"></a>
          </li>
        </ul>  
      </div>
    </div>
  </body>
</html>
