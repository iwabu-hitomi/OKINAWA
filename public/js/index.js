$(function(){

  $('a[href^="#"]').on("click",function(){
    let speed = 500;
    let href= $(this).attr("href");
    let target = $(href == "#" || href == "" ? 'html' : href);
    let position = target.offset().top;
    $("html, body").animate({scrollTop:position}, speed, "swing");
    return false;
  });


  $("#view_id").on("click", function() {
  $("#overlay").css({
    "background-color": "rgba(0, 0, 0, 0.5)",
    "display": "flex"
  });
  $("#overlay").animate({
    opacity: 1,
    padding: "10% 0 15% 0"
  }, 1000);
});

// サインイン画面の非表示化
$("#overlay").on("click", function() {
  let target = event.target.id;
  if(target == "overlay") {
    $("#overlay").css({
      "display": "none",
      opacity: 0,
      padding: "50% 0 0 0"
    });
  }
});

});
