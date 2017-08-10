<?php
require_once 'get.php';

$cca = new CallCenterApp();
$nbr = '02131224564';
//创建应用
// $add = $cca->add($nbr,'linquan');
// var_dump('1、get创建应用:',$add);

//修改应用
$edit = $cca->edit($cca->myappId,$nbr);
echo '<pre>';
print_r('2、get修改应用:');
echo '<br>';
print_r($edit);
echo '</pre>';

//应用查询
// $get = $cca->get($cc->myappId);
// var_dump('3、get应用查询:',$get);

//上传语音文件
//$file = $cca->uploadFile($cc->myappId,0,'F:/1.amr');
//var_dump('4、上传语音文件:',$file);
//fileId:747

//删除应用
//$del = $cca->del($cc->myappId);
//var_dump('2、get删除应用:',$del);




?>