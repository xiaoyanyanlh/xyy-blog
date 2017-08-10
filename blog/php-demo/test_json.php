<?php 
require_once 'json.php';
$cc = new CallCenter();
//申请坐席      还存在的问题：应用不属于该appid；
/*
$clientType = 1;
$charge = 20;
$data = array(
	'client' => array(
		'appId' => $cc->appId,
		'clientType' => $clientType,
		'charge' => $charge,
		'friendlyName' => 'jhon',
		'mobile' => '13560757243'
	)
);
$clients = $cc->clients($data);
var_dump('1、json申请坐席:',$clients);
*/

//查询坐席
/*
$queryClient = $cc->queryClient($cc->appId,$cc->serviceId2);
var_dump('3、json查询坐席:',$queryClient);
*/

//释放坐席
/*
$dropClient = $cc->dropClient($cc->appId,$cc->serviceId2);
var_dump('2、json释放坐席:',$dropClient);
*/

//创建技能组接口
/*
$data = array(
      'ivr' => array(
              'appId' => $cc->appId,
              'queueId' =>2,
              'maxQNum' =>10,
      		  'fileName' => 'yzx_queue1.wav',
              'key2ExitQ' => '#',	//退出排队
              'waitTimeLen' =>30,
              'timeOutFileName' => 'yzx_queue_busy.wav',
              'key2Continue' => '*',
              'maxQCnt' =>5,
              'voiceStr' => 'yzx_gonghao.wav + yzx_fuwu.wav' 
      )
);
$create = $cc->create($data);
var_dump('4、json创建技能组:',$create);
*/

//修改技能组接口
/*
$data = array(
      'ivr' => array(
              'appId' => $cc->appId,
              'queueId' =>2,
              'maxQNum' =>10,
              'fileName' => 'yzx_queue1.wav',
              'key2ExitQ' => '#', //退出排队
              'waitTimeLen' =>30,
              'timeOutFileName' => 'yzx_queue_busy.wav',
              'key2Continue' => '*',
              'maxQCnt' =>1,
              //'voiceStr' => 'yzx_gonghao.wav + yzx_fuwu.wav'
      )
);
$edit = $cc->edit($data);
var_dump('5、json修改技能组:',$edit);
*/

//删除技能组接口
/*
$del = $cc->del(2);
var_dump('6、json删除技能组:',$del);
*/


//查询技能组
/*
$get = $cc->get(2);
var_dump('7、json查询技能组:',$get);
*/

//坐席接入
/*
$data = array(
        'ivr' => array(
                'appId' => $cc->appId,
                'serviceId' => $cc->serviceId2,
                'serviceAbility' => 5,
                'phone' => '02131224564',
                'ipAcct' => $cc->serviceId2,   //申请坐席时生成的，要先登录
                'curMethod' => 0,
                'skill' => '1,2',
                'state' => 0
        )
 );
 $on = $cc->on($data);
 var_dump('8、json坐席接入:',$on);
*/

//坐席签出
/*
$data = array(
      'ivr' => array(
              'appId' => $cc->appId,
              'serviceId' => $cc->serviceId1
      )
);
$off = $cc->off($data);
var_dump('9、json坐席签出:',$off);
*/

//设置坐席接听方式
/*
$data = array(
      'ivr' => array(
              'appId' => $cc->appId,
              'serviceId' => $cc->serviceId2,
              'curMethod' => 0
      )
);
$setMode = $cc->setMode($data);
var_dump('10、json设置坐席接听方式:',$setMode);
*/

//设置坐席1状态

$data = array(
	'ivr' => array(
		'appId' => $cc->appId,
		'serviceId' => $cc->serviceId1,
		'state' => 0
	)
);
$setStatus = $cc->setStatus($data);
var_dump('11、json设置坐席1状态:',$setStatus);

//设置坐席2状态

$data = array(
	'ivr' => array(
		'appId' => $cc->appId,
		'serviceId' => $cc->serviceId2,
		'state' => 0
	)
);
$setStatus = $cc->setStatus($data);
var_dump('11、json设置坐席2状态:',$setStatus);


//查询坐席状态
/*
$data = array(
      'ivr' => array(
              'appId' => $cc->appId,
              'serviceId' => $cc->serviceId1
      )
);
$status = $cc->status($data);
var_dump('12、json查询坐席状态:',$status);
*/

