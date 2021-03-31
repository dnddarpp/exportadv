<?php
  require_once('include.php');
  $mid = $_SESSION["mng_mid"];
  $getpage = $conn->real_escape_string($_GET["page"]);
  $id = $conn->real_escape_string($_GET["id"]);
	$typeid = $conn->real_escape_string($_GET["typeid"]);
  if($id){
    $sql = "select *  from `event` where 1=1 and id = $id ";
    $pjdata = qury_sel($sql, $conn);
    $data = mysqli_fetch_assoc($pjdata);
    $date = explode(" ", $data["Public_Date"])[0];
    //$text = str_ireplace(['\\\\r', '\\\\n'], "", $data["content"]);
    $text = $data["content"];
    $cover = $data["cover"];
    $type="edit";
    $typename="編輯";
    $piclist = $data['pic'];

  }else{
    $type="add";
    $id="";
    $typename="新增";
    $piclist = "[]";
  }

?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('i_meta.php'); ?>
		<title></title>
		<script type="text/javascript">
			var pagetype = "<?=$type?>";
      var piclist = <?=$piclist?>;
      var cover = "<?=$cover?>";
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
						myDelete( 'event', 'id', '<?=$data["id"]?>' ,"albumlist.php");
				}else{

				}
			})
      console.log("piclist.length:"+piclist.length)
      if(piclist.length>0){
        for(var i=0;i<piclist.length;i++){
          var ary = piclist[i];
          var nn = ary["img"]
          var ext = ary["type"]
          var title = ary["title"]
          var filepath = "../pic/album/"+nn+"."+ext
          // Add img element in <div id='preview'>

          // $('#preview').append('<div class="albumpic '+nn+'" data-id="'+nn+'"><div class="picput pp"><img src="'+filepath+'"></div><div class="picput inp"><input type="text" name="'+nn+'" data-name = "'+nn+'" data-type="'+ext+'" class="form-control imgtitle" value="'+title+'" placeholder="請輸入照片描述"><input type="button" name="" value="delete" class="del_img"></div></div><hr>');
          $('#preview').append('<div class="albumpic '+nn+'" data-id="'+nn+'"><table width="100%"><td width="200px"><img src="'+filepath+'"></td><td><input type="radio" name="cover" value="'+i+'">設為封面<input type="text" name="'+nn+'" data-name = "'+nn+'" data-type="'+ext+'" class="form-control imgtitle" value="'+title+'" placeholder="請輸入照片描述"><input type="button" name="" value="delete" class="del_img"></td></table></div><hr>');
          $('.'+nn+' .del_img').click(function(){
           $(this).parent().parent().remove();
         });
        }
        $('input:radio[name=cover][value='+cover+']').attr('checked', true);
      }

      $(".del_img").click(function(){
        $(this).parent().parent().remove();
      })
			 $("#save").click(function(){
         var cover = $("input[name=cover]:checked").val();
         console.log("cover")
        var imglist = []
        $(".imgtitle").each(function(){
          var val = $(this).val()
          var nn = $(this).data("name")
          var type = $(this).data("type")
          var tmp = {"img":nn, "title":val, "type":type}
          imglist.push(tmp)
        })
        var str_imglist = JSON.stringify(imglist)

        console.log("str_imglist:"+str_imglist)



				if($("#title").val() == "")
					alert("請輸入標題");
				else if($("#date").val() == "")
					alert("請輸入日期");
				else{
			     //console.log(cnt);
					$.ajax({
						url: "album_system.php",
						type: "POST",
						data: {id: "<?=$id?>", title: $("#title").val(), description: $("#description").val(), pic:str_imglist, display: $("#display").val(), sort: $("#sort").val(), cover:cover, seo_title:$("#seo_title").val(),seo_desc:$("#seo_desc").val(),seo_keywords:$("#seo_keywords").val()},
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
               var ary = response[index];
               var nn = ary[0]
               var ext = ary[1]
               var filepath = "../pic/album/"+nn+"."+ext
               // Add img element in <div id='preview'>

               //$('#preview').append('<div class="albumpic '+nn+'" data-id="'+nn+'"><div class="picput pp"><img src="'+filepath+'"></div><div class="picput inp"><input type="text" name="'+nn+'" data-name = "'+nn+'" data-type="'+ext+'" class="form-control imgtitle" value="" placeholder="請輸入照片描述"><input type="button" name="" value="delete" class="del_img"></div></div><hr>');
               $('#preview').append('<div class="albumpic '+nn+'" data-id="'+nn+'"><table width="100%"><td width="200px"><img src="'+filepath+'"></td><td><input type="radio" name="cover" value="'+index+'"><input type="text" name="'+nn+'" data-name = "'+nn+'" data-type="'+ext+'" class="form-control imgtitle" value="" placeholder="請輸入照片描述"><input type="button" name="" value="delete" class="del_img"></td></table></div><hr>');
               $('.'+nn+' .del_img').click(function(){
             		$(this).parent().parent().remove();
             	});
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
                      <div id='preview'>
                        <!-- <div class="albumpic 6009ed7815c5d.jpg" data-id="6009ed7815c5d.jpg">
                          <table width="100%">
                            <tr>
                              <td width="40%"><img src="../images/banner.png"></td>
                              <td width="60%"><input type="radio" name="cover" value=""><input type="text" name="6009ed7815c5d.jpg" class="form-control" value="" placeholder="請輸入照片描述"><input type="button" name="" value="delete" class="del_img"></td>
                            </tr>
                          </table>
                        </div> -->
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
</html>
