<?php
	//默认去找4天后的酒店
	if(!isset($_GET['date'])){
		date_default_timezone_set('Asia/Shanghai');
		$query_date = date('y-m-d', time()+4*60*60*24);
	}
?>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>七天2000积分页面查询</title>
<!-- 新 Bootstrap 核心 CSS 文件 -->
<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.2.0/css/bootstrap.min.css">

<!-- 可选的Bootstrap主题文件（一般不用引入） -->
<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">

<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>

</head>
<body>

<br><br>

<div class="container-fluid">
	<div class="col-xs-6 col-md-2"></div>
	<div class="col-xs-6 col-md-8">
		<button class="btn btn-primary btn-lg btn-block">发起请求</button>
		<br>
			<div class="input-group input-group-lg">
			<span class="input-group-addon">当前查询日期: </span>
			<input type="text" class="form-control" placeholder="date">
			</div>
			<br>
		<div class='alert alert-success' role='alert'>查询成功</div>
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
	//在html中已经设置
	//header("Content-Type: text/html;charset=utf-8");

	//检查2000积分房
	$check2000 = new curl();

	$HTTP_Address="http://m.7daysinn.cn/q/inns?"; 
	$HTTP_Params="cityId=2&fromDate=" .$query_date. "&days=1&getQuota=true&bookingMode=point"; 
	
	$user_agent = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_4) AppleWebKit/537.77.4 (KHTML, like Gecko) Version/7.0.5 Safari/537.77.4";
	//$user_agent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322; .NET CLR 2.0.50727)";
	$check2000->total_set($user_agent, $HTTP_Address, $HTTP_Params, 1);
	$result = $check2000->request();
	$final_result;
	//合适的价格分界线
	$price_bound = 160;
	while(list($key,$val)= each($result['content'])) {
		$has2000 = false;
		$districtOrder = 0;
		$isGoodPrice = false;
		if($val['districtName'] == "海淀区")
			$districtOrder = 10;
		else if($val['districtName'] == "朝阳区")
			$districtOrder = 5;
		else
			$districtOrder = 1;
		
		if (intval($val['lowestPrice'])- $price_bound > 0)
			$isGoodPrice = true;
		foreach($val['currentActivities'] as $act){
			if($act == "P2000"){
				$has2000 = true;
				break;
			}
		}

		if($has2000 && $isGoodPrice){
			$final_result[$districtOrder][] = array("price" => $val['lowestPrice'], "name" => $val['name'], "district" => $val['districtName']);
		}
	}
?>
		<table class ="table table-bordered">
		<thead>
			<td>店名</td>
			<td>最低价</td>
			<td>所属区域</td>
		</head>
		<tbody>
<?php
	//遍历结果数组
	if(!count($final_result) == 0)
		sort($final_result);
	for($i = 0; $i< count($final_result); $i++){
		rsort($final_result[$i]);
		for($j = 0; $j < count($final_result[$i]); $j++){
			echo "<tr><td>" .$final_result[$i][$j]['name']. "</td><td>" .$final_result[$i][$j]['price']. "</td><td>" .$final_result[$i][$j]['district']. "</td></tr>";
		}
	}
?>
		</tbody>
		</table>
	</div>
	<div class="col-xs-6 col-md-2"></div>
</div>

<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="http://cdn.bootcss.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

</body>
</html>
<?php
//垃圾代码
	/*
	function _rand() { 
		$length=26; 
		$chars = "0123456789abcdefghijklmnopqrstuvwxyz"; 
		$max = strlen($chars) - 1; 
		mt_srand((double)microtime() * 1000000); 
		$string = ''; 
		for($i = 0; $i < $length; $i++) { 
			$string .= $chars[mt_rand(0, $max)]; 
		} 
		return $string; 
	}

	样例数据
	[0]=> array(18) { ["innId"]=> int(663) ["name"]=> string(34) "7天北京石景山古城首钢店" ["firstCharsOfPinyin"]=> string(10) "7TSJSGCSGD" ["cityId"]=> int(2) ["cityName"]=> string(6) "北京" ["districtId"]=> int(12) ["districtName"]=> string(12) "石景山区" ["address"]=> string(37) "北京市石景山区古城西街5号" ["score"]=> float(0.945) ["orderWeight"]=> float(0.84749997) ["thumbnailPath"]=> string(79) "http://img1.plateno.com/inn/010059/e85b8456420a25e760110b65d7b6bff7_120_120.jpg" ["lowestPrice"]=> float(177) ["hasRoom"]=> bool(true) ["hasWifi"]=> bool(true) ["hasPark"]=> bool(true) ["canUseCashCoupon"]=> bool(true) ["brandId"]=> int(1) ["currentActivities"]=> array(4) { [0]=> string(2) "77" [1]=> string(5) "P5000" [2]=> string(2) "99" [3]=> string(5) "P7000" } }

	*/
?>
