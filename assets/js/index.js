$(function(){
  "use strict";

  $(".one-user").mouseover(function(){
    $(this).addClass("active");
    $(this).css({
      'background':'rgb(129, 125, 125,.05)',
    });
    
    
  });
  $(".one-user").mouseleave(function(){
    $(this).removeClass("active");
    $(this).css({
      'background':'none'
    });
  });

  $('[data-toggle="tooltip"]').tooltip();
  
  
  var showPass = 0;
  $('.passfaild i').on('click', function () {
    if (showPass == 0) {
      $(".passfaild i").prev('input').attr('type', 'text');
      $(".passfaild i").removeClass('fa-eye');
      $(".passfaild i").addClass('fa-eye-slash');
      showPass = 1;
    }
    else {
      $(".passfaild i").prev('input').attr('type', 'password');
      $(".passfaild i").addClass('fa-eye');
      $(".passfaild i").removeClass('fa-eye-slash');
      showPass = 0;
    }
  });

  
  setInterval(() => {
    $(".one-user").each(function () {
      
      if ($(this).children().find("#numOfMs").html() != "0") {
        $('.unread-message').slideDown();
        // console.log("sadas");
      }
    })
  }, 1000);

  $("#emo").emojiPicker({
    iconBackgroundColor: "transparent"
  });
  
  

});


function copfunc(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
  $.alert({
    title:"alert",
    content:"copied"
  })
}
