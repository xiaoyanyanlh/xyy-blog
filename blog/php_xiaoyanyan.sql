-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-06-19 21:23:29
-- 服务器版本： 5.7.9
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_xiaoyanyan`
--

-- --------------------------------------------------------

--
-- 表的结构 `php_blog`
--

DROP TABLE IF EXISTS `php_blog`;
CREATE TABLE IF NOT EXISTS `php_blog` (
  `bid` int(11) NOT NULL AUTO_INCREMENT,
  `rid` tinyint(4) NOT NULL DEFAULT '0',
  `title` varchar(200) NOT NULL,
  `content` varchar(20000) NOT NULL,
  `createTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `state` tinyint(4) NOT NULL DEFAULT '0',
  `isTop` tinyint(4) NOT NULL DEFAULT '0',
  `commentNum` int(11) NOT NULL DEFAULT '0',
  `readNum` int(11) NOT NULL DEFAULT '0',
  `noComment` tinyint(4) DEFAULT NULL,
  `cid` int(11) DEFAULT NULL,
  PRIMARY KEY (`bid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `php_blog`
--

INSERT INTO `php_blog` (`bid`, `rid`, `title`, `content`, `createTime`, `state`, `isTop`, `commentNum`, `readNum`, `noComment`, `cid`) VALUES
(1, 0, 'PHP7.0新增加的特性', '?? 运算符（NULL 合并运算符） 把这个放在第一个说是因为我觉得它很有用。用法： $a = $_GET[‘a’] ?? 1;它相当于：\r\n\r\n?? 运算符（NULL 合并运算符）\r\n\r\n把这个放在第一个说是因为我觉得它很有用。用法：\r\n\r\n$a = $_GET[‘a’] ?? 1; 它相当于：\r\n\r\n$a ?: 1 但是这是建立在 $a 已经定义了的前提上。新增的 ?? 运算符可以简化判断。\r\n\r\n函数返回值类型声明\r\n\r\n官方文档提供的例子（注意 … 的边长参数语法在 PHP 5.6 以上的版本中才有）：\r\n\r\n这种声明的写法有些类似于 Swift：\r\n\r\nfunc sayHello(personName: String) -> String { let greeting = “Hello, “ + personName + “!” return greeting } 这个特性可以帮助我们避免一些 PHP 的隐式类型转换带来的问题。在定义一个函数之前就想好预期的结果可以避免一些不必要的错误。\r\n\r\n不过这里也有一个特点需要注意。PHP 7 增加了一个 declare 指令：strict_types，既使用严格模式。\r\n\r\n使用返回值类型声明时，如果没有声明为严格模式，如果返回值不是预期的类型，PHP 还是会对其进行强制类型转换。但是如果是严格模式， 则会出发一个 TypeError 的 Fatal error。\r\n\r\n强制模式：\r\n\r\n严格模式：\r\n\r\nPHP Fatal error: Uncaught TypeError: Return value of foo() must be of the type integer, float returned in test.php:6\r\n\r\n在声明之后，就会触发致命错误。\r\n\r\n是不是有点类似与 js 的 strict mode？\r\n\r\n标量类型声明\r\n\r\nPHP 7 中的函数的形参类型声明可以是标量了。在 PHP 5 中只能是类名、接口、array 或者 callable (PHP 5.4，即可以是函数，包括匿名函数)，现在也可以使用 string、int、float和 bool 了。\r\n\r\n官方示例：\r\n\r\nuse 批量声明\r\n\r\nPHP 7 中 use 可以在一句话中声明多个类或函数或 const 了：\r\n\r\n需要留意的问题是：如果你使用的是基于 composer 和 PSR-4 的框架，这种写法是否能成功的加载类文件？其实是可以的，composer 注册的自动加载方法是在类被调用的时候根据类的命名空间去查找位置，这种写法对其没有影响。\r\n\r\n其他的特性\r\n\r\n其他的一些特性我就不一一介绍了，有兴趣可以查看官方文档：http://php.net/manual/en/migration70.new-features.php\r\n\r\n简要说几个：\r\n\r\nPHP 5.3 开始有了匿名函数，现在又有了匿名类了； define 现在可以定义常量数组； 闭包（ Closure）增加了一个 call 方法； 生成器（或者叫迭代器更合适）可以有一个最终返回值（return），也可以通过 yield from 的新语法进入一个另外一个生成器中（生成器委托）。 生成器的两个新特性（return 和 yield from）可以组合。具体的表象大家可以自行测试。PHP 7 现在已经到 RC5 了，最终的版本应该会很快到来。\r\n\r\n互联网+时代，时刻要保持学习，携手千锋PHP,Dream It Possible。 更多PHP相关技术请搜索千锋PHP，做真实的自己，用良心做教育。', '2017-06-16 13:00:46', 0, 0, 0, 0, NULL, NULL),
(2, 0, 'PHP学习路线图', '在网上很多人公布了太多的PHP学习路线图，本人在互联网公司工作十余年，也带了很多PHP入门的新手，将他们的一些问题和学习路线图为大家整理出来，希望很多小白少走弯路。\r\n\r\n一、 网上某些错误的学习路线图\r\n\r\n网上有些错误的学习路线图，让学完HTML、CSS后立马去学Javascript和jQuery等，这种课程简直是对牛弹琴。你特么的怎么不去搞个前端工程师培训或者是吹牛逼的全栈工程师培训呀。\r\n\r\n这种错误的路线图的问题在于将重心未放在PHP方向，而放在了前端方向。将面向对象，业务思想、SQL转化等PHP关注的重心没有放置在之前而放置在之后了。PHP的重心还是要放在业务处理上。\r\n\r\n二、 前期加快入门\r\n\r\n前期的时候要加快入门的进度，学一些HTML和Css能基本写出网页后，就快速进入到PHP阶段。\r\n\r\n因为大家是自学的PHP，学了半天还没搞到PHP的话，会放松对学习的热情，从而造成自学效果下降。\r\n\r\n学完HTML和Css不要学Js，立马进入到环境的搭建上来。\r\n\r\n三、 关于开发 环境\r\n\r\n很多人在这儿走弯路，喜欢找不到同教程看环境搭建。我们在公司里面开发的时候，真正的是使用的Linux环境进行开发和线上代码运行的。\r\n\r\n在学习的过程中，我建议：快、快、快。少纠结、代码能跑就行。\r\n\r\n此处，推荐使用XAMPP、AppServ、PHPStudy、WampServer等工具快速安装完成，开始自己的第一段\r\n\r\n<?php\r\nphpinfo();\r\n四、 基本语法\r\n\r\n环境搭建完，开始要学习的东西有以下一些东西了：变量、数据类型、注释、常量、if…else、swith…case、while、do..while、for、运算符、数组、函数、常用函数；\r\n\r\n这些过程当中，很多小白容易纠结为啥啥都写不出来呢。\r\n\r\n此外，全是些基本语法，一定要记住，多写多记多背。\r\n\r\n在心理上觉得啥都写不出来是很正常的。\r\n\r\n五、 面向过程使用阶段\r\n\r\n在这一阶段就能够写出东西来了，学完MySQL数据库后立马开始学习PHP连接数据库吧，学习完成后写个留言本、分页、再学个cookie和session实现用户登陆、注册。学个GD后开始实现个验证码吧。\r\n\r\n最后在这个阶段你可以写一个论坛、贴吧或者商城出来。\r\n\r\n六、 面向对象和MVC\r\n\r\n在这个阶段不要再看PHP5的视频了，最好看PHP7以后的视频，特别是新的一些标准，例如：composer、PSR、面向对象的设计模式等。你可以看一些千锋PHP最新的视频，这些技术点全都讲到了。\r\n\r\n这一块学习顺序：\r\n\r\n面向对象基本语法；\r\n\r\n写几个常用类；\r\n\r\n组合MVC\r\n\r\n学习设计模式\r\n\r\n学习PSR\r\n\r\n七、 深入学学前端\r\n\r\nPHP学好了，前端课程学起来跟玩似的了。因为你已经有了一门语言的基础了。所以，学习一些JS，再学一些jQuery，bootstrap够你用了。\r\n\r\n八、 深入ThinkPHP5.0或者Laravel\r\n\r\n深入学习一个或者两个框架，然后结合前端的知识，写二个以上的项 目出来吧。\r\n\r\n你可以写个多品类的商城、写一个OA系统等。\r\n\r\n九、 学习Linux服务器\r\n\r\n学习Linux服务器的主要了解多服务器的部署，了解软件安装，特别是LAMP和LNMP的环境搭建。\r\n\r\n将对应的代码搭建到自己部署的服务器上去。\r\n\r\n最后买一个域名和阿里云服务器，真正的将代码部署到云服务器上去，走一次上线流程，用一下git管理一下代码会更棒。\r\n\r\n十、 深入大并发架构的学习\r\n\r\n你非常有必要学习一下大并发架构，学一些NoSQL技术、Swoole技术、keepalived技术等多项不同的技术。\r\n\r\n让自己全面了解服务器集群下代码如何运行的更加高效。\r\n\r\n并且全面的了解一下PHP的socket、进程、线程、协程等技术，对你的代码的技术提升是很有帮助的。\r\n\r\n建议这个时候使用Redis、RockMQ写一个大并发的、多服务器的秒杀出来。', '2017-06-17 07:20:29', 0, 0, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `php_user`
--

DROP TABLE IF EXISTS `php_user`;
CREATE TABLE IF NOT EXISTS `php_user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=普通用户 1=管理员',
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `php_user`
--

INSERT INTO `php_user` (`uid`, `uname`, `password`, `type`, `email`) VALUES
(1, 'xiaoyanyan', '123hdgdcfrd', 1, '2439438657@qq.com'),
(2, '鹿晗', 'sjwsjw', 0, ''),
(44, 'sjw', '3627815ad56a2e0bc2eeae77224a86f9', 0, 'sjwsjw@163.com'),
(43, '123456', 'e10adc3949ba59abbe56e057f20f883e', 0, 'sjwsjw@163.com'),
(42, 'sjwsjw', '3627815ad56a2e0bc2eeae77224a86f9', 0, 'sjwsjw@163.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
