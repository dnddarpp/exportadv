<?php
  require_once('include.php');
  $mid = $_SESSION["mng_mid"];
  $getpage = $conn->real_escape_string($_GET["page"]);
  $id = $conn->real_escape_string($_GET["id"]);
  if($id){
    $sql = "select *  from `link` where 1=1 and id = $id ";
    $pjdata = qury_sel($sql, $conn);
    $data = mysqli_fetch_assoc($pjdata);
    //$text = str_ireplace(['\\\\r', '\\\\n'], "", $data["content"]);
    $text = $data["content"];
    $type="edit";
    $typename="編輯";
    if( ( $data['pic'] != '') && file_exists( '../pic/link/'.$data['pic'] ) )
    $pic = "<img src='../pic/link/".$data['pic']."'>";

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
  $("#delete").click(function(){
		if(confirm("確定要刪除資料嗎？")){
				myDelete( 'link', 'id', '<?=$data["id"]?>' ,"linklist.php?page=<?=$getpage?>&type=<?=$typeid?>");
		}else{

		}
	})
  $("#save").click(function(){

    //console.log(cnt);
		if($("#title").val() == "")
			alert("請輸入標題");
    else if($("#url").val() == "")
			alert("請輸入外部連結");
		else{
			var link = $("#url").val()
			$.ajax({
				url: "link_system.php",
				type: "POST",
				data: {id: "<?=$id?>", title: $("#title").val(), url:link, display: $("#display").val(), sort: $("#sort").val()},
				error: function(msg){alert("error")},
				success: function(msg){
					var rr = JSON.parse(msg);
					if(String(rr["status"])=="success"){
						alert("儲存完成")
						location.assign("linklist?page=<?=$getpage?>&type=<?=$typeid?>")
					}else{
						alert(rr)
					}
				}
			});
		}
	});
	$("#cancel").click(function(){
		if(confirm("不儲存直接離開?") == true)
			location.assign("linklist?page=<?=$getpage?>&type=<?=$typeid?>");
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
							<div class="adsright_title">外連資源-編輯</div>
							<div class="media_bg">
								<table width="100%" border="0">
									<tr>
										<td>標題
										<td>
											<div class="media_bord"><input name="title" type="text" id="title" class="form-control" value="<?=$data["title"] ?>" /></div>
									<tr>
                      <td width="10%">
                        外部連結
                      </td>
                      <td width="90%">
                        <div class="media_bord"><input type="text" name="url" class="form-control" placeholder="" id="url" value="<?=$data["url"] ?>"></div>
                      </td>
                  </tr>
									<tr>
										<td>顯示
										<td>
											<select class="form-control" name="" id="display" >
                      	<option value="1">顯示</option>
												<option value="0"<?=$data['display'] == '0' ? ' selected="selected"' : '';?>>不顯示</option>
                      </select>

									<tr>
                      <td>
                          排序
                      </td>
                      <td>
                        <div class="media_bord"><input type="text" class="form-control" id="sort" value="<?=$data["sort"]?>"></div>
                      </td>
                  </tr>
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
</html>
