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
							<div class="adsright_title">線上咨詢-編輯</div>
							<div class="media_bg">
								<table width="100%" border="0">
									<tr>
										<td width="160">顯示
										<td>
											<label style=font-weight:normal><input name="display" type="radio" value=1 checked/> 顯示</label>
											<label style=font-weight:normal><input name="display" type="radio" value=0 /> 隱藏</label>
                  <tr>
                    <td width="160">請選擇父層
										<td>
                      <div class="manag_box">選擇父層
      									<select class="" name="">
                          <option value="">===請選擇===</option>
                        </select>
      								</div>
                  <tr>
										<td width="160">最終頁
										<td>
											<label style=font-weight:normal><input name="pageend" type="radio" value=1 checked/> 是</label>
											<label style=font-weight:normal><input name="pageend" type="radio" value=0 /> 否</label>
									<tr>
										<td>標題
										<td>
											<div class="media_bord"><input name="title" type="text" value="" placeholder="" /></div>
                  <tr>
										<td>描述
										<td>
											<div class="media_bord"><input name="title" type="text" value="" placeholder="" /></div>
                  <tr>
										<td>內容
										<td>
											<textarea name="name" rows="8" cols="80"></textarea>
									<tr>
										<td>SEO description
										<td>
											<div class="media_bord"><input name="seo_description" type="text" value="" /></div>
									<tr>
										<td>SEO keywords
										<td>
											<div class="media_bord"><input name="seo_keywords" type="text" value="" /></div>
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
