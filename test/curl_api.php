<?php
	class curl{
		//curl连接的实例
		private $instance;
		//请求的类型，1为json
		private $type;

		public function __construct(){
			$this->instance = curl_init();
			//echo "Create an instance.";
		}

		public function __destruct(){
			curl_close($this->instance);
			//echo "<br>Destroy the instance.";
		}

		public function total_set($UA, $address, $paras, $type){
			curl_setopt($this->instance,	CURLOPT_URL,			$address. $paras); 
			curl_setopt($this->instance,	CURLOPT_RETURNTRANSFER,	true); 
			curl_setopt($this->instance,	CURLOPT_USERAGENT,		$UA);
			$this->type = $type;
			//echo "<br>Request url is  : <strong>". $address . $paras . "</strong><br>";
		}
		
		public function request(){
			$result = curl_exec($this->instance);
			if($this->type == 1){
				//JSON格式
				$result = json_decode($result, true);
			}
			return $result;
		}
	}
	
	//设置处理脚本的预留时间,0表示没有时间限制
	set_time_limit(1);
	header("Content-Type: text/html;charset=utf-8");

	//检查2000积分房
	$check2000 = new curl();

	$HTTP_Address="http://m.7daysinn.cn/q/inns?"; 
	$HTTP_Params="cityId=2&fromDate=" .$_GET['date']. "&days=1&getQuota=true&bookingMode=point"; 
	
	$user_agent = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_4) AppleWebKit/537.77.4 (KHTML, like Gecko) Version/7.0.5 Safari/537.77.4";
	//$user_agent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322; .NET CLR 2.0.50727)";
	$check2000->total_set($user_agent, $HTTP_Address, $HTTP_Params, 1);
	$result = $check2000->request();
	//$json = array();
	$normal;
	//$cur = 0;
	while(list($key,$val)= each($result['content'])) {
		$has2000 = false;
		$isNear = false;
		$isGood = false;
		if($val['districtName'] == "海淀区")
			$isNear = true;
		if(intval($val['lowestPrice'])-160 > 0)
			$isGood = true;
		foreach($val['currentActivities'] as $act){
			if($act == "P2000"){
				$has2000 = true;
				break;
			}
		}

		if($has2000 && $isGood && $isNear){
			$normal .= "店名: ". $val['name'];
			$normal .= ", 最低价: ". $val['lowestPrice'];
			$normal .= ", 区域: ". $val['districtName'];
			/*
			$json[$cur]['name'] = $val['name'];
			$json[$cur]['lowestPrice'] = $val['lowestPrice'];
			$json[$cur]['districtName'] = $val['districtName'];
			$cur++;
			*/
		}
	}
	//print_r($json);
	echo $normal;
?>
