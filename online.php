<!DOCTYPE html>
<html>
	<head>
		<?php require_once('i_meta.php'); ?>
		<title>線上諮詢</title>
		<script>
		var qaary = new Array()
		var tmpall = new Array()
		var listary = new Array()
			$(document).ready(function() {
				var tmp1 = [
					{"title":"壹、	國際市場資訊",
					"content":[
						{"title":"一、	市場商情",
						"content":""},
						{"title":"二、	我國出口相關規定",
						"content":""},
						{"title":"三、	外國進口關稅",
						"content":""},
						{"title":"四、	外國進口相關規定",
						"content":[
							{"title":"(一)	食品類",
							"content":""},
							{"title":"(二)	工業製品",
							"content":""}]}]}]
				var tmp2 = [
					{"title":"貳、	國際市場開發",
					"content":[
						{"title":"一、	篩選目標市場",
						"content":""},
						{"title":"二、	市場拓展",
						"content":[
							{"title":"(一)	買主資料蒐集",
							"content":""},
							{"title":"(二)	外貿協會拓銷活動",
							"content":""},
							{"title":"(三)	海外布局",
							"content":""}]}]}]
				var tmp3 = []
				var tmp4 = []
				var tmp5 = []
				var tmp6 = []
				tmpall.push(tmp1)
				tmpall.push(tmp2)
				//qaary = [{"title":"","content":tmpall}]
				qaary = [
					{"title":"",
					"content":[
						{"title":"壹、	國際市場資訊",
						"content":[
							{"title":"一、	市場商情",
							"content":""},
							{"title":"二、	我國出口相關規定",
							"content":""},
							{"title":"三、	外國進口關稅",
							"content":""},
							{"title":"四、	外國進口相關規定",
							"content":[
								{"title":"(一)	食品類",
								"content":""},
								{"title":"(二)	工業製品",
								"content":""}]}]},
						{"title":"貳、	國際市場開發",
						"content":[
							{"title":"一、	篩選目標市場",
							"content":""},
							{"title":"二、	市場拓展",
							"content":[
								{"title":"(一)	買主資料蒐集",
								"content":""},
								{"title":"(二)	外貿協會拓銷活動",
								"content":""},
								{"title":"(三)	海外布局",
								"content":""}]}]},
						{"title":"參、	數位貿易",
						"content":[
							{"title":"一、	網路行銷",
							"content":""},
							{"title":"二、	電子商務",
							"content":""}]},
						{"title":"肆、	國際貿易常見問題",
						"content":[
							{"title":"一、	對國際貿易流程不熟悉；缺乏實務經驗",
							"content":""},
							{"title":"二、	精進商用英文及其他外語能力",
							"content":""},
							{"title":"三、	貿易糾紛；付款及收帳問題",
							"content":""},
							{"title":"四、	貿易風險",
							"content":""},]},
						{"title":"伍、	政府輔導資源",
						"content":[
							{"title":"一、	經濟部國際貿易局手冊",
							"content":""},
							{"title":"二、	展覽補助",
							"content":""},
							{"title":"三、	協助廠商布建海外通路",
							"content":""},
							{"title":"四、	貿易金融",
							"content":""},
							{"title":"五、	其他各項補助措施",
							"content":""},]},
						{"title":"陸、	外貿協會服務",
						"content":[
							{"title":"一、	貿協官網及ONE TAITRA服務手冊",
							"content":""},
							{"title":"二、	駐外單位協助廠商",
							"content":""},
							{"title":"三、	培訓國際行銷人才",
							"content":""},
							{"title":"四、	企業攬才",
							"content":""},]},
						]}]

				console.log(JSON.stringify(qaary))
				setItem(0,"")



			})
			function setItem(_layer,_id){
				var str = ""
				var _ary = new Array()
				if(_layer==0){
					listary = qaary[0]["content"]
				}else{
					//_ary =qaary[_layer]["content"]
					listary =listary[_id]["content"]
					for(var i in listary){
						//console.log(i+":"+_ary[i])
						for(var j in listary[i]){
							console.log(j+":"+listary[i][j])
						}
					}
				}

				for(var mm=0;mm<listary.length;mm++){
					var title = listary[mm]["title"]
					var content = listary[mm]["content"]
					console.log("content.length:"+content.length)
					str+='<div class="qa_btn col-6 col-md-3 col-lg-3">'
					str+='<a'
					if(content.length<=0){
						console.log("0000000:")
						str+=' href="online_last2"'
					}
					str+='>'
					str+='<div class="onlie_qa" data-layer="'+_layer+'" data-id="'+mm+'">'+title+'</div>'
					str+='</a>'
					str+='</div>'
				}
				$(".online_wrap").html(str)
				$("a .onlie_qa").click(function(){
						var _layer = Number($(this).data("layer"))+1
						var _id = $(this).data("id")
						console.log("_layer:"+_layer)
						console.log("_id:"+_id)
						setItem(_layer,_id)
				})
			}
		</script>
	</head>
	<body >
		<?php require_once('i_header.php'); ?>
		<section>
			<div class="page_banner_pic" style="background-image:url(images/banner_02.png)" ;="">
				<div class="page_title">
					<div class="banner_title">線上諮詢</div>
					<div class="page_p">輕鬆提問，讓小C幫您解決問題</div>
				</div>
			</div>
			<div class="container all_wrapptop">
				<div class="bread_crumb">
					<ul>
						<li><a href="index">首頁</a></li>
						<li>/</li>
						<li class="bread_active">線上諮詢</li>
					</ul>
				</div>
			</div>
		</section>
		<section>
			<div class="container">
				<div class="info_title">線上諮詢</div>
				<div class="line"></div>
				<div class="row online_wrap">
					<!-- <div class="qa_btn col-6 col-md-3 col-lg-3">
						<a>
							<div class="onlie_qa">政府輔導外銷資源</div>
						</a>
					</div>
					<div class="qa_btn col-6 col-md-3 col-lg-3">
						<a>
							<div class="onlie_qa">海外市場資訊</div>
						</a>
					</div>
					<div class="qa_btn col-6 col-md-3 col-lg-3">
						<a>
							<div class="onlie_qa bet">海外拓銷工具</div>
						</a>
					</div>
					<div class="qa_btn col-6 col-md-3 col-lg-3">
						<a>
							<div class="onlie_qa">數位轉型專區</div>
						</a>
					</div>
					<div class="qa_btn col-6 col-md-3 col-lg-3">
						<a>
							<div class="onlie_qa">各國關稅</div>
						</a>
					</div>
					<div class="qa_btn col-6 col-md-3 col-lg-3">
						<a>
							<div class="onlie_qa">政府輔導資源</div>
						</a>
					</div>
					<div class="qa_btn col-6 col-md-3 col-lg-3">
						<a>
							<div class="onlie_qa">國際行銷諮詢</div>
						</a>
					</div>
					<div class="qa_btn col-6 col-md-3 col-lg-3">
						<a>
							<div class="onlie_qa">其他問題</div>
						</a>
					</div> -->
				</div>
				<!-- <ul class="prev_btn onlinepage">
					<a><li>< Prev</li></a>
					<a><li class="actvie">1</li></a>
					<a><li>2</li></a>
					<a><li>3</li></a>
					<a><li>4</li></a>
					<a><li>Next ></li></a>
					</ul> -->
			</div>
		</section>
    <?php require_once('i_bottom.php'); ?>
	</body>
</html>
