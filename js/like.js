jQuery(function ($) {
  $(".heart").click(function () {
      $(this).toggleClass("red");
  });
});

/*
$(".heart").click(function () {
    $(this).toggleClass('red');
    event.preventDefault();
});*/

jQuery(function ($) {
$(".heart").click(function(){
  var likeStorage = $(this).attr("id");
  if($(this).hasClass("red")) {
    localStorage.setItem(likeStorage, 'true');
  } 
  else {
    localStorage.removeItem(likeStorage, 'true');
  }
});
});

jQuery(function ($) {
$(".heart").each(function() {
  var mainlocalStorage = $(this).attr("id");
  if(localStorage.getItem(mainlocalStorage) == 'true') {
    $(this).addClass("red");
  }
  else {
    $(this).removeClass("red");
  }
});
});
                    
                    