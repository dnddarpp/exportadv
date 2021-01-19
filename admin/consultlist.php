<?php
	require_once("include.php");

	//每頁顯示筆數

	$per = 20;
	$curpage = $conn->real_escape_string($_GET["page"]);
	$parent = $conn->real_escape_string($_GET["parent"]);

	$sql = "SELECT * FROM consult where 1=1 ";
	if(isset($_GET["parent"]) && strlen($parent)>0){
		$sql .= " and parent=".$parent." ";
	}
	$sql .= "ORDER BY `sort`, `id` DESC ";
	// echo $sql;
	$result = qury_sel($sql, $conn);

	$total = $result->num_rows;
	$pages = ceil($total/$per);

	if(!$curpage){
		$curpage=1;
	}
	$offset = ($curpage-1)*$per;
	$sql .= "Limit $per OFFSET $offset";
	$result = qury_sel($sql, $conn);

	$layer = 0;
	$dataary = array();
	$dataary = getConsultData(0,$conn);
	$str_dataary = json_encode($dataary);
?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('i_meta.php'); ?>
		<title></title>
		<script>
			var parent = "<?=$parent?>"
			$( document ).ready(function(){
				$("#parent").change(function(){
					var id = $(this).val()
					console.log("id:"+id)
					location.href="consultlist?parent="+id
				})
				$("#parent").val(parent)
			})

		</script>
	</head>
	<body>
		<?php require_once('i_header.php'); ?>
		<aside>
			<div class="side_wrapper">
				<?php require_once('i_menu.php'); ?>
				<div class="sidebar">
					<div class="right_continer">
						<div class="adsright_title">線上咨詢</div>

							<div class="news_manag">
								<div class="manag_box">選擇父層
									<select class="" name="" id="parent">
										<option value="">===請選擇===</option>
										<option value="0">最表層</option>
										<?php
											setSelect($dataary,$layer);
											 ?>
									</select>
								</div>
								<div class="manag_box">
									搜尋標題
									<div class="man_bord"><input name="title" value="" type="text" /></div>
								</div>
								<!-- <div class="manag_box">
									搜尋全文
									<div class="man_bord"><input name="title_content" value="" type="text" placeholder='標題或內容' /></div>
								</div> -->
                <div class="manag_box">
									關鍵字
									<div class="man_bord"><input name="title_content" value="" type="text" placeholder='關鍵字' /></div>
								</div>
								<br>
								<div class="btnwrap">
									<button class="delete_btn" id=search_btn>搜尋</button>
									<script>
										$('form').on('submit', function(){
										    $(this).attr('action', 'news.' + $(this).find('[name=class]:checked').val() + '.1');
										});
									</script>
								</div>
							</div>

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
									<!-- <td class="tab_gray" width="5%">刪除 -->
									<td class="tab_gray">標題
                  <td class="tab_gray">描述
									<td class="tab_gray" width="10%">更新日期
								<tr style='border-bottom:1px solid #f2f2f2'>
									<td><a href="consultedit?type=new&pid=<?=$parent?>"><i class="mdi mdi-plus-box"></i></a>
									<td>新增咨詢內容
									<td>
                  <td>
									<td>
								<?php
									while($data = mysqli_fetch_assoc($result)) {
										$display = "Y";
										if($data["display"]=="0"){
											$display = "N";
										}
										$last = new DateTime($data["Last_time"]);
										$update = $last->format('Y-m-d');
								?>
								<tr>
									<td><a href="consultedit?id=<?=$data["id"]?>"><i class="mdi mdi-file-document-edit"></i></a>
									<!-- <td><a href=consultedit data-method=post data-param='{"id":118,"act":"display"}'><i class="mdi mdi-eye"></i></a> -->
									<!-- <td><a href=consultedit data-method=post data-param='{"id":118,"act":"delete"}' data-confirm=確定要刪除嗎? data-done=reload><i class="mdi mdi-delete"></i></a> -->
									<td><?=$data["title"]?>
                  <td><?=$data["description"]?>
									<td><?=$update?>
								<?php } ?>
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
