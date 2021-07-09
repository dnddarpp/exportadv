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
    $contenttype = $data["contenttype"];
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
	var pagetype = "<?=$type?>";
  var contenttype = "<?=$contenttype?>";
$(function(){
	//$("#type).val(<?=$typeid?>)
  $("#date").datepicker({dateFormat: 'yy-mm-dd'})
  if(pagetype=="add"){
		$("#date").datepicker("setDate", new Date());
    $("#title").val("")
    $("#description").val("")
	}

  $("#selecttype").change(function() {
    var val = $(this).val()
    console.log("val:"+val)
    setTypeContent(val)
  });
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
  $('#file_upload').uploader(
    'file_upload.php',
    function(filename){
      file = filename
      $('#flielink').html('<a href="../files/file/'+filename+'" target="_blank">檢視檔案</a>');
    },
    function(error){
      alert('Error! '+error);
    }
  );
  $('.del_file').click(function(){
		$(this).closest('td').find('a').remove();
	});


  $("#delete").click(function(){
		if(confirm("確定要刪除資料嗎？")){
				myDelete( 'news', 'id', '<?=$data["id"]?>' ,"newslist.php?page=<?=$getpage?>&type=<?=$typeid?>");
		}else{

		}
	})
  $("#save").click(function(){
    var type = $("#type").val()
    var error=""
    var datatype = $("#selecttype").val()
    //console.log(cnt);
		if($("#title").val() == ""){
      error+="請輸入標題\n"
    }
		if($("#date").val() == ""){
      error+="請輸入日期\n"
    }
    if(datatype=="1"){
      var cnt = CKEDITOR.instances.editor.getData();
      if(cnt == ""){
        error+="請輸入內文\n"
      }
    }else if(datatype=="2"){
      var link = $("#url").val()
      if(link == ""){
        error+="請輸入連結\n"
      }
    }else if(datatype=="3"){
      if( $('#flielink a').length > 0 ){
        error+="請輸上傳檔案\n"
      }
    }
    if(error.length>0){
      alert(error)
      return
    }

    var pic = '';
    if( $('#pic img').length > 0 ) pic = $('#pic img').attr('src');
    pic = pic.split("news/")[1]

    var cnt = ""
    var link = ""
    var attach = ""
    console.log("datatype:"+datatype)
    if(datatype=="1"){
      //一般資料
      cnt = CKEDITOR.instances.editor.getData();
    }else if(datatype=="2"){
      //url連結
      link = $("#url").val()
    }else if(datatype=="3"){
      if( $('#flielink a').length > 0 ){
        attach = $('#flielink a').attr('href');
        attach = attach.split("file/")[1]
      }
      console.log("attach:"+attach)
    }
    console.log("cnt:"+cnt)
    console.log("attach:"+attach)
    console.log("link:"+link)
    var dataary = {id: "<?=$id?>", type: type, title: $("#title").val(), description: $("#description").val(), date: $("#date").val(),  pic:pic, cnt:cnt, url:link, attach:attach, display: $("#display").val(), sort: $("#sort").val(), seo_title:$("#seo_title").val(),seo_desc:$("#seo_desc").val(),seo_keywords:$("#seo_keywords").val()}
    console.log(JSON.stringify(dataary))
    //console.log(cnt);
    $.ajax({
      url: "news_system.php",
      type: "POST",
      data: dataary,
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
	});
	$("#cancel").click(function(){
		if(confirm("不儲存直接離開?") == true)
			location.assign("newslist?page=<?=$getpage?>&type=<?=$typeid?>");
	});
  setTypeContent(contenttype)
});
function setTypeContent(_val){
  $(".conttype").hide()
  $(".type"+_val).show()
}
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
											<select class="form-select m-width" name="" id="type" >
                      	<option value="1">最新消息</option>
												<option value="2"<?=$typeid == '2' ? ' selected="selected"' : '';?>>顧問專欄</option>
                      </select>
									<tr>
										<td>顯示
										<td>
											<select class="form-select m-width" name="" id="display" >
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
                      <td width="10%">
                        資料類型
                      </td>
                      <td width="90%">
                        <select class="form-select m-width" name="" id="selecttype">
                          <option value="1">一般資料</option>
                          <option value="2">URL連結</option>
                          <option value="3">檔案下載</option>
                        </select>
                      </td>
                  </tr>
                  <tr class="conttype type1">
  									<td>內容<br>
  									<td><textarea id="editor" name="editor"><?=$text?></textarea>
                  </tr>
									<tr class="conttype type2">
                      <td width="10%">
                        外部連結
                      </td>
                      <td width="90%">
                        <div class="media_bord"><input type="text" name="url" class="form-control" placeholder="" id="url" value="<?=$data["url"] ?>"></div>
                      </td>
                  </tr>
                  <tr class="conttype type3">
  									<td>檔案下載<br></td>
  									<td>
                      <div id='file_upload'></div>
                      <div id='flielink'>
                        <?php
                          if($data["attach"]){
                        ?>
                        <a href="../files/file/<?=$data["attach"]?>" target="_blank">檢視檔案</a>
                        <?php
                        }
                        ?>
                      </div>
                      <button class='del_file'>刪除檔案</button>
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
