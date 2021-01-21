<?php
  require_once('include.php');
  $mid = $_SESSION["mng_mid"];
  $getpage = $conn->real_escape_string($_GET["page"]);
  $id = $conn->real_escape_string($_GET["id"]);
	$typeid = $conn->real_escape_string($_GET["typeid"]);
  if($id){
    $sql = "select *  from `album` where 1=1 and id = $id ";
    $pjdata = qury_sel($sql, $conn);
    $data = mysqli_fetch_assoc($pjdata);
    $date = explode(" ", $data["Public_Date"])[0];
    //$text = str_ireplace(['\\\\r', '\\\\n'], "", $data["content"]);
    $text = $data["content"];
    $type="edit";
    $typename="編輯";
    if( ( $data['pic'] != '') && file_exists( '../pic/album/'.$data['pic'] ) )
    $pic = "<img src='../pic/album/".$data['pic']."'>";

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
			$( document ).ready(function(){
				$("#parent").val(parent)
			 if(pagetype=="new"){
			   $("#title").val("")
			   $("#description").val("")
			 }
			 $("#date").datepicker({dateFormat: 'yy-mm-dd'})
		   if(pagetype=="new"){
		 		$("#date").datepicker("setDate", new Date());
		 	}
			 $("#delete").click(function(){
				if(confirm("確定要刪除資料嗎？")){
						myDelete( 'album', 'id', '<?=$data["id"]?>' ,"albumlist.php?page=<?=$getpage?>&parent=<?=$parent?>");
				}else{

				}
			})
			 $("#save").click(function(){

				if($("#title").val() == "")
					alert("請輸入標題");
			  else if($("#description").val() == "")
			 		alert("請輸入概述");
				else if($("#date").val() == "")
					alert("請輸入日期");
				else{
			     //console.log(cnt);
					$.ajax({
						url: "album_system.php",
						type: "POST",
						data: {id: "<?=$id?>", title: $("#title").val(), description: $("#description").val(), date: $("#date").val(),  pic:pic, cnt:cnt, url:link, display: $("#display").val(), sort: $("#sort").val(), seo_title:$("#seo_title").val(),seo_desc:$("#seo_desc").val(),seo_keywords:$("#seo_keywords").val()},
						error: myErr,
						success: function(msg){
							var rr = JSON.parse(msg);
							if(String(rr["status"])=="success"){
								alert("儲存完成")
								location.assign("albumlist?page=<?=$getpage?>&")
							}else{
								alert(rr)
							}
						}
					});
				}
			});
			$("#cancel").click(function(){
				if(confirm("不儲存直接離開?") == true)
					location.assign("albumlist?page=<?=$getpage?>&");
			});

      $('#submit').click(function(){

         var form_data = new FormData();

         // Read selected files
         var totalfiles = document.getElementById('files').files.length;
         for (var index = 0; index < totalfiles; index++) {
            form_data.append("files[]", document.getElementById('files').files[index]);
         }

         // AJAX request
         $.ajax({
           url: 'ajaxfile.php',
           type: 'post',
           data: form_data,
           dataType: 'json',
           contentType: false,
           processData: false,
           success: function (response) {
             for(var index = 0; index < response.length; index++) {
               var src = response[index];
               // Add img element in <div id='preview'>

               $('#preview').append('<div class="albumpic" data-id="'+src+'"><img src="../pic/album/'+src+'" width="200px;" height="200px"><input type="text" name="'+src+'" value="" placeholder="請輸入照片描述"></div>');
             }

           }
         });

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
							<div class="adsright_title">活動照片-編輯</div>
							<div class="media_bg">
								<table width="100%" border="0">
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
										<td>上傳照片</td>
										<td>
                      <form method='post' action='' enctype="multipart/form-data">
                         <input type="file" id='files' name="files[]" multiple><br>
                         <input type="button" id="submit" value='Upload'>
                      </form>
                      <div id='preview'></div>
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
</html>
