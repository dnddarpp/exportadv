<?php
	require_once('include.php');
	$mid = $_SESSION["mng_mid"];
	$id = $conn->real_escape_string($_GET["id"]);
	$parent = $conn->real_escape_string($_GET["pid"]);

	$layer = 0;
	if($id){
	  $sql = "select *  from `consult` where 1=1 and id = $id ";
	  $pjdata = qury_sel($sql, $conn);
	  $data = mysqli_fetch_assoc($pjdata);
		$parent = $data["parent"];
		$text = $data["content"];

		if( ( $data['pic1'] != '') && file_exists( '../pic/consult/'.$data['pic1'] ) )
    $pic1 = "<img src='../pic/consult/".$data['pic1']."'>";

		if( ( $data['pic2'] != '') && file_exists( '../pic/consult/'.$data['pic2'] ) )
    $pic2 = "<img src='../pic/consult/".$data['pic2']."'>";

		if( ( $data['pic3'] != '') && file_exists( '../pic/consult/'.$data['pic3'] ) )
    $pic3 = "<img src='../pic/consult/".$data['pic3']."'>";

		if( ( $data['pic4'] != '') && file_exists( '../pic/consult/'.$data['pic4'] ) )
    $pic4 = "<img src='../pic/consult/".$data['pic4']."'>";

		if( ( $data['pic5'] != '') && file_exists( '../pic/consult/'.$data['pic5'] ) )
    $pic5 = "<img src='../pic/consult/".$data['pic5']."'>";

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
		<script type="text/javascript" src="scripts/uploader_pic.js"></script>
		<title></title>
		<script type="text/javascript">
			var pagetype = "<?=$type?>"
			var dataary = <?=$str_dataary?>;
			var parent = "<?=$parent?>";
			console.log("parent:"+parent)
			$( document ).ready(function(){
				$("#parent").val(parent)
			 if(pagetype=="new"){
			   $("#title").val("")
			   $("#description").val("")
			 }
			 $('#pic_upload1').uploader(
					'pic_upload_consult.php',
					function(filename){
						$('#pic1').html('<img src="../pic/consult/'+filename+'">');
					},
					function(error){
						alert('Error! '+error);
					}
				);
				$('#pic_upload2').uploader(
 					'pic_upload_consult.php',
 					function(filename){
 						$('#pic2').html('<img src="../pic/consult/'+filename+'">');
 					},
 					function(error){
 						alert('Error! '+error);
 					}
 				);
				$('.del_img').click(function(){
					$(this).closest('td').find('img').remove();
				});
			 $("#delete").click(function(){
				if(confirm("確定要刪除資料嗎？")){
						myDelete( 'consult', 'id', '<?=$data["id"]?>' ,"consultlist.php?page=<?=$getpage?>&parent=<?=$parent?>");
				}else{

				}
			})
			 $("#save").click(function(){

			   //console.log(cnt);
				var cnt = CKEDITOR.instances.editor.getData();
				var endpage = $("#endpage").val()

				if($("#title").val() == "")
					alert("請輸入標題");
				else if(endpage=="1" && cnt == "")
					alert("請輸入內文");
				else{
					var parent = $("#parent").val()

			    var pic1 = '';
				  if( $('#pic1 img').length > 0 ) pic1 = $('#pic1 img').attr('src');
				  pic1 = pic1.split("consult/")[1]

					var pic2 = '';
				  if( $('#pic2 img').length > 0 ) pic2 = $('#pic2 img').attr('src');
				  pic2 = pic2.split("consult/")[1]

					var pic3 = '';
				  if( $('#pic3 img').length > 0 ) pic3 = $('#pic3 img').attr('src');
				  pic3 = pic3.split("consult/")[1]

					var pic4 = '';
				  if( $('#pic4 img').length > 0 ) pic4 = $('#pic4 img').attr('src');
				  pic4 = pic4.split("consult/")[1]

					var pic5 = '';
				  if( $('#pic5 img').length > 0 ) pic5 = $('#pic5 img').attr('src');
				  pic5 = pic5.split("consult/")[1]


					var link1 = $("#url1").val()
					var link2 = $("#url2").val()
					var link3 = $("#url3").val()
					var link4 = $("#url4").val()
					var link5 = $("#url5").val()
			     //console.log(cnt);
					$.ajax({
						url: "consult_system.php",
						type: "POST",
						data: {id: "<?=$id?>", title: $("#title").val(), description: $("#description").val(), parent: parent, endpage:endpage, pic1:pic1, url1:link1, pic2:pic2, url2:link2,pic3:pic3, url3:link3,pic4:pic4, url4:link4,pic5:pic5, url5:link5, cnt:cnt,  display: $("#display").val(), sort: $("#sort").val(), seo_title:$("#seo_title").val(),seo_desc:$("#seo_desc").val(),seo_keywords:$("#seo_keywords").val()},
						error: myErr,
						success: function(msg){
							var rr = JSON.parse(msg);
							if(String(rr["status"])=="success"){
								alert("儲存完成")
								location.assign("consultlist?page=<?=$getpage?>&parent=<?=$parent?>")
							}else{
								alert(rr)
							}
						}
					});
				}
			});
			$("#cancel").click(function(){
				if(confirm("不儲存直接離開?") == true)
					location.assign("consultlist?page=<?=$getpage?>&parent=<?=$parent?>");
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
									<td>標題
									<td>
										<div class="media_bord"><input name="title" type="text" id="title" value="<?=$data["title"]?>" placeholder="" /></div>
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
									<td width="160">顯示
									<td>
										<select class="form-control" name="" id="display" >
											<option value="1">顯示</option>
											<option value="0"<?=$data['display'] == '0' ? ' selected="selected"' : '';?>>不顯示</option>
										</select>
								<tr>
									<td width="160">最終頁
									<td>
										<select class="form-control" name="" id="endpage" >
											<option value="0">否</option>
											<option value="1"<?=$data['endpage'] == '1' ? ' selected="selected"' : '';?>>是</option>
										</select>
								<tr>
									<td>
										排序
									</td>
									<td>
										<div class="media_bord"><input type="text" class="form-control" id="sort" value="<?=$data["sort"]?>"></div>
									</td>
								</tr>
								<tr>
									<td>描述
									<td>
										<div class="media_bord"><input name="title" type="text" value="" placeholder="" /></div>
								<tr>
									<td>內容<br>
									<td><textarea id="editor" name="editor"><?=$text?></textarea>
								<tr>
									<td width="10%">
										相關連結1
									</td>
									<td width="90%">
										網址
										<div class="media_bord"><input type="text" name="url" class="form-control" placeholder="" id="url1" value="<?=$data["url1"] ?>"></div>
										<br>
										<br>
										圖片(170*70)
										<div class="tt">
											<div id='pic_upload1' class="pic_upload"></div>
											<div id='pic1' class="picput" name="aaa">
												<?=$pic1?>
											</div>
											<button class='del_img'>刪除圖片</button>
										</div>
									</td>
								</tr>
								<tr>
									<td width="10%">
										相關連結2
									</td>
									<td width="90%">
										網址
										<div class="media_bord"><input type="text" name="url2" class="form-control" placeholder="" id="url2" value="<?=$data["url2"] ?>"></div>
										<br>
										<br>
										圖片(170*70)
										<div class="tt">
											<div id='pic_upload2' class="pic_upload"></div>
											<div id='pic2' class="picput" name="aaa">
												<?=$pic2?>
											</div>
											<button class='del_img'>刪除圖片</button>
										</div>
									</td>
								</tr>
								<tr>
									<td width="10%">
										相關連結3
									</td>
									<td width="90%">
										網址
										<div class="media_bord"><input type="text" name="url3" class="form-control" placeholder="" id="url3" value="<?=$data["url3"] ?>"></div>
										<br>
										<br>
										圖片(170*70)
										<div class="">
											<div id='pic_upload3' class="pic_upload"></div>
											<div id='pic3' class="picput" name="aaa">
												<?=$pic3?>
											</div>
											<button class='del_img'>刪除圖片</button>
										</div>
									</td>
								</tr>
								<tr>
									<td width="10%">
										相關連結4
									</td>
									<td width="90%">
										網址
										<div class="media_bord"><input type="text" name="url4" class="form-control" placeholder="" id="url4" value="<?=$data["url4"] ?>"></div>
										<br>
										<br>
										圖片(170*70)
										<div class="">
											<div id='pic_upload4' class="pic_upload"></div>
											<div id='pic4' class="picput" name="aaa">
												<?=$pic4?>
											</div>
											<button class='del_img'>刪除圖片</button>
										</div>
									</td>
								</tr>
								<tr>
									<td width="10%">
										相關連結5
									</td>
									<td width="90%">
										網址
										<div class="media_bord"><input type="text" name="url5" class="form-control" placeholder="" id="url5" value="<?=$data["url5"] ?>"></div>
										<br>
										<br>
										圖片(170*70)
										<div class="">
											<div id='pic_upload5' class="pic_upload"></div>
											<div id='pic5' class="picput" name="aaa">
												<?=$pic5?>
											</div>
											<button class='del_img'>刪除圖片</button>
										</div>
									</td>
								</tr>
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
										<div class="media_bord"><input type="text" class="form-control" id="seo_keywords" value="<?=$data["MetaKeywords"]?>" placeholder="請用半型,分隔"></div>
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
