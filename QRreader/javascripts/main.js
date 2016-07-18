//main_in
//传的id都是当作键
//window.atob是对应于php base64加密的解密
//window.atob是对应于php base64解密的加密
$(document).ready(function(){
	$('#reader').html5_qrcode(function(data){
			var obj = eval('(' + data + ')');
			//判断种类
			var type = obj.type;
			if(type == "gift"){
				//gift
				//进站提交站点、dift订单号
				//解密
				var balance = window.atob(obj.balance);
				var id = window.atob(obj.id);
				//显示闸机信息
				$('#read').html("余额:"+balance);
				//缓存进站消息
				$.post(
                        "http://localhost:9091/metroIn",
                        {
                            id:id,
							station:"南京南站"
                        },
                        function (data) {
                            $('#read_res').html(data);
							//var now = new Date(); 
							//var exitTime = now.getTime() + 1500; 
							//while (true) { 
							//now = new Date(); 
							//if (now.getTime() > exitTime) 
							//return; 
							//} 
                        },
                        "text");
			}
			else{
				//个人票
				var id = window.atob(obj.id);
				var balance = window.atob(obj.balance);
				$('#read').html(type+":"+id+",余额:"+balance);
				$.post(
                        "http://localhost:9091/metroIn",
                        {
                            id:id,
							station:"南京南站"
                        },
                        function (data) {
                            $('#read_res').html(data);
							//var now = new Date(); 
							//var exitTime = now.getTime() + 1500; 
							//while (true) { 
							//now = new Date(); 
							//if (now.getTime() > exitTime) 
							//return; 
							//} 
                        },
                        "text");
			}
		},
		function(error){
			//$('#read_error').html(error);
		}, function(videoError){
			//$('#vid_error').html(videoError);
		}
	);
});
