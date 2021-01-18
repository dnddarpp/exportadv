<?php
  require_once('include.php');
  $mid = $_SESSION["mng_mid"];
  $getpage = $conn->real_escape_string($_GET["page"]);
  $id = $conn->real_escape_string($_GET["id"]);
  if($id){
    $sql = "select *  from `media` where 1=1 and id = $id ";
    $pjdata = qury_sel($sql, $conn);
    $data = mysqli_fetch_assoc($pjdata);

    //$text = str_ireplace(['\\\\r', '\\\\n'], "", $data["content"]);
    $text = $data["content"];
    $type="edit";
    $typename="編輯";
    if( ( $data['pic'] != '') && file_exists( '../pic/media/'.$data['pic'] ) )
    $pic = "<img src='../pic/media/".$data['pic']."'>";

  }else{
    $type="add";
    $id="";
    $typename="新增";
  }

?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('i_meta.php'); ?>
		<title></title>
		<script type="text/javascript">
	var pagetype = "<?=$type?>"
$(function(){
  if(pagetype=="new"){
    $("#title").val("")
  }
	$('#pic_upload').uploader(
		'pic_upload_media.php',
		function(filename){
			$('#pic').html('<img src="../pic/media/'+filename+'">');
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
				myDelete( 'media', 'id', '<?=$data["id"]?>' ,"videolist.php?page=<?=$getpage?>&type=<?=$typeid?>");
		}else{

		}
	})
  $("#save").click(function(){
    //console.log(cnt);
		if($("#title").val() == "")
			alert("請輸入標題");
    else if($("#url").val() == "")
  			alert("請輸入連結");
		else{
			var pic = '';
		  if( $('#pic img').length > 0 ) pic = $('#pic img').attr('src');
		  pic = pic.split("media/")[1]
			var link = $("#url").val()
      //console.log(cnt);
			$.ajax({
				url: "video_system.php",
				type: "POST",
				data: {id: "<?=$id?>", title: $("#title").val(), url:link, pic:pic, display: $("#display").val(), sort: $("#sort").val(), seo_title:$("#seo_title").val(),seo_desc:$("#seo_desc").val(),seo_keywords:$("#seo_keywords").val()},
				error: myErr,
				success: function(msg){
					var rr = JSON.parse(msg);
					if(String(rr["status"])=="success"){
						alert("儲存完成")
						location.assign("videolist?page=<?=$getpage?>&type=<?=$typeid?>")
					}else{
						alert(rr)
					}
				}
			});
		}
	});
	$("#cancel").click(function(){
		if(confirm("不儲存直接離開?") == true)
			location.assign("videolist?page=<?=$getpage?>&type=<?=$typeid?>");
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
							<div class="adsright_title">影音專區-編輯</div>
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
										<td>標題
										<td>
											<div class="media_bord"><input name="title" type="text" id="title" class="form-control" value="<?=$data["title"] ?>" /></div>
									<tr>
                    <td>
                        圖片(600*400)
                    </td>
                    <td>
                      <div id='pic_upload'></div>
								          <div id='pic'>
								            <?=$pic?>
								          </div>
								          <button class='del_img'>刪除圖片</button>
                    </td>
                </tr>
									<tr>
                      <td width="10%">
                        影片連結
                      </td>
                      <td width="90%">
                        <div class="media_bord"><input type="text" name="url" class="form-control" placeholder="" id="url" value="<?=$data["url"] ?>"></div>
                      </td>
                  </tr>
									<tr>
                      <td>
                          排序
                      </td>
                      <td>
                        <div class="media_bord"><input type="text" class="form-control" id="sort" value="<?=$data["sort"]?>"></div>
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
											<div class="media_bord"><input type="text" class="form-control" id="seo_keywords" value="<?=$data["MetaKeywords"]?>"></div>
								</table>
							</div>
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
</html>
