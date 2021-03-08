<?php
	require_once("include.php");
	$id = $conn->real_escape_string($_GET["id"]);

	$trackid = trackConsult($id,$conn);
	//echo $trackid;


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

		$str_link = "";
		for($i=1;$i<=5;$i++){
			$url = $data["url".$i];
			$pic = $data["pic".$i];
			$urlname = $data["urlname".$i];
			if(strlen($url)>0){
				// $str_link.='<li class="link_w_pic"><a href="'.$url.'" target="_blank"><div class="linkpic" style="background-image:url(\'pic/consult/'.$pic.'\')"></div></a></li>';
				$str_link.='<div class="col-6 col-md-3 col-lg-2"><a href="'.$url.'" target="_blank"><div class="link_other"><ul class="linkpic"><li class="link_w_pic"><div class="linkpic" style="background-image:url(\'pic/consult/'.$pic.'\');"></div></li></ul></div><div class="online_font">'.$urlname.'</div></a></div>';
			}
		}
	}

	$dataary = array();
	$dataary = getConsultData(0,$conn);
	$str_dataary = json_encode($dataary);

	$tmpary = array();
	$pathary = getConsultPath($id,$conn,$tmpary);
	$str_pathary = json_encode($pathary);
	$str_path = "";
	foreach ($pathary as $key => $value) {
		if(strlen($str_path)<=0){
			$nowtitle = " - ".$value[1];
			$str_path = '<li>/</li><li>'.$value[1].'</li>'.$str_path;
		}else{
			$str_path = '<li>/</li><li><a href="online?id='.$value[0].'#cin">'.$value[1].'</a></li>'.$str_path;
		}
	}
	// echo json_encode($dataary);
?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('i_meta.php'); ?>
		<title>線上諮詢</title>
		<script>
		var pageid = "<?=$id?>"
		var trackid = "<?=$trackid?>"
		$( document ).ready(function(){
			$(".kekeke").click(function(){
				var val = $(this).data("id")

				$.ajax({
		      url: "feedback_system.php",
		      type: "POST",
		      data: {id: "<?=$id?>", trackid: trackid, feed:val},
		      error: myErr,
		      success: function(msg){
		        var rr = JSON.parse(msg);
		        if(String(rr["status"])=="success"){
		          alert("我們已經收到您的回應！謝謝")
							$(".qekc_font").fadeOut()
							showComfirmAndGo("如需獲得更多協助，歡迎報名實體諮詢。","https://events.taiwantrade.com/exportadv")
		        }else{
		          alert(rr)
		        }
		      }
		    });
			})
		})
		function myErr(msg){
			console.log(msg)
		}
		</script>
	</head>
	<body >
		<?php require_once('i_header.php'); ?>
		<section>
			<div class="page_banner_pic" style="background-image:url(images/a.png)" ;="">
				<div class="page_title">
					<div class="banner_title">線上諮詢</div>
				</div>
			</div>
			<div class="container all_wrapptop">
				<div class="bread_crumb">
					<ul>
						<li><a href="index">首頁</a></li>
						<li>/</li>
						<li class="bread_active"><a href="online">線上諮詢</a></li>
						<?=$str_path?>
					</ul>
				</div>
			</div>
		</section>
		<section>
			<div class="container">
				<div class="info_title"><?=$data["title"];?></div>
				<div class="line"></div>
				<div class="row onlinecontent">
					<div class="col-12 col-md-12 col-lg-12">
						<?=$text?>
					</div>
				</div>
				<br><br>
				<?php
					if(strlen($str_link)>0){
				?>
				<div class="online_name">相關連結</div>
				<div class="row">
				<?=$str_link?>
			</div>
				<?php
					}
				?>
				<div class="qekc_font">
					<div class="yes_btn clean">
						<div class="uij">上述資訊是否有幫助?</div>
						<div class="kekeke adke_active" data-id="1">是</div>
						<div class="kekeke" data-id="0"><a>否</a></div>
					</div>
				</div>
				<ul class="prev_btn onlinepage">
					<a href="online?id=<?=$parent?>#cin">
						<li>< 上一頁</li>
					</a>
				</ul>
			</div>
		</section>
		<?php require_once('i_bottom2.php'); ?>
	</body>
</html>
