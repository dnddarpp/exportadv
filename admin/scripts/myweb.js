
function myErr(){
	alert("發生錯誤，請重試或洽程式設計師");
}
function checkPermission(_page){
	console.log("checkPermission:"+_page)
		//_page="0"
		$(".left_box a").hide()
		switch(String(_page)){
			case "4":
				//系統管理員
				$(".left_box a").show()
				break
			case "5":
				//案件管理
			case "3":
				//案件瀏覽
					$(".left_box a").hide().each(function(){
						var adata = $(this).data();
						console.log("adata = "+adata.mid)
						switch(adata.mid){
							case "2_0":
							case "2_1":
							case "2_2":
							case "5_0":
								$(this).show()
							break
							case "2_3":
							case "2_4":
								if(String(_page)=="5"){
									$(this).show()
								}
							break
						}

						if(String(_page)=="3"){
							$(".goedit").hide()
						}
					})
				break
			default:
				$(".left_box").hide()
				$(".right_box").hide()
				alert("帳號有誤，請重新登入")
				//location.href="login.php"
			break
		}


}
function sendSystemMail(_status){
	switch(_status){
		case "0":
		break
		case "1":
		break
	}

}
function htmlspecialchars(ch) {
	if (ch===null) return '';
	ch = ch.replace(/&/g,"&amp;");
	ch = ch.replace(/\"/g,"&quot;");
	ch = ch.replace(/\'/g,"&#039;");
	ch = ch.replace(/</g,"&lt;");
	ch = ch.replace(/>/g,"&gt;");
	return ch;
}

function myTimeout(){
	//alert("連線逾時，請重新輸入");
	//location.assign("logout.php");
}

function myDelete( table_name, key, value, page){
	$.ajax({
		url: "fun/myDelete.php",
		type: "POST",
		data: { table_name: table_name, key: key, value: value },
		error: function(){
			myErr();
		},
		success: function( back ){
			var aa = $.trim( String(back) );
			if( aa == "success" ){
				alert("已刪除");
				location.href=page;
			} else if ( aa == "timeout" ){
				myTimeout();
			} else {
				alert( aa );
			}
		}
	});
}

function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

function jumpToEnd(){


}
