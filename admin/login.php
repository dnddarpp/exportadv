<?php
  require_once('include_no.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('i_meta.php'); ?>
		<title></title>
		<script type="text/javascript">
    function login(){
			var captcha =  grecaptcha.getResponse()
			if(captcha==""){
				alert("驗證錯誤！請確認您不是機器人")
				return
			}
    	$.ajax({
    		url: 'login_check.php',
    		data: { mid: $("#mid").val(), pw: $("#pw").val() },
    		type: 'POST',
    		success: function(msg){
    			if(msg.indexOf("success")>=0){
          			alert("登入成功")
          			location.href = "newslist.php"
          	    }else{
          	    	alert(msg)
          	    	$("#mid").val("");
    				$("#pw").val("");
          	    }
    		},
    		error: function(){
    			alert("發生錯誤，請重試或洽資訊人員");
    			$("#mid").val("");
    			$("#pw").val("");
    		}
    	});
    }
    $(function(){
    	$("#btn").click(login);
    	$("#mid").keydown(function(event){
    		if( event.keyCode == "13" ){
    			$("#pw").focus();
    		}
    	});
    	$("#pw").keydown(function(event){
    		if (event.keyCode == "13"){
    			login();
    		}
    	});
    });
    </script>
	</head>
	<body>
		<script src='https://www.google.com/recaptcha/api.js'></script>
		<div class="adm_boxbg">
			<div class="amdin_wrapper">
				<div class="big_head"><img src="images_admin/login_big.svg"></div>
				<div class="admin_title">後台管理系統</div>
				<div class="use_bg">
						<input type=hidden name=origin value="">
						<div class="enter_bar">
							<div class="enter_icon"><i class="mdi mdi-account"></i></div>
							<div class="enter_ipt"><input name="account" id="mid" type="text" placeholder="請輸入帳號"/></div>
						</div>
						<div class="enter_bar">
							<div class="enter_icon"><i class="mdi mdi-key"></i></div>
							<div class="enter_ipt"><input name="password" id="pw" type="password" placeholder="請輸入密碼"/></div>
						</div>
						<div class="log_fogt">
							<div class="save_card">
								<div class="g-recaptcha" data-sitekey="6LefgjAaAAAAAMuxb6ICTlhgegI70YTa_ngN5CcV"></div>
							</div>
							<!-- <div class="forget"><a href="#">忘記密碼?</a></div> -->
						</div>
						<div style=color:red;font-weight:bold;text-align:center></div>
						<div class="signin">
              <a class="edrt" style="display:block;width:100%;border:0px" id="btn">登入</a>
						</div>
				</div>
			</div>
		</div>
	</body>
</html>
