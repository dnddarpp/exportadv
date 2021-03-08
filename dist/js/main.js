$(document).ready(function() {
    AOS.init({
       once: true,
       duration: 1200
    })
    $(".meunicon").click(function(){
      $("#mobilemenu").fadeIn()
    })
    $(".mask").click(function(){
      $("#mobilemenu").fadeOut()
    })
    $("#gosearch").click(function(){
      var val = $("#websearch").val()
      location.href = "search_result?q="+val+"&"

    })

    $("#websearch").keydown(function(event){
    		if (event.keyCode == "13"){
          var val = $("#websearch").val()
          location.href = "search_result?q="+val+"&"
    		}
    	});
})
function showComfirmAndGo(_msg, _link){
	$.confirm({
	    title: '',
	    content: _msg,
	    buttons: {
				"報名實體諮詢": {
					btnClass: 'btn-info',
					action: function () {
            window.open(_link)
            // window.location.href = _link;
					}
				},
        "不需要，謝謝":{
          btnClass: 'btn-info',
          action: function () {

          }
        }
	    }
	});
}
