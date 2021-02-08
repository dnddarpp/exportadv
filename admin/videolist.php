<?php
	require_once("include.php");

	//每頁顯示筆數

	$per = 30;
	$curpage = $conn->real_escape_string($_GET["page"]);

	$sql = "SELECT a.*, b.catename FROM media as a left join media_cate as b on a.type = b.id where 1=1 ORDER BY  `sort` desc, `id` DESC ";
	$result = qury_sel($sql, $conn);

	$total = $result->num_rows;
	$pages = ceil($total/$per);

	if(!$curpage){
		$curpage=1;
	}
	$offset = ($curpage-1)*$per;
	$sql .= "Limit $per OFFSET $offset";
	$result = qury_sel($sql, $conn);
?>
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
						<div class="adsright_title">影音專區</div>
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
									<td class="tab_gray" width="5%">顯示
									<td class="tab_gray" width="5%">排序
									<!-- <td class="tab_gray" width="5%">刪除 -->
									<td class="tab_gray" width="45%">影音名稱
									<td class="tab_gray" width="15%">分類
                  <td class="tab_gray">連結
									<td class="tab_gray" width="10%">更新日期
								<tr style='border-bottom:1px solid #f2f2f2'>
									<td><a href=videoedit><i class="mdi mdi-plus-box"></i></a>
									<td>
									<td>新增影音
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
									<td><a href="videoedit?id=<?=$data["id"]?>"><i class="mdi mdi-file-document-edit"></i></a>
									<td><?=$display?>
									<td><?=$data["sort"]?></td>
									<!-- <td><a href=videoedit data-method=post data-param='{"id":118,"act":"display"}'><i class="mdi mdi-eye"></i></a> -->
									<!-- <td><a href=videoedit data-method=post data-param='{"id":118,"act":"delete"}' data-confirm=確定要刪除嗎? data-done=reload><i class="mdi mdi-delete"></i></a> -->
									<td><?=$data["title"]?>
										<td><?=$data["catename"]?>
                  <td><a data-fancybox href="<?=$data["url"]?>"><?=$data["url"]?></a>
									<td><?=$update?>
									<?php } ?>
							</table>
						</div>
						<div class="page_box">
							<?php
								for($m=1;$m<=$pages;$m++){
									if($m==$curpage){
											echo "<a href=\"videolist.php?&page=".$m."\" class=\"dkeb page_active\">$m</a>";
									}else{
											echo "<a href=\"videolist.php?&page=".$m."\" class=\"dkeb\">$m</a>";
									}
								}
							 ?>
						</div>
					</div>
				</div>
			</div>
		</aside>
		<?php require_once('i_footer.php'); ?>
	</body>
</html>
