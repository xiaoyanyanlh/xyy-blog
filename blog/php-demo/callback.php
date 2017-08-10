<?php
/**
 * 作用：示例类文件，仅供参考，客户需根据实际需求修改
 * 作者： Edward
 * 时间：2015年12月8日
 */
require_once 'json.php';	//加载操作接口类
$call_center = new CallCenter();	//创建呼叫中心类
$xmldata = file_get_contents("php://input");
$data = (array)simplexml_load_string($xmldata);
if($data['appId'] == $call_center->appId){					//验证是否是相应应用
	if(isset($data['event']) && $data['event'] != ''){
		CallBack::handle_back($data);
	}else{
		//此处为自己编写的编号，只要$retcode不为0，服务器就认为失败，此处只为返回具体错误信息；
		echo CallBack::return_back_xml(444,'请求参数不正确！');	
	}
}else{
	//此处为自己编写的编号，只要$retcode不为0，服务器就认为失败，此处只为返回具体错误信息；
	echo CallBack::return_back_xml(443,'appId错误，请修正！');	
}

/**
 *	返回对象
 */
class CallBack{
	/**
	 * 返回xml数据(DOM方式)
	 */
	public static function return_back_xmlDOM($retcode,$reason){
		$doc = new DOMDocument('1.0', 'utf-8');
		$response = $doc->createElement('response');
		$retcode = $doc->createElement('retcode',$retcode);
		$reason = $doc->createElement('reason',$reason);
		$response->appendChild($retcode);
		$response->appendChild($reason);
		$doc->appendChild($response);
		$data = $doc->saveXML();
		return $data;
	}

	/**
	 * 返回xml数据
	 */
	public static function return_back_xml($retcode,$reason){
		$data = '<?xml version="1.0" encoding="utf-8"?>';
		$data .= '<response>';
		//$data .= '<response>';
		$data .= '<retcode>'.$retcode.'</retcode>';
		$data .= '<reason>'.$reason.'</reason>';
		$data .= '</response>';
		return $data;
	}
	
