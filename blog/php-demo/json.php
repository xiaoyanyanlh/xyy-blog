<?php
/**
 * 作用：示例类文件，仅供参考，客户需根据实际需求修改
 * 作者： Edward
 * 时间：2015年11月24日
 * 备注：示例中，大部分方法都是将提交的数据封装在对应的方法中，但实际应用中，为了方便修改数据，
 * 		开发者可将数据放在方法外，传递给方法即可。如方法4(创建技能组);
 */
class CallCenter{
	
	function __construct(){
		date_default_timezone_set("PRC");
		require 'config.php';
		foreach ($config as $key => $val){	//此处写法为个人习惯，可直接使用$config数组
			$this->$key = $val;
		}
		$this->datetime = date('YmdHis');
		$this->sig = strtoupper(md5($this->sid.$this->token.$this->datetime));
	}
	
	/**
	 * 作用：处理并返回调用接口的结果（json格式）
	 * @param string $url 接口URL
	 * @param array $data 接口规定要传递的数据
	 * @return obj 数据对象
	 */
	function json_curl($url,$data){
		$header1 = 'Authorization:'.base64_encode($this->sid.':'.$this->datetime);
		$this->header = array('Content-type:application/json;charset=utf-8',$header1,'Accept:application/json');
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->header);
		curl_setopt($ch, CURLOPT_URL, $url);
		if(strtolower(substr($url,0,5)) == 'https'){
			//$location = 'D:/Program Files/wamp/wamp/www/example/call_center/';	//证书绝对地址
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);	//信任任何证书;
			//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);	//只信任颁发的证书;
			//curl_setopt($ch, CURLOPT_CAINFO, $location.'call_center.cer');	//颁发的受信任的证书
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);	//检查证书中是否设置域名,0不验证;
		}
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		$output = curl_exec($ch);
		$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($status != 200){
			$output = (object)array(
				'status' => $status,
				'errno' => curl_errno($ch),
				'error' => curl_error($ch)
			);
		}else{
			$output = json_decode($output);
		}
		curl_close($ch);
		return $output;
	}
	
	/**
	 * 1.坐席申请
	 * @param $data array 请求参数;
	 * @return obj 数据对象
	 */
	function clients($data){
		$url = $this->rest_url.'Clients?sig='.$this->sig;
		return $this->json_curl($url,$data);
	}
	
	/**
	 * 2.坐席释放
	 * @param $appId 该应用ID为get.php或post.php中add方法返回结果;
	 * @param $clientNumber 申请坐席返回结果中的'clientNumber';
	 * @return obj 数据对象
	 */
	function dropClient($appId,$clientNumber){
		$data = array(
			'client' => array(
				'appId' => $appId,
				'clientNumber' => $clientNumber,
			)
		);
		$url = $this->rest_url.'dropClient?sig='.$this->sig;
		return $this->json_curl($url, $data);
	}
	
	/**
	 * 3.坐席查询(只能使用get方式，因此要另外写成一个单独的方法)
	 * @param $appId 该应用ID为get.php或post.php中add方法返回结果;
	 * @param $clientNumber 申请坐席返回结果中的'clientNumber';
	 * @return obj 数据对象
	 */
	function queryClient($appId,$clientNumber){
		$header1 = 'Authorization:'.base64_encode($this->sid.':'.$this->datetime);
		$this->header = array('Content-type:application/json;charset=utf-8',$header1,'Accept:application/json');
		$data = array(
			'appId' => $appId,
			'clientNumber' => $clientNumber
		);
		$url = $this->rest_url.'Clients?sig='.$this->sig.'&'.http_build_query($data);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->header);
		curl_setopt($ch, CURLOPT_URL, $url);
		if(strtolower(substr($url,0,5)) == 'https'){
			//$location = 'D:/Program Files/wamp/wamp/www/example/call_center/';	//证书绝对地址
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);	//信任任何证书;
			//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);	//只信任颁发的证书;
			//curl_setopt($ch, CURLOPT_CAINFO, $location.'call_center.cer');	//颁发的受信任的证书
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);	//检查证书中是否设置域名,0不验证;
		}
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($status != 200){
			$output = (object)array(
				'status' => $status,
				'errno' => curl_errno($ch),
				'error' => curl_error($ch)
			);
		}else{
			$output = json_decode($output);
		}
		curl_close($ch);
		return $output;
	}
	
	/**
	 * 4.创建技能组
	 * @param $data 请求参数数组;
	 * @return obj 数据对象
	 */
	function create($data){
		$url = $this->ipcc_url.'queue/create?sig='.$this->sig;
		return $this->json_curl($url, $data);
	}
	
	/**
	 * 5.修改技能组
	 * @param $data 请求参数数组;
	 * @return obj 数据对象
	 */
	function edit($data){
		$url = $this->ipcc_url.'queue/edit?sig='.$this->sig;
		return $this->json_curl($url, $data);
	}
	
	/**
	 * 6.删除技能组
	 * @param int $queueId 请求参数数组;
	 * @return obj 数据对象
	 */
	function del($queueId){
		$data = array(
			'ivr' => array(
				'appId' => $this->appId,
				'queueId' => $queueId,
			)
		);
		$url = $this->ipcc_url.'queue/del?sig='.$this->sig;
		return $this->json_curl($url, $data);
	}
	
	/**
	 * 7.查询技能组
	 * @param int $queueId 技能组ID;
	 * @return obj 数据对象
	 */
	function get($queueId){
		$data = array(
			'ivr' => array(
				'appId' => $this->appId,
				'queueId' => $queueId,
			)
		);
		$url = $this->ipcc_url.'queue/get?sig='.$this->sig;
		return $this->json_curl($url, $data);
	}
	
	/**
	 * 8.坐席接入
	 * @param $data 请求参数数组;
	 * @return obj 数据对象
	 */
	function on($data){
		$url = $this->ipcc_url.'service/on?sig='.$this->sig;
		return $this->json_curl($url, $data);
	}
	
	/**
	 * 9.坐席签出
	 * @param $data 请求参数数组;
	 * @return obj 数据对象
	 */
	function off($data){
		$url = $this->ipcc_url.'service/off?sig='.$this->sig;
		return $this->json_curl($url, $data);
	}
	
	/**
	 * 10.设置坐席接听方式
	 * @param $data 请求参数数组;
	 * @return obj 数据对象
	 */
	function setMode($data){
		$url = $this->ipcc_url.'service/setMode?sig='.$this->sig;
		return $this->json_curl($url, $data);
	}
	
	/**
	 * 11.设置坐席状态
	 * @param $data 请求参数数组;
	 * @return obj 数据对象
	 */
	function setStatus($data){
		$url = $this->ipcc_url.'service/setStatus?sig='.$this->sig;
		return $this->json_curl($url, $data);
	}
	
	/**
	 * 12.查询坐席状态
	 * @param $data 请求参数数组;
	 * @return obj 数据对象
	 */
	function status($data){
		$url = $this->ipcc_url.'service/status?sig='.$this->sig;
		return $this->json_curl($url, $data);
	}
	
	/**
	 * 13.查询所有坐席状态
	 * @param $data 请求参数数组;
	 * @return obj 数据对象
	 */
	function statusall($data){
		$url = $this->ipcc_url.'service/statusall?sig='.$this->sig;
		return $this->json_curl($url, $data);
	}
	
	/**
	 * 14.查询所有技能组接口
	 * @return obj 数据对象
	 */
	function getall(){
		$data = array(
			'ivr' => array(
				'appId' => $this->appId,
			)
		);
		$url = $this->ipcc_url.'queue/getall?sig='.$this->sig;
		return $this->json_curl($url, $data);
	}
	
	/**
	 * 15.呼叫应答接口
	 * @return $callId string 被叫号码
	 * @return $ansCode int 数字0为接听，1为拒绝；
	 * @return obj 数据对象
	 */
	function reply($callId,$ansCode){
		$data = array(
			'ivr' => array(
				'appId' => $this->appId,
				'callId' => $callId,
				'ansCode' => $ansCode
			)
		);
		$url = $this->ipcc_url.'call/reply?sig='.$this->sig;
		return $this->json_curl($url, $data);
	}
	
	/**
	 * 16.获取DTMF按键
	 * @return $data 参数数组
	 * @return obj 数据对象
	 */
	function dtmf($data){
		$url = $this->ipcc_url.'service/dtmf?sig='.$this->sig;
		return $this->json_curl($url, $data);
	}
	
	/**
	 * 17.播放语音
	 * @return $data 参数数组
	 * @return obj 数据对象
	 */
	function play($data){
		$url = $this->ipcc_url.'call/play?sig='.$this->sig;
		return $this->json_curl($url, $data);
	}
	
	/**
	 * 18.播放TTS
	 * @return $data 参数数组
	 * @return obj 数据对象
	 */
	function playTts($data){
		$url = $this->ipcc_url.'call/playTts?sig='.$this->sig;
		return $this->json_curl($url, $data);
	}
	
	/**
	 * 19.挂机命令
	 * @return $callId string 被叫号码
	 * @return obj 数据对象
	 */
	function hangUp($callId){
		$data = array(
			'ivr' => array(
				'appId' => $this->appId,
				'callId' => $callId
			)
		);
		$url = $this->ipcc_url.'call/hangUp?sig='.$this->sig;
		return $this->json_curl($url, $data);
	}
	
	/**
	 * 20.留言
	 * @return $data 参数数组
	 * @return obj 数据对象
	 */
	function message($data){
		$url = $this->ipcc_url.'call/message?sig='.$this->sig;
		return $this->json_curl($url, $data);
	}
	
	/**
	 * 21.入队
	 * @return $data 参数数组
	 * @return obj 数据对象
	 */
	function enqueue($data){
		$url = $this->ipcc_url.'queue/enqueue?sig='.$this->sig;
		return $this->json_curl($url, $data);
	}
	
	/**
	 * 22.结束呼叫转IVR
	 * @return $data 参数数组
	 * @return obj 数据对象
	 */
	function call2Ivr($data){
		$url = $this->ipcc_url.'call/call2Ivr?sig='.$this->sig;
		return $this->json_curl($url, $data);
	}
	
	/**
	 * 23.结束呼叫
	 * @return $callId 被叫号码
	 * @return obj 数据对象
	 */
	function disConnect($callId){
		$data = array(
			'ivr' => array(
				'appId' => $this->appId,
				'callId' => $callId
			)
		);
		$url = $this->ipcc_url.'call/disConnect?sig='.$this->sig;
		return $this->json_curl($url, $data);
	}
	
	/**
	 * 24.发起呼叫
	 * @return $data 参数数组
	 * @return obj 数据对象
	 */
	function outCall($data){
		$url = $this->ipcc_url.'call/outCall?sig='.$this->sig;
		return $this->json_curl($url, $data);
	}
	
}

