<?php 
header("Content-type:image/png");
//������Ŀ��ļ�
include "phpqrcode/phpqrcode.php";
include "function.php";
//���������
$errorLevel = "Q";
//��������ͼƬ��Ⱥ͸߶�;Ĭ��Ϊ3
$size = "40";
//������������
//����Ʊ�������Ϣ
$balance = $_GET["bal"];
$id = $_GET["id"];//*******************************************������
//���ݶ�����*************************************��Ϣ���ܹ�
$arr = array('id'=>$id,'balance'=>$balance,'discount'=>base64_encode('1'),'type'=>'gift');
$content = json_encode($arr);



//����QRcode��ľ�̬����png���ɶ�ά��ͼƬ
QRcode::png($content, 'GiftQRcode.png', $errorLevel, $size,2);
//������ַ����
//$url="www.baidu.com";
//$url.="\r\n";
//$url.="http://jingyan.baidu.com/article/acf728fd22fae8f8e510a3d6.html";
//$url.="\r\n";
//$url.="http://jingyan.baidu.com/article/92255446953d53851648f412.html";
//QRcode::png($url, false, $errorLevel, $size);


//���������ͼƬ
$QR = imagecreatefrompng("GiftQRcode.png");
$logo = imagecreatefrompng("1.png");
$QR_width = imagesx($QR);//��ά��ͼƬ���   
$QR_height = imagesy($QR);//��ά��ͼƬ�߶�   
$logo_width = imagesx($logo);//logoͼƬ���   
$logo_height = imagesy($logo);//logoͼƬ�߶�   
$logo_qr_width = $QR_width / 5;   
$scale = $logo_width/$logo_qr_width;   
$logo_qr_height = $logo_height/$scale;   
$from_width = ($QR_width - $logo_qr_width) / 2;   
//�������ͼƬ  
imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width,   
$logo_qr_height, $logo_width, $logo_height);
imagepng($QR);
?>