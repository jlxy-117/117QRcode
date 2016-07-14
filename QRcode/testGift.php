<!DOCTYPE html>
<?php
	$balance = base64_encode($_GET['balance']);
	//订单号
	$ticket_id = base64_encode($_GET['id']);
?>
<html>
  <head>
    <meta charset="utf-8">
    <title>礼物二维码测试</title>
    <style media="screen">

    </style>
  </head>
  <body>
    <div style="width:200px;height:250px;margin:200px auto;">
      <span style="text-align:center;display:block;">礼物二维码测试</span>
      <div class="container" style="border:1px dashed #000;width:200px;height:200px;">
        <img src="<?php echo 'GiftQRCode.php?bal='.$balance."&&id=".$ticket_id ?>" alt="hahaha" width="200" height="200" />
      </div>
    </div>
  </body>
</html>
