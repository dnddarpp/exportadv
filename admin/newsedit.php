<?php
  require_once('include.php');
  $mid = $_SESSION["mng_mid"];
  $getpage = $conn->real_escape_string($_GET["page"]);
  $id = $conn->real_escape_string($_GET["id"]);
	$typeid = $conn->real_escape_string($_GET["typeid"]);
  if($id){
    $sql = "select *  from `news` where 1=1 and id = $id ";
    $pjdata = qury_sel($sql, $conn);
    $data = mysqli_fetch_assoc($pjdata);
    $date = explode(" ", $data["Public_Date"])[0];
    //$text = str_ireplace(['\\\\r', '\\\\n'], "", $data["content"]);
    $text = $data["content"];
    $type="edit";
    $typename="編輯";
    if( ( $data['pic'] != '') && file_exists( '../pic/news/'.$data['pic'] ) )
    $pic = "<img src='../pic/news/".$data['pic']."'>";

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
  if(pagetype=="add"){
    $("#title").val("")
    $("#description").val("")
  }
  $('#pic_upload').uploader(
		'pic_upload_news.php',
		function(filename){
			$('#pic').html('<img src="../pic/news/'+filename+'">');
		},
		function(error){
			alert('Error! '+error);
		}
	);
	$('.del_img').click(function(){
		$(this).closest('td').find('img').remove();
	});

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
							<div class="adsright_title">最新消息-編輯</div>
							<div class="media_bg">
								<table width="100%" border="0">
									<tr>
										<td width="15%">分類
										<td width="85%">
											<select class="form-control" name="" id="type" >
                      	<option value="1">最新消息</option>
												<option value="2"<?=$typeid == '2' ? ' selected="selected"' : '';?>>產業新聞</option>
                      </select>
									<tr>
										<td>顯示
										<td>
											<select class="form-control" name="" id="display" >
                      	<option value="1">顯示</option>
												<option value="0"<?=$data['display'] == '0' ? ' selected="selected"' : '';?>>不顯示</option>
                      </select>
									<tr>
										<td>發佈日期
										<td>
											<div class="media_bord"><input name="time" type="text" id="date" class="form-control" value="<?=$date?>" /></div>
									<tr>
										<td>標題
										<td>
											<div class="media_bord"><input name="title" type="text" id="title" class="form-control" value="<?=$data["title"] ?>" /></div>
									<tr>
                      <td>
                          排序
                      </td>
                      <td>
                        <div class="media_bord"><input type="text" class="form-control" id="sort" value="<?=$data["sort"]?>"></div>
                      </td>
                  </tr>
									<tr>
                      <td width="10%">
                        簡述
                      </td>
                      <td width="90%">
                        <div class="media_bord"><input type="text" name="description" class="form-control" placeholder="建議40字以內" id="description" value="<?=$data["description"] ?>"></div>
                      </td>
                  </tr>
									<tr>
                      <td width="10%">
                        外部連結
                      </td>
                      <td width="90%">
                        <div class="media_bord"><input type="text" name="url" class="form-control" placeholder="" id="url" value="<?=$data["url"] ?>"></div>
                      </td>
                  </tr>
									<tr>
                    <td>
                        圖片(483*284)
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
