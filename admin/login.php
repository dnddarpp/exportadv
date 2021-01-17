<!DOCTYPE html>
<html>
	<head>
		<?php require_once('i_meta.php'); ?>
		<title></title>
	</head>
	<body>
		<script src='https://www.google.com/recaptcha/api.js'></script>
		<div class="adm_boxbg">
			<div class="amdin_wrapper">
				<div class="big_head"><img src="images_admin/login_big.svg"></div>
				<div class="admin_title">後台管理系統</div>
				<div class="use_bg">
					<form action=login.do method=post style=display:inline-block>
						<input type=hidden name=origin value="">
						<div class="enter_bar">
							<div class="enter_icon"><i class="mdi mdi-account"></i></div>
							<div class="enter_ipt"><input name="account" type="text" placeholder="請輸入帳號"/></div>
						</div>
						<div class="enter_bar">
							<div class="enter_icon"><i class="mdi mdi-key"></i></div>
							<div class="enter_ipt"><input name="password" type="password" placeholder="請輸入密碼"/></div>
						</div>
						<div class="log_fogt">
							<div class="save_card">
								<div class="g-recaptcha" data-sitekey="6LeNvGkUAAAAAOxUsCjfDxoVjcOmaWdEVVIFed04"></div>
							</div>
							<!--<div class="save_card"><img src="images_admin/eeev.jpg"></div>-->
							<div class="forget"><a href="#">忘記密碼?</a></div>
						</div>
						<div style=color:red;font-weight:bold;text-align:center></div>
						<div class="signin">
							<!-- <button class="edrt" style=display:block;width:100%;border:0px>登入
							</button> -->
              <a class="edrt" style="display:block;width:100%;border:0px" href="newslist">登入</a>
						</div>
					</form>
				</div>
			</div>
		</div>
    <script src="static/cindy.js"></script>
	</body>
</html>
