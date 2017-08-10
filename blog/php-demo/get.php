<?php
/**
 * 作用：示例类文件，仅供参考，客户需根据实际需求修改(get方式)
 * 作者： Edward
 * 时间：2015年12月1日
 */

class CallCenterApp{
	
	function __construct(){
		date_default_timezone_set("PRC");
		require 'config.php';
		foreach ($config as $key => $val){
			$this->$key = $val;
		}
		date_default_timezone_set("PRC");
		$timestamp = round(1000*microtime());
		if($timestamp < 100 && $timestamp > 9) $timestamp = '0'.$timestamp;
		elseif ($timestamp < 10) $timestamp = '00'.$timestamp;
		$this->time = date('YmdHis').$timestamp;
		$this->sign = strtolower(md5($this->sid.$this->time.$this->token));
	}
	
	/**
	 * 作用：处理并返回调用接口的结果(get方式)
	 * @param string $url 接口URL
	 * @return obj 数据对象
	 */
	function get_curl($url){
		$this->header = array(
			'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
			'Content-Type：application/x-www-form-urlencoded'
		);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->header);
		curl_setopt($ch, CURLOPT_URL, $url);
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
	 * 1.应用创建
	 * @param $nbr string 手机号码用逗号分隔';
	 * @param $appName string 应用名称';
	 * @return obj 数据对象
	 */
	function add($nbr,$appName){
		$data = array(
			'sid' => $this->sid,
			'token' => $this->token,
			'time' => $this->time,
			'sign' => $this->sign,
			'appName' => $appName,
			'notifyCallback' => $this->call_back,
			'nbr' => $nbr,
			'op' => 'ivr'
		);
		$qaram = http_build_query($data);
		$url = $this->maap_url.'add?'.$qaram;
		return $this->get_curl($url);
	}
	
	/**
	 * 2.应用删除
	 * @param $appId string 由add方法返回的appId
	 * @return obj 数据对象
	 */
	function del($appId){
		$data = array(
				'sid' => $this->sid,
				'token' => $this->token,
				'time' => $this->time,
				'sign' => $this->sign,
				'appId' => $appId,
				'op' => 'ivr'
		);
		$qaram = http_build_query($data);
		$url = $this->maap_url.'del?'.$qaram;
		return $this->get_curl($url);
	}
	
	/**
	 * 3.应用修改
	 * @param $appId string 由add方法返回的appId
	 * @param $nbr string 手机号码用逗号分隔，'13560757241,13560757242'；
	 * @return obj 数据对象
	 */
	function edit($appId,$nbr){
		$data = array(
			'sid' => $this->sid,
			'token' => $this->token,
			'time' => $this->time,
			'sign' => $this->sign,
			'appId' => $appId,
			'notifyCallback' => $this->call_back,
			'nbr' => $nbr,
			'op' => 'ivr'
		);
		$qaram = http_build_query($data);
		$url = $this->maap_url.'edit?'.$qaram;
		return $this->get_curl($url);
	}
	
	/**
	 * 4.应用查询
	 * @param $appId string 由add方法返回的appId
	 * @return obj 数据对象
	 */
	function get($appId){
		$data = array(
			'sid' => $this->sid,
			'token' => $this->token,
			'time' => $this->time,
			'sign' => $this->sign,
			'appId' => $appId
		);
		$qaram = http_build_query($data);
		$url = $this->maap_url.'get?'.$qaram;
		return $this->get_curl($url);
	}

	
	/**
	 * 5.上传文件
	 * @param $appId string 由add方法返回的appId
	 * @param $type int 数字0表示语音验证码，1表示语音通知；
	 * @param $file string 文件的绝对路径
	 * @return obj 数据对象
	 */
	function uploadFile($appId,$type,$file){
		if(!is_file($file)) return (object)array('res'=>false,'msg'=>'文件不存在！');
		$this->header = array(
			'Accept：text/plain, */*; q=0.01',
			'Content-Type：multipart/form-data'
		);
		$data = array(
			'sid' => $this->sid,
			'token' => $this->token,
			'time' => $this->time,
			'sign' => $this->sign,
			'appId' => $appId,
			'type' => $type,
			'file' => '@'.$file
		);
		$url = $this->uploadFile_url;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->header);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
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
	
}






















