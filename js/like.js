jQuery(function ($) {
  $(".heart").click(function () {
      $(this).toggleClass('red');
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
  if($(this).hasClass('red')) {
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
    $(this).addClass('red');
  }
  else {
    $(this).removeClass('red');
  }
});
});
/*              
jQuery(function ($) {
  // if the user clicks on the like button ...
  $('.heart').on('click', function(){
    var post_id = $(this).attr('id');
    $likebtn = $(this);

    if ($likebtn.hasClass('red')) {
      action = 'like';
    } else {
      action = 'unlike';
    }
    $.ajax({
      url: 'index.php',
      type: 'post',
      data: {
        'action': action,
        '_id': post_id
      },
      success: function(data){
        res = JSON.parse(data);

        if (action == "like") {
          $clicked_btn.addClass('red');
        } else if(action == "unlike") {
          $clicked_btn.removeClass('red');
        }
      }
    });		

  });
});
*/
