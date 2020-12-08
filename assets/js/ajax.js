var vars;
var x = document.getElementById(1);

$(function () {
  "use strict";

  $(".one-user").click(function () {
    

    var groupId = $(this).data("group");
    var validControl = $(this).attr("data-go");
    var nameUser = $(this).children().find(".nameUser").text();
    $(this).children().find("#numOfMs").css({'display':'none'});
    $(this).children().find("#numOfMs").html("0");

    if (validControl == "fales") {
      $(".send-message-form #form-set").css({
        'display': 'none'
      });
      var validForm = "fales";
    } else {
      $(".send-message-form #form-set").css({
        'display': 'block'
      });
    }

    var image = $(this).children().find(".imgprofile img").attr('src');

    $.ajax({
      url: base_url + "oper/ajax.php?key=getchat",
      method: "post",
      data: {
        group: groupId
      },
      success: function (data) {
        $("#chat-Message-data .content-free").hide();
        $(".content-ful .info img").attr("src", image);
        $("#groupName").html(nameUser);//name of group
        // $("#teacherName").html(data[0][0].gSubname);//name of teacher
        $("#message").empty();
        
        // data
        $("#message").html(data);
        // data

        if (validForm != "fales") {
          $('form#form-set').attr('data-group', groupId);
          $(".con-vaild").html("").css({ "display": "none" });
          $(".upload-files-btn").css({ "display": "inline-block" });
          $("#ggroup").val(groupId);
        } else {
          $(".upload-files-btn").css({ "display": "none" });
          $(".con-vaild").html("sorry, you can't send messages in this group").css({ "display": "block" });
          // $(".upload-files-btn")
        }
        $("#chat-Message-data .content-ful").show();
        $("#chat-Message-data").attr('data-active', groupId);
        $(".chat-message .message-to-from").animate({ scrollTop: $('.chat-message .message-to-from').prop("scrollHeight") }, 500);
      }
    });

  })

  // send files
  var itemFile;
  $("form#up-data-File .file-up-data-load").change(function () {
    itemFile = $(this).prop("files")[0].name;
    
    $("form#up-data-File").submit();
  })

  $("form#up-data-File").on('submit', (function (e) {
    e.preventDefault();
    var group = $('#ggroup').val();
    $.ajax({
      url: base_url + "oper/up-files.php",
      type: "POST",
      data: new FormData(this),
      dataType:'json',
      contentType: false,
      cache: false,
      processData: false,
      
      success: function (data) {
        if (data.format == "1") {
          $.alert({
            title: "ERROR",
            content: "Not valid format"
          });
          
        }
        if (data.send == "1") {
          var imgSocket = {
            groupId: group,
            message: itemFile,
            userId: userId,
            username: userName,
            msgId: data.sendId,
            client: "browser",
            type: "2",
          };
          conn.emit('send message', JSON.stringify(imgSocket));
          $("form#up-data-File .file-up-data-load").val('');
        }

      },
      error: function (data) {
        
          $.alert({
            title: "ERROR",
            content: "Not valid format"
          });
        
      }
    });
  }));
  // send files

  


  $('form#form-set').submit(function (e) {
    e.preventDefault();
    var message = $("#emo").val();
    var group = $(this).attr('data-group');
    
    if ( message.length >= 1) {
      
    
    $.ajax({
      url: base_url + "oper/ajax.php?key=send",
      method: "POST",
      dataType: "JSON",
      data: {
        'IP': 'recordMessage',
        'groupId': group,
        'message': message,
        'userId': id,
        // 'files': fileq
      },
      success: function (data) {
        if (data.send != "1") {
          $.alert({
            title: "ERROR",
            content: "something was wrong please try again"
          }); 

        } else {
          var dataSocket = {
            groupId: group,
            message: message,
            userId: userId,
            username: userName,
            msgId: data.sendId,
            client: "browser",
            type: "1",
          };

          conn.emit("send message", JSON.stringify(dataSocket));
          $("#emo").val("");

        }
      }
    }) 

      
  } else {

  }

  
    // return false;
  });
  // end send message



  

  // send a problem by ajax
  // send admin AJAX
  $("#sendProblem").click(function (e) {
    e.preventDefault();
    var level = $("#levels").val();
    var text = $("#text").val();

    if (level != 0 && text != "") {
      $.ajax({
        url: base_url + "oper/ajax.php?key=problem",
        method: "post",
        dataType: "json",
        data: {
          add: 'problem',
          text: text,
          level: level
        },
        success: function (data) {
          if (data.send == "1") {
            $.alert({
              title: "confirm",
              content: "your message has been sent"
            })
            setInterval(() => {
              level = $("#levels").val("");
              text = $("#text").val("");
              window.close();
            }, 2000);
          } else {
            $.alert({
              title: "alert",
              content: "there is a problem please try again"
            })
          }
        }
      })
    } else {
      $("#result").html("<p class='alert alert-danger'>select type of a problem</p>");
    }
  });

  $("#editFileImage").change(function () {
    vars = $(this).prop("files")[0].name;
    
  });

  $("#formEdit").submit(function (e) {
    e.preventDefault();
    
    var check = 0;
    $("#formEdit input").each(function () {
        if ($(this).val().trim() == '') {
          if ($(this).attr('type') == 'file') {
            check = 1;
          } else {
            check = 0;
            $(this).css({ 'border-color': 'red' });
          }
        } else {
          check = 1;
        }
    });
    if (check === 1) {
      $.ajax({
        url: base_url + "oper/ajax.php?key=editprofile",
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
          $.alert({
            title: "Alert",
            content: data
          });
          $(".image-portfolio img").attr("src",base_url + `assets/img/upload/`+vars+``);
        }
      });
    } else {
      alert();
    }
  })
  $(".one-user").each(function (){
    var itemNum = $(this).children().find('#numOfMs');
    if (itemNum.html() == "0") {
      itemNum.css({ 'display': 'none' });
    } else {
      
      itemNum.css({ 'display': 'inline-block' });
    }
  });


  $("#emo").focus(function () {
    var group = $(this).parents().find("#form-set").attr("data-group");

    $.ajax({
      url: base_url + "oper/ajax.php?key=makeseen",
      type: "POST",
      data: {
        groupId: group
      }
    })
  })

  $(".send-button").click(function () {
    $('form#form-set').submit();
  })

  

}); // end jquery

// $(window).on('beforeunload', function () {

//   // $.ajax({
//   //   url: base_url + "oper/up-files.php",
//   // });
//   return '';
// });