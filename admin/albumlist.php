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
						<div class="adsright_title">活動照片</div>
						<!-- <form>
							<div class="news_manag">
								<div class="manag_box">
									發布時間
									<input name="btime" type="text" value="" class=datepicker-input style='border:1px solid #ccc' />  -
									<input name="etime" type="text" value="" class=datepicker-input style='border:1px solid #ccc' />
								</div>
								<div class="manag_box">選擇分類
									<label><input name=class type=radio value=0 > 不限</label>
									<label><input name=class type=radio value=1 checked>最新消息</label>
									<label><input name=class type=radio value=2 >產業公告</label>
								</div>
								<div class="manag_box">
									搜尋標題
									<div class="man_bord"><input name="title" value="" type="text" /></div>
								</div>
								<div class="manag_box">
									搜尋全文
									<div class="man_bord"><input name="title_content" value="" type="text" placeholder='標題或內容' /></div>
								</div>
								<div class="btnwrap">
									<button class="delete_btn" id=search_btn>搜尋</button>
									<script>
										$('form').on('submit', function(){
										    $(this).attr('action', 'news.' + $(this).find('[name=class]:checked').val() + '.1');
										});
									</script>
								</div>
							</div>
						</form> -->
						<div class="icon_dk">
							<ul>
								<li><i class="mdi mdi-view-headline"></i></li>
								<li><i class="mdi mdi-view-list"></i></li>
							</ul>
						</div>
						<div class="news_table">
							<table width="100%" border="0">
								<tr>
									<td class="tab_gray" width="5%">編輯
									<!-- <td class="tab_gray" width="5%">顯示 -->
									<td class="tab_gray" width="5%">刪除
									<td class="tab_gray">活動名稱
									<td class="tab_gray" width="5%">發佈日期
								<tr style='border-bottom:1px solid #f2f2f2'>
									<td><a href=albumedit><i class="mdi mdi-plus-box"></i></a>

									<td>
									<td>新增活動
									<td>
								<tr>
									<td><a href="albumedit"><i class="mdi mdi-file-document-edit"></i></a>
									<!-- <td><a href=albumedit data-method=post data-param='{"id":118,"act":"display"}'><i class="mdi mdi-eye"></i></a> -->
									<td><a href=albumedit data-method=post data-param='{"id":118,"act":"delete"}' data-confirm=確定要刪除嗎? data-done=reload><i class="mdi mdi-delete"></i></a>
									<td>test
									<td>2020.11.02
								<tr>
									<td><a href="albumedit"><i class="mdi mdi-file-document-edit"></i></a>
									<!-- <td><a href=albumedit data-method=post data-param='{"id":118,"act":"display"}'><i class="mdi mdi-eye"></i></a> -->
									<td><a href=albumedit data-method=post data-param='{"id":118,"act":"delete"}' data-confirm=確定要刪除嗎? data-done=reload><i class="mdi mdi-delete"></i></a>
									<td>test
									<td>2020.11.02
								<tr>
									<td><a href="albumedit"><i class="mdi mdi-file-document-edit"></i></a>
									<!-- <td><a href=albumedit data-method=post data-param='{"id":118,"act":"display"}'><i class="mdi mdi-eye"></i></a> -->
									<td><a href=albumedit data-method=post data-param='{"id":118,"act":"delete"}' data-confirm=確定要刪除嗎? data-done=reload><i class="mdi mdi-delete"></i></a>
									<td>test
									<td>2020.11.02
								<tr>
									<td><a href="albumedit"><i class="mdi mdi-file-document-edit"></i></a>
									<!-- <td><a href=albumedit data-method=post data-param='{"id":118,"act":"display"}'><i class="mdi mdi-eye"></i></a> -->
									<td><a href=albumedit data-method=post data-param='{"id":118,"act":"delete"}' data-confirm=確定要刪除嗎? data-done=reload><i class="mdi mdi-delete"></i></a>
									<td>test
									<td>2020.11.02
							</table>
						</div>
						<div class="page_box">
							<div class="dkeb page_active">1</div>
						</div>
					</div>
				</div>
			</div>
		</aside>
		<?php require_once('i_footer.php'); ?>
	</body>
</html>