	/**
	 * 处理数据
	 */
	public static function handle_back($data){
		/*自己的逻辑，通常将数据保存到数据库，请自行编写begin******/
		$str = json_encode($data);
		$file = fopen('/data/callbackfiles/'.$data['event'].'.json', 'a');
		fwrite($file, $str."\r\n");
		fclose($file);
		/*自己的逻辑，通常将数据保存到数据库，请自行编写end******/
		
		$cc = new CallCenter();	//创建呼叫中心类
		//创建一个按键的内部函数
		function dtmf($cc,$callId,$str){
			$dtmf_data = array(
				'ivr' => array(
					'appId' => $cc->appId,
					'callId' => $callId,
					'playFlag' => 0,	//1、放音标签,0、播放voiceStr
					'fileName' => 'yzx_fuwu.wav', 	//放音文件名,playFlag为0时可为空
					'voiceStr' => $str,
					'playTime' => 1,
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
		}//end_function_dtmf
		
		switch($data['event']){
			//来电呼叫，要调用呼叫应答
			case incomingcall:
				$result = $cc->reply($data['callId'],0);
				break;
			//呼叫应答回调，调用获取按键接口
			case incomingcallack:
				$str = '欢迎拨打云之讯呼叫中心号码，转人工坐席请按1，进入下一级菜单请按2，按3请留言';
				dtmf($cc,$data['callId'],$str);
				break;
			//按键事件
			case ivrreportdtmf:	
				//这部分根据自己的IVR流程编写
				$fileName = '/data/callbackfiles/'.$data['event'].'__'.$data['callId'].'.txt';
		
				//入队
				function enqueue($cc,$callId,$queueId){
					$enqueue_data = array(
						'ivr' => array(
							'appId' => $cc->appId,
							'callId' => $callId,
							'queueId' => $queueId,
							'prioiServiceId' => '',
							'data' => ''
						)
					);
					$enqueue = $cc->enqueue($enqueue_data);
				}//end_function_enqueue
				
				//第一层ivr的处理
				function dtmf_level1($cc,$data,$fileName){
					if($data['dtmfCode'] == '1'){	//按键是1，则入队
						enqueue($cc,$data['callId'],1);
					}else if($data['dtmfCode'] == '2'){
						$ivr_data = array(	//数据保存IVR层次和本次所按下的键
							'level' => 1,
							'dtmfCode' => 2
						);
						$fp = fopen($fileName,'a');
						fwrite($fp,json_encode($ivr_data)."\r\n");
						fclose($fp);
						$str = '欢迎进入第二级菜单，转人工坐席请按1，返回主菜单请按2';
						dtmf($cc,$data['callId'],$str);
					}else if($data['dtmfCode'] == '3'){
						$meggage_data = array(
							'ivr' => array(
								'appId' => $cc->appId,
								'callId' => $data['callId'],
								'key2Stop' => '*',
								'cnt2Stop' => 3,
								'data' => ''
							)
						);
						$message = $cc->message($meggage_data);
					}else{
						$str = '输入错误，请重新输入，转人工坐席请按1，进入下一级菜单请按2';
						dtmf($cc,$data['callId'],$str);
					}
				}//end_function_dtmf_level1
				
				//第二层ivr的处理
				function dtmf_level2($cc,$data,$fileName){
					if($data['dtmfCode'] == '1'){	//按键是1，则入队
						enqueue($cc,$data['callId'],1);
					}else if($data['dtmfCode'] == '2'){
						$ivr_data = array(	//数据保存IVR层次和本次所按下的键
							'level' => 2,
							'dtmfCode' => 2
						);
						$fp = fopen($fileName,'a');
						fwrite($fp,json_encode($ivr_data)."\r\n");
						fclose($fp);
						$str = '这是主菜单，转人工坐席请按1，进入下一级菜单请按2，留言请按3';
						dtmf($cc,$data['callId'],$str);
					}else{
						$str = '输入错误，请重新输入，转人工坐席请按1，返回主菜单请按2';
						dtmf($cc,$data['callId'],$str);
					}
				}//end_function_dtmf_level1
				
				
				//文件为空表示当前通话第一次按键，主菜单上的按键。
				$dtmf_data = file($fileName);
				if(empty($dtmf_data)){
					if(isset($data['dtmfCode']) && $data['dtmfCode'] != ''){
						dtmf_level1($cc,$data,$fileName);
					}
				}else{	//文件不为空的情况
					$ivr_last_data = json_decode(end($dtmf_data));
					if($ivr_last_data->level === 1){
						dtmf_level2($cc,$data,$fileName);
					}else if($ivr_last_data->level === 2){
						dtmf_level1($cc,$data,$fileName);
					}
				}
				break;
			//排队溢出(这部分逻辑可自行编写，如返回主菜单，返回上级菜单，此处播放语音后结束通话)
			case callenqueueoverflowrpt:	
				$tts_data = array(
					'ivr' => array(
						'appId' => $cc->appId,
						'callId' => $data['callId'],
						'fileName' => 'yzx_fuwu.wav', //放音文件名
						'voiceStr' => '对不起，当前等待用户较多，请稍后再拨！',
						'playTime' => 1,
						'key2Stop' => '*',
						'cnt2Stop' => 3,
						'data' => ''
					)
				);
				$play = $cc->playTts($tts_data);	//播放等待用户较多语音
				$disConnect = $cc->disConnect($data['callId']);		//通话结束
				break;
			//呼叫状态
			case callstatrpt:
				$fileName = '/data/callbackfiles/ivrreportdtmf__'.$data['callId'].'.txt';
				$callstat = isset($data['ansCode'])?intval($data['ansCode']):'';
				switch($callstat){
					case 99:		//坐席挂断电话
						$disConnect = $cc->disConnect($callId);
						break;
				}
				
		}
		$return = self::return_back_xml(0,0);	//返回xml格式
		$return_length = strlen($return);
		header('Content-Length:'.$return_length);
		echo $return;
	}//end_function_handle_back 
	
}//end_class_callback
