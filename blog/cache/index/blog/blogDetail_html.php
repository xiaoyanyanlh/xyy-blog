
<!DOCTYPE>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>xiaoyanyan's blog</title>
    <link rel="stylesheet" type="text/css" href="public/index/style.css" />
    <script type='text/javascript' src='./public/index/ckeditor/ckeditor.js'></script>
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
              <div class="lan cn" style="background-position:left top;">管理中心</div>
          <?php endif;?>
      <?php endif;?>
      </div>
      </div>
    </div>
      <div class="page_box page_box_bg">
      <div class="home_menu"><a href="http://localhost/1707/superior/blog/index.php"></a></div>
      	<div class="t_box">
           <div style="margin:60px auto auto 130px; overflow:auto; width:570px; height:516px;">
            <a href="#remark" style="text-decoration:none; background-color:rgb(153,115,94);">评论</a>
             <h3><?=$data[0]['title'];?></h3>
             <h6><?=$data[0]['createTime'];?></h6>
             <div>
               &nbsp;&nbsp;<?=$data[0]['content'];?>
             </div>
             <p></p>
             <div>
             <?php if(!empty($result)):?>
                  <?php foreach($result as $value):?>
                    <div style="background-color:rgb(253,249,243);"><?=$value['content'];?></div>
                    <h6 style='margin-left:400px;'><?=$value['createTime'];?></h6>
                  <?php endforeach;?> 
             <?php endif;?> 
             </div>
             <a href="" name='remark' style="text-decoration:none; background-color:rgb(153,115,94);">评论</a>
             <form action="http://localhost/1707/superior/blog/index.php?c=blog&a=blogDetail&bid=<?=$data[0]['bid'];?>" method='post'>
                <textarea name="content" class='ckeditor' id='textarea'>
                </textarea><br/>
                <input type='submit' name='submit' value='评论'>
             </form>
           </div>
           </div>
         </div>  
        <div class="page_right_menu" >
          <ul>
            <li class="menu_1"><a href="http://localhost/1707/superior/blog/index.php?c=blog&a=blog" title="博客列表"></a></li>
             <li class="menu_5">
            <a href="http://localhost/1707/superior/blog/index.php?c=user&a=logout" title="退出"></a>
          </li>
          </ul>
        </div>
      </div>
  </body>
</html>
