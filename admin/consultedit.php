<?php
	require_once('include.php');
	$mid = $_SESSION["mng_mid"];
	$id = $conn->real_escape_string($_GET["id"]);

	$layer = 0;
	if($id){
	  $sql = "select *  from `consult` where 1=1 and id = $id ";
	  $pjdata = qury_sel($sql, $conn);
	  $data = mysqli_fetch_assoc($pjdata);
	$parent = $data["parent"];
	  $type="edit";
	  $typename="編輯";
	}else{
	  $type="add";
	  $id="";
	  $typename="新增";
	}

	$dataary = array();
	$dataary = getConsultData(0,$conn);
	$str_dataary = json_encode($dataary);
	// echo json_encode($dataary);
	?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('i_meta.php'); ?>
		<title></title>
		<script type="text/javascript">
			var pagetype = "<?=$type?>"
			var dataary = <?=$str_dataary?>
			$(function(){
			 if(pagetype=="add"){
			   $("#title").val("")
			   $("#description").val("")
			 }
			 $("#date").datepicker({dateFormat: 'yy-mm-dd'})
			 if(pagetype=="add"){
				$("#date").datepicker("setDate", new Date());
			}
			 $("#delete").click(function(){
				if(confirm("確定要刪除資料嗎？")){
						myDelete( 'news', 'id', '<?=$data["id"]?>' ,"newslist.php?page=<?=$getpage?>&type=<?=$typeid?>");
				}else{

				}
			})
			 $("#save").click(function(){

			   //console.log(cnt);
				if($("#title").val() == "")
					alert("請輸入標題");
			   else if($("#description").val() == "")
			 			alert("請輸入概描");
				else if($("#date").val() == "")
					alert("請輸入日期");
				else if(cnt == "")
					alert("請輸入內文");
				else{
			     var pic = '';
				  if( $('#pic img').length > 0 ) pic = $('#pic img').attr('src');
				  pic = pic.split("news/")[1]

			     var cnt = CKEDITOR.instances.editor.getData();
					var type = $("#type").val()
					var link = $("#url").val()
			     //console.log(cnt);
					$.ajax({
						url: "news_system.php",
						type: "POST",
						data: {id: "<?=$id?>", type: type, title: $("#title").val(), description: $("#description").val(), date: $("#date").val(),  pic:pic, cnt:cnt, url:link, display: $("#display").val(), sort: $("#sort").val(), seo_title:$("#seo_title").val(),seo_desc:$("#seo_desc").val(),seo_keywords:$("#seo_keywords").val()},
						error: myErr,
						success: function(msg){
							var rr = JSON.parse(msg);
							if(String(rr["status"])=="success"){
								alert("儲存完成")
								location.assign("newslist?page=<?=$getpage?>&type=<?=$typeid?>")
							}else{
								alert(rr)
							}
						}
					});
				}
			});
			$("#cancel").click(function(){
				if(confirm("不儲存直接離開?") == true)
					location.assign("newslist?page=<?=$getpage?>&type=<?=$typeid?>");
			});
			});
		</script>
	</head>
	<body>
		<?php require_once('i_header.php'); ?>
		<aside>
			<div class="side_wrapper">
				<?php require_once('i_menu.php'); ?>
				<div class="sidebar">
					<div class="right_continer">
						<input type=hidden name=id value=109>
						<div class="adsright_title">線上咨詢-編輯</div>
						<div class="media_bg">
							<table width="100%" border="0">
								<tr>
									<td width="160">顯示
									<td>
										<select class="form-control" name="" id="display" >
											<option value="1">顯示</option>
											<option value="0"<?=$data['display'] == '0' ? ' selected="selected"' : '';?>>不顯示</option>
										</select>
								<tr>
									<td width="160">請選擇父層
									<td>
										<div class="manag_box">
											選擇父層
											<select class="" name="" id="parent">
												<option value="">===請選擇===</option>
												<option value="0">最表層</option>
												<?php
													setSelect($dataary,$layer);
													 ?>
											</select>
										</div>
								<tr>
									<td width="160">最終頁
									<td>
										<select class="form-control" name="" id="pageend" >
											<option value="0">否</option>
											<option value="1"<?=$data['endpage'] == '1' ? ' selected="selected"' : '';?>>是</option>
										</select>
								<tr>
									<td>標題
									<td>
										<div class="media_bord"><input name="title" type="text" value="" placeholder="" /></div>
								<tr>
									<td>描述
									<td>
										<div class="media_bord"><input name="title" type="text" value="" placeholder="" /></div>
								<tr>
									<td>內容<br>
									<td><textarea id="editor" name="editor"><?=$text?></textarea>
								<tr>
									<td>SEO title
									<td>
										<div class="media_bord"><input type="text" class="form-control" id="seo_title" value="<?=$data["MetaTitle"]?>"></div>
								<tr>
									<td>SEO description
									<td>
										<div class="media_bord"><input type="text" class="form-control" id="seo_desc" value="<?=$data["MetaDesc"]?>"></div>
								<tr>
									<td>SEO keywords
									<td>
										<div class="media_bord"><input type="text" class="form-control" id="seo_keywords" value="<?=$data["MetaKeywords"]?>"></div>
							</table>
						</div>
						<div class=msg></div>
						<div class="btnwrap">
							<button class="delete_btn" id="save">儲存</button>
							<button class="delete_btn" id="cancel">取消</button>
							<button class="delete_btn" id="delete" style="float:right">刪除</button>
						</div>
					</div>
				</div>
			</div>
		</aside>
		<?php require_once('i_footer.php'); ?>
	</body>
	<script>
		CKEDITOR.replace( 'editor' );
	</script>
</html>
