<?php 
header("Content-type:image/png");
//引入核心库文件
include "phpqrcode/phpqrcode.php";
include "function.php";
//定义纠错级别
$errorLevel = "Q";
//定义生成图片宽度和高度;默认为3
$size = "40";
//定义生成内容
$id = $_GET["id"];//*****************************用户号
// 获取用户信息
$str = "http://localhost:9092/getUserInfo?user_id=".$id;
$json = do_get_request($str);
$list = json_decode($json, true);
//判断有没有钱
if($list['valid']==true){
	//数据定义区*************************************
$arr = array('id'=>base64_encode($list['user_id']),'balance'=>base64_encode($list['cash']),'type'=>'self');
$content = json_encode($arr);



//调用QRcode类的静态方法png生成二维码图片
QRcode::png($content, 'QRcode.png', $errorLevel, $size,2);
//生成网址类型
//$url="www.baidu.com";
//$url.="\r\n";
//$url.="http://jingyan.baidu.com/article/acf728fd22fae8f8e510a3d6.html";
//$url.="\r\n";
//$url.="http://jingyan.baidu.com/article/92255446953d53851648f412.html";
//QRcode::png($url, false, $errorLevel, $size);


//在其中添加图片
$QR = imagecreatefrompng("QRcode.png");
$logo = imagecreatefrompng("1.png");
$QR_width = imagesx($QR);//二维码图片宽度   
$QR_height = imagesy($QR);//二维码图片高度   
$logo_width = imagesx($logo);//logo图片宽度   
$logo_height = imagesy($logo);//logo图片高度   
$logo_qr_width = $QR_width / 5;   
$scale = $logo_width/$logo_qr_width;   
$logo_qr_height = $logo_height/$scale;   
$from_width = ($QR_width - $logo_qr_width) / 2;   
//重新组合图片  
imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width,   
$logo_qr_height, $logo_width, $logo_height);
imagepng($QR);
}
else{
	$logo = imagecreatefrompng("1.png");
	imagepng($logo);
}


?>



