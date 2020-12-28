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
})
