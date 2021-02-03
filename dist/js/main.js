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
      location.href = "search_result?#gsc.tab=0&gsc.q="+val+"&gsc.sort="

    })

    $("#websearch").keydown(function(event){
    		if (event.keyCode == "13"){
          var val = $("#websearch").val()
          location.href = "search_result?#gsc.tab=0&gsc.q="+val+"&gsc.sort="
    		}
    	});
})
