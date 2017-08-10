
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
      <div class="page_box page_box_bg">
      <div class="home_menu"><a href="http://localhost/1707/superior/blog/index.php"></a></div>
      	<div class="page_left_menu">
          <ul>
          	<li class="menu1"><a href="http://localhost/1707/superior/blog/index.php?c=blog&a=blog" title="博客列表"></a></li>
          </ul>
          </div>
        <div class="index_left page_left about_l">
            <div class="about_text" style="overflow:auto; width:414px; height:300px;">
            <?php if(!empty($data)):?>
              <?php foreach($data as $blog):?>
                <h1>
                  <a href="http://localhost/1707/superior/blog/index.php?c=blog&a=blogDetail&bid=<?=$blog['bid'];?>">
                    <?=$blog['title'];?>
                  </a>
                </h1>
                  <?=$blog['createTime'];?>
              <?php endforeach;?>
            <?php endif;?>
            </div>
        </div>
        <div class="index_right page_right about_r"> </div>
        <div class="page_right_menu" >
           <ul>
            <li class="menu_1"><a class="on" href="http://localhost/1707/superior/blog/index.php?c=blog&a=blog" title="博客列表"></a></li>
            <li class="menu_2"><a href="t.html" title="广播站——云朵工厂官方微博"></a></li>
            <li class="menu_5"><a href="product.html" title="厂区仓库——云朵工厂原创产品介绍"></a></li>
            <li class="menu_6"><a href="job.html" title="招兵买马——云朵工厂照片"></a></li>
            <li class="menu_4"><a href="games.html" title="游乐园"></a></li>
          </ul>
        </div>
      </div>
  </body>
</html>
