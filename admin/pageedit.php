<?php
  require_once('include.php');
  $mid = $_SESSION["mng_mid"];
  $getpage = $conn->real_escape_string($_GET["page"]);
  $id = $conn->real_escape_string($_GET["id"]);
	$typeid = $conn->real_escape_string($_GET["typeid"]);
  if($id){
    $sql = "select a.*, b.catename from `page` as a inner join page_cate as b on a.type = b.id where 1=1 and a.id = $id ";
    $pjdata = qury_sel($sql, $conn);
    $data = mysqli_fetch_assoc($pjdata);
    $text = $data["content"];
    $type="edit";
    $typename="編輯";
  }else{
    $type="add";
    $id="";
    $typename="新增";
    $contenttype = "1";
  }

?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('i_meta.php'); ?>
		<title></title>
		<script type="text/javascript">
	var pagetype = "<?=$type?>"
  var contenttype = "<?=$contenttype?>"
$(function(){
  $("#save").click(function(){
    var error=""
    //console.log(cnt);
		if($("#title").val() == ""){
      error+="請輸入標題\n"
    }
    var cnt = CKEDITOR.instances.editor.getData();
    if(cnt == ""){
      error+="請輸入內文\n"
    }
    if(error.length>0){
      alert(error)
      return
    }
    var dataary = {id: "<?=$id?>", title: $("#title").val(),subtitle: $("#subtitle").val(), description: $("#description").val(), cnt:cnt, seo_title:$("#seo_title").val(), seo_desc:$("#seo_desc").val(), seo_keywords:$("#seo_keywords").val()}
    console.log(JSON.stringify(dataary))
    //console.log(cnt);
    $.ajax({
      url: "page_system.php",
      type: "POST",
      data: dataary,
      error: myErr,
      success: function(msg){
        var rr = JSON.parse(msg);
        if(String(rr["status"])=="success"){
          alert("儲存完成")
          location.assign("pagelist?page=<?=$getpage?>&type=<?=$typeid?>")
        }else{
          alert(rr)
        }
      }
    });
	});
	$("#cancel").click(function(){
		if(confirm("不儲存直接離開?") == true)
			location.assign("pagelist?page=<?=$getpage?>&type=<?=$typeid?>");
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
							<div class="adsright_title"><?=$data["catename"];?>-編輯</div>
							<div class="media_bg">
								<table width="100%" border="0">
									<tr>
										<td width="15%">單元名稱</td>
										<td width="85%">
                      <?=$data["catename"];?>
                    </td>
									<tr>
										<td>標題</td>
										<td>
											<div class="media_bord"><input name="title" type="text" id="title" class="form-control" value="<?=$data["title"] ?>" /></div>
                    </td>
                  </tr>
                  <tr>
										<td>副標題</td>
										<td>
											<div class="media_bord"><input name="title" type="text" id="subtitle" class="form-control" value="<?=$data["subtitle"] ?>" /></div>
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
                  <tr class="conttype type1">
  									<td>內容</td>
  									<td><textarea id="editor" name="editor"><?=$text?></textarea></td>
                  </tr>
								<tr>
									<td>SEO title</td>
									<td>
										<div class="media_bord"><input type="text" class="form-control" id="seo_title" value="<?=$data["MetaTitle"]?>"></div>
                  </td>
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
