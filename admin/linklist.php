<?php
	require_once("include.php");

	//每頁顯示筆數

	$per = 30;
	$curpage = $conn->real_escape_string($_GET["page"]);

	$sql = "SELECT a.*, b.catename FROM link as a left join link_cate as b on a.type = b.id where 1=1 ORDER BY  `sort` desc, `id` DESC ";
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
						<div class="adsright_title">政府輔導資源</div>
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
									<td class="tab_gray" width="30%">名稱
									<td class="tab_gray" width="20%">分類
                  <td class="tab_gray">連結
									<td class="tab_gray" width="15%">更新日期
								<tr style='border-bottom:1px solid #f2f2f2'>
									<td><a href=linkedit><i class="mdi mdi-plus-box"></i></a>
									<td>
									<td colspan="2">新增連結
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
									<td><a href="linkedit?id=<?=$data["id"]?>"><i class="mdi mdi-file-document-edit"></i></a>
									<td><?=$display?>
									<td><?=$data["sort"]?></td>
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
											echo "<a href=\"linklist.php?&page=".$m."\" class=\"dkeb page_active\">$m</a>";
									}else{
											echo "<a href=\"linklist.php?&page=".$m."\" class=\"dkeb\">$m</a>";
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
