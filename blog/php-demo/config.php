<?php 
/**
 * 作用：示例文件的配置文件
 * 作者： Edward
 * 时间：2015年12月1日
 * 备注：该文件中，appId、坐席、技能组都是自行调用接口产生。
 */

$config['sid'] = '2cc0d635a2f443121e83bc787490d40a';	//主账号ID
$config['token'] = 'cc103e9a8c7c25dedf3295cb3e50b8df';	//验证
$config['appId'] = '7dfc9c1135644fe4abe89b68e3bfdec1';	//运行生成的appId
$config['serviceId1'] = '66170060009322';	//坐席1
$config['serviceId2'] = '66170060009563';	//坐席2
$config['queueId1'] = 1;	//技能组1
$config['queueId2'] = 2;	//技能组2

//应用操作地址(创建 app)
$config['maap_url'] = 'http://ipcc-test.ucpaas.com/maap/ipcc/app/';	

//语音文件上传路径
$config['uploadFile_url'] = 'http://ipcc-test.ucpaas.com/maap/ipcc/voice/uploadFile';

//坐席操作地址
$config['rest_url'] = 'https://113.31.89.144:443/2014-06-30/Accounts/2cc0d635a2f443121e83bc787490d40a/';

//技能组接口
$config['ipcc_url'] = 'https://ipcc-test.ucpaas.com/2014-06-30/Accounts/2cc0d635a2f443121e83bc787490d40a/ipcc/';

//回调地址
$config['call_back'] = 'http://113.31.130.135/callCenter/callback.php';

/**
刘君给的测试号码：02131224564；
语音文件：survey.wav  yzx_fuwu.wav  yzx_gonghao.wav  yzx_queue1.wav  yzx_queue_busy.wav  yzx_queue.wav  yzx_wait.wav
 */
