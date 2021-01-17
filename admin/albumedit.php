<!DOCTYPE html>
<html>
	<head>
		<?php require_once('i_meta.php'); ?>
		<title></title>
	</head>
	<body>
		<?php require_once('i_header.php'); ?>
		<aside>
			<div class="side_wrapper">
				<?php require_once('i_menu.php'); ?>
				<div class="sidebar">
					<div class="right_continer">
						<script src=ckeditor5-build-classic/ckeditor.js></script>
						<form action=news_more.do method=post data-ajax=true>
							<input type=hidden name=id value=109>
							<div class="adsright_title">活動照片-編輯</div>
							<div class="media_bg">
								<table width="100%" border="0">
									<tr>
										<td width="160">顯示
										<td>
											<label style=font-weight:normal><input name="display" type="radio" value=1 checked/> 顯示</label>
											<label style=font-weight:normal><input name="display" type="radio" value=0 /> 隱藏</label>
									<tr>
										<td>發佈日期
										<td>
											<div class="media_bord"><input name="time" type="text" class=datepicker-input value="" /></div>
									<tr>
										<td>標題
										<td>
											<div class="media_bord"><input name="title" type="text" value="" placeholder=中文 /></div>
									<tr>
										<td>SEO description
										<td>
											<div class="media_bord"><input name="seo_description" type="text" value="" /></div>
									<tr>
										<td>SEO keywords
										<td>
											<div class="media_bord"><input name="seo_keywords" type="text" value="" /></div>
									<tr>
										<td>檔案上傳<br>
										<td><input type="file" name="" value="">
								</table>
							</div>
							<div class=msg></div>
							<div class="btnwrap">
								<button class="delete_btn" name=submit>送出</button>
							</div>
							<div class="btnwrap">
								<button class="delete_btn" name=cancel>返回</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</aside>
		<?php require_once('i_footer.php'); ?>
	</body>
</html>
