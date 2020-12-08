$(function(){
  
  function formatAMPM(date) {
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var ampm = hours >= 12 ? 'pm' : 'am';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0' + minutes : minutes;
    var strTime = hours + ':' + minutes + ' ' + ampm;
    console.log(strTime);
    return strTime;
  }

  conn.on('new message', function (response) {
    var time = formatAMPM(new Date);


    var data = $(JSON.parse(response));
    data = data[0];
    console.log(data);

    if (data.groupId == $("#chat-Message-data").attr('data-active')) {
      if (data.userId == userId) {
        var name = "";
        var classI = "usersend";
        var control =`
        <span class="dropdown">
          <span class="controo dropdown-toggle" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
            <span class="dropdown-item deletemessag">Delete</span>
            <span class="copymessage dropdown-item" onclick="copfunc('#mGD_`+data.msgId +`S')">Copy</span>
            </div>
          </span>
        </span>
          `;
      } else {
        var control = "";
        var name = data.username;
        var classI = "userrecieve";
      }

      if(data.type == "1"){
        $("#message").append(`
          <div class="`+ classI + `" id="mGD_`+data.msgId+`">
            `+control+`
            <span class="span">
              <p class="reciveP"><a href="profile?u=`+ data.userId + `&amp;g=` + data.groupId + ` " target="_blank">` + name + `</a></p>
              <div class="mosage" id="mGD_`+data.msgId+`S">`+ data.message + `</div>
              <p class="text-right" style="font-siz:10px">`+ formatAMPM(new Date) + `</p>
            </span>
          </div>
        `);
        $(".chat-message .message-to-from").animate({ scrollTop: $('.chat-message .message-to-from').prop("scrollHeight") }, 500);
        
        $(".deletemessag").click(function () {
          
          var parent = $(this).parent().parent().parent().parent();
          var idmms = parent[0].id;

          var newId = idmms.replace("mGD_", "");
          
          var group = $("#chat-Message-data").attr("data-active");

          $.ajax({
            url: base_url + "oper/ajax.php?key=deletemsg",
            method: "post",
            data: {
              MsgId: newId,
              groupId: group,
            },
            dataType: "JSON",
            success: function (date) {
              if (date.done == "1") {
                
                var ocket = {
                  msgid: newId,
                  groupId: group,
                  client: "browser",
                };
                
                conn.emit("delete message", JSON.stringify(ocket));
              }
            },
          });
        });
        
      } else {
        var message = data.message;
        fileExtension = message.replace(/^.*\./, '');
        var fileE = fileExtension.toLowerCase();
        if (fileE == "jpg" || fileE == "png" || fileE == "jpeg" || fileE   == "gif"){
          $("#message").append(`
          <div class="`+ classI + `" id="mGD_`+data.msgId+`">
          `+control+`
            <span class="span">
              <p class="reciveP"><a href="profile?u=`+ data.userId + `&amp;g=` + data.groupId + ` " target="_blank">` + name + `</a></p>
              <div class="mosage"><a href="../assets/img/files/`+ message + `" target="_blank"><img src="../assets/img/files/` + message +`"></a></div>
              <p class="text-right" style="font-siz:10px">`+ formatAMPM(new Date) + `</p>
            </span>
          </div>
        `);
          $(".chat-message .message-to-from").animate({ scrollTop: $('.chat-message .message-to-from').prop("scrollHeight") }, 500);
        } 
        
        if (fileE == "pdf" || fileE == "xlsx" || fileE == "docx"){
          console.log("true extintion");
          $("#message").append(`
          <div class="`+ classI + `" id="mGD_`+data.msgId+`">
          `+control+`
            <span class="span">
              <p class="reciveP"><a href="profile?u=`+ data.userId + `&amp;g=` + data.groupId + ` " target="_blank">` + name + `</a></p>
              <div class="mosage">
                <a href="../assets/img/files/`+ message + `" target="_blank">
                  <i class="far fa-arrow-alt-circle-up"></i>
                  `+message+`
                </a>
              </div>
              <p class="text-right" style="font-siz:10px">`+ time + `</p>
            </span>
          </div>
        `);
          $(".chat-message .message-to-from").animate({ scrollTop: $('.chat-message .message-to-from').prop("scrollHeight") }, 500);
        } 

        $(".deletemessag").click(function () {
          var parent = $(this).parent().parent().parent().parent();
          var idmms = parent[0].id;

          var newId = idmms.replace("mGD_", "");
          
          var group = $("#chat-Message-data").attr("data-active");

          $.ajax({
            url: base_url + "oper/ajax.php?key=deletemsg",
            method: "post",
            data: {
              MsgId: newId,
              groupId: group
            },
            dataType: "JSON",
            success: function (date) {
              if (date.done == "1") {
                console.log("done");
                var ocket = {
                  msgid: newId,
                  groupId: group,
                  client: "browser",
                };
                console.log(ocket);
                conn.emit("delete message", JSON.stringify(ocket));
              }
            },
          });

        });


      } //end else if 
    } else {
      x.play();
      $(".one-user").each(function () {
        if ($(this).attr('data-group') === data.groupId) {
          var number = $(this).children().find('#numOfMs');
          number.css({ 'display': 'inline-block' });
          var count = parseInt(number.html());
          count += 1;
          number.html(count);
        }
      });
    }
  });

  conn.on("delete message", function (data) {
    var Pid = JSON.parse(data).msgid;
    
    var newId = parseInt(Pid);
    
      $("#mGD_"+Pid).html(
        `<span class="span"><div class="mosage"><i>this message deleted</i></div></span>`
      );
    
  }); 

function makeOnline(id) {
  // $(id).addClass('dd');
  if ($(id).hasClass('far')) {
    $(id).removeClass('far').addClass('fas');
    console.log(id);
  } 
}
  // online users 
  conn.on('online_user', function (data) {
    // console.log(data.socket_id);
    var $_id = '#'+ data.socket_id+'';
    makeOnline($_id);
    
  })

  

});