//查询所有坐席状态
/*
$data = array(
        'ivr' => array(
                'appId' => $cc->appId
        )
);
$statusall = $cc->statusall($data);
var_dump('13、json查询所有坐席状态:',$statusall);
*/

//获取所有技能组接口
/*
$getall = $cc->getall();
var_dump('14、json获取所有技能组接口:',$getall);
*/

/*
echo '<pre>';
//发起呼叫
$data = array(
        'ivr' => array(
                'appId' => $cc->appId,
                'caller' => $cc->serviceId2,
                //'called' => '13560757241',
                //'called' => '18320958625',	//忘记是谁的了
                //'called' => '15549449384',	//周紫珉
                'called' => '18824267810',  //曾钰
        		//'called' => '13247645700',  //曹浩测试机
                //'data' => ''
        )
);
$outCall = $cc->outCall($data);
var_dump('24、json发起呼叫:',$outCall);
echo '</pre>';
*/

//呼叫应答接口(该接口在回调中使用)
/*
$reply = $cc->reply($callId,0);
var_dump('15、json呼叫应答接口:',$reply);
*/

//获取DTMF按键(该接口在回调中使用)
/*
$dtmf_data = array(
	'ivr' => array(
		'appId' => $cc->appId,
		'callId' => $data['callId'],
		'playFlag' => 0,	//1、放音标签,0、播放voiceStr
		'fileName' => 'yzx_fuwu.wav', 	//放音文件名,选0时可为空
		'voiceStr' => '欢迎拨打云之讯呼叫中心号码，转人工坐席请按1，进入下一级菜单请按2',
		'playTime' => 5,
		'key2Stop' => '*',
		'cnt2Stop' => 1,
		'maxRevCnt' => 1,
		'key2End' => '#',
		'spaceTime' => 5,
		'totalTime' => 30,
		'data' => ''
	)
);
$dtmf = $cc->dtmf($dtmf_data);	//获取DTMF键
var_dump('16、json获取DTMF按键:',$dtmf);
*/

//播放语音(在回调中使用)
/*
$data = array(
		'ivr' => array(
				'appId' => $cc->appId,
				'callId' => $callId,
				'fileName' => 'yzx_fuwu.wav', //放音文件名
				'playTime' => 5,
				'key2Stop' => '*',
				'cnt2Stop' => 3,
				'data' => ''
		)
);
$play = $cc->play($data);
var_dump('17、json播放语音:',$play);
*/


//播放Tts(在回调中使用)
/*
$data = array(
		'ivr' => array(
				'appId' => $cc->appId,
				'callId' => $callId,
				'fileName' => 'yzx_fuwu.wav', //放音文件名
				'voiceStr' => 'yzx_fuwu.wav',
				'playTime' => 5,
				'key2Stop' => '*',
				'cnt2Stop' => 3,
				'data' => ''
		)
);
$play = $cc->playTts($data);
var_dump('18、json播放TTS:',$play);
*/

//挂机命令(在回调中使用)
/*
$hangUp = $cc->hangUp($callId);
var_dump('19、json挂机:',$hangUp);
*/

//留言(在回调中使用)
/*
$data = array(
	'ivr' => array(
		'appId' => $cc->appId,
		'callId' => $callId,
		'key2Stop' => '*',
		'cnt2Stop' => 3,
		'data' => ''
	)
);
$message = $cc->message($data);
var_dump('20、json留言:',$message);
*/

//入队(在回调中使用)
/*
$enqueue_data = array(
	'ivr' => array(
			'appId' => $cc->appId,
			'callId' => $data['callId'],
			'queueId' => 1,
			'prioiServiceId' => '',
			'data' => ''
	)
);
$enqueue = $cc->enqueue($enqueue_data);
var_dump('21、json入队:',$enqueue);
*/

//结束呼叫转IVR(在回调中使用)
/*
$data = array(
	'ivr' => array(
		'appId' => $cc->appId,
		'callId' => $callId,
		'fileName' => 'yzx_fuwu.wav', //放音文件名
		'playTime' => 5,
		'key2Stop' => '*',
		'cnt2Stop' => 3,
		'maxRevCnt' => 8,
		'key2End' => '#',
		'spaceTime' => 0,
		'totalTime' => 0
	)
);
$call2Ivr = $cc->call2Ivr($data);
var_dump('22、json结束呼叫转IVR:',$call2Ivr);
*/

//结束呼叫(在回调中使用)
/*
$disConnect = $cc->disConnect($callId);
var_dump('23、json结束呼叫:',$disConnect);
*/

?>
