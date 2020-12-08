$(function () {
  'use strict';

  var base_url = 'http://localhost/chat/dash/';

  function autoscroll() {
    $('body, html').animate({
      scrollTop: 0
    }, 500);
  }

  //Adding
  // send teacher AJAX
  $("#send").click(function (e) {
    e.preventDefault();
    var fname = $("#fname").val();
    var lname = $("#lname").val();
    var email = $("#email").val();
    var pass = $("#pass").val();
    var passc = $("#passc").val();
    var phone = $("#phone").val();
    var url = $("#url").val();
    var zoomlink = $("#zoomlink").val();
    var gender = $("#gender option:selected").text();

    if (pass === passc) {
      $.ajax({
        url: base_url + "oper/ajax.php",
        method: "post",
        data: {
          add: 'addTe',
          fname: fname,
          lname: lname,
          email: email,
          pass: pass,
          gender: gender,
          phone: phone,
          url: url,
          zoomlink: zoomlink
        },
        success: function (data) {
          autoscroll();
          $("#result").html(data);
          fname = $("#fname").val("");
          lname = $("#lname").val("");
          email = $("#email").val("");
          pass = $("#pass").val("");
          passc = $("#passc").val("");
          phone = $("#phone").val("");
          url = $("#url").val("");
          zoomlink = $("#zoomlink").val("");
          gender = $("#gender").prop('selectedIndex', 0);
          setInterval(function () { $("#result").empty(); }, 10000);
        }

      })
    } else {
      $("#result").html("<p class='alert alert-danger'>passwords not match</p>");
    }
  });
  // end Teacher AJAX


  // send Student AJAX
  $("#sendstudent").click(function (e) {
    e.preventDefault();
    var fname = $("#fname").val();
    var lname = $("#lname").val();
    var email = $("#email").val();
    var pass = $("#pass").val();
    var passc = $("#passc").val();
    var phone = $("#phone").val();
    var url = $("#url").val();
    var zoomlink = $("#zoomlink").val();
    var gender = $("#gender option:selected").text();
    var teacherid = $("#selectTeacher").find(':selected').data('te');
    var teachername = $("#selectTeacher").find(':selected').data('tename');

    if (pass === passc) {
      $.ajax({
        url: base_url + "oper/ajax.php",
        method: "post",
        data: {
          add: 'addstu',
          fname: fname,
          lname: lname,
          email: email,
          pass: pass,
          phone: phone,
          url: url,
          zoomlink: zoomlink,
          gender: gender,
          teacherid: teacherid,
          teachername: teachername
        },
        success: function (data) {
          autoscroll();
          $("#result").html(data);
          fname = $("#fname").val("");
          lname = $("#lname").val("");
          email = $("#email").val("");
          pass = $("#pass").val("");
          passc = $("#passc").val("");
          phone = $("#phone").val("");
          url = $("#url").val("");
          zoomlink = $("#zoomlink").val("");
          gender = $("#gender").prop('selectedIndex', 0);
          $("#selectTeacher").prop('selectedIndex', 0);
          setInterval(function () { $("#result").empty(); }, 10000);
        }

      })
    } else {
      $("#result").html("<p class='alert alert-danger'>Error in data</p>");
    }
  });
  //End student AJAX





  // send super AJAX
  $("#sendsuper").click(function (e) {
    e.preventDefault();
    var fname = $("#fname").val();
    var lname = $("#lname").val();
    var email = $("#email").val();
    var pass = $("#pass").val();
    var passc = $("#passc").val();
    var gender = $("#gender option:selected").text();

    if (pass === passc) {
      $.ajax({
        url: base_url + "oper/ajax.php",
        method: "post",
        data: {
          add: 'addsupr',
          fname: fname,
          lname: lname,
          email: email,
          pass: pass,
          gender: gender
        },
        success: function (data) {
          autoscroll();
          $("#result").html(data);
          fname = $("#fname").val("");
          email = $("#email").val("");
          pass = $("#pass").val("");
          passc = $("#passc").val("");
          gender = $("#gender").prop('selectedIndex', 0);

          setInterval(function () { $("#result").empty(); }, 10000);
        }

      })
    } else {
      $("#result").html("<p class='alert alert-danger'>passwords not match</p>");
    }
  });
  //End super AJAX


  // send admin AJAX
  $("#sendadmin").click(function (e) {
    e.preventDefault();
    var fname = $("#fname").val();
    var email = $("#email").val();
    var pass = $("#pass").val();
    var passc = $("#passc").val();
    var level = $("#levels").val();

    if (pass === passc && level != 0) {
      $.ajax({
        url: base_url + "oper/ajax.php",
        method: "post",
        data: {
          add: 'addadmin',
          fname: fname,
          email: email,
          pass: pass,
          level: level
        },
        success: function (data) {
          autoscroll();
          $("#result").html(data);
          fname = $("#fname").val("");
          email = $("#email").val("");
          pass = $("#pass").val("");
          passc = $("#passc").val("");

          setInterval(function () { $("#result").empty(); }, 10000);
        }

      })
    } else {
      $("#result").html("<p class='alert alert-danger'>passwords not match</p>");
    }
  });
  //End super AJAX

  // *************************************************************************************

  // Editing

  //edit Admin
  $("#editadmin").click(function (e) {
    e.preventDefault();
    var $id = $(this).data('del');
    var fname = $("#fname").val();
    var email = $("#email").val();
    var pass = $("#pass").val();
    var passc = $("#passc").val();

    if (pass === passc) {
      $.ajax({
        url: base_url + "oper/ajax.php",
        method: "post",
        data: {
          add: 'editadmin',
          fname: fname,
          email: email,
          pass: pass,
          id: $id
        },
        success: function (data) {
          autoscroll();
          $("#result").html(data);

          setInterval(function () {
            $("#result").empty();
            $(location).attr('href', base_url + 'pages/admin');
          }, 5000);

        }

      })
    } else {
      $("#result").html("<p class='alert alert-danger'>passwords not match</p>");
    }
  });

  //************* */

  // edit supervisor
  $("#editsuper").click(function (e) {
    e.preventDefault();
    var $id = $(this).data('del');
    var fname = $("#fname").val();
    var email = $("#email").val();
    var pass = $("#pass").val();
    var passc = $("#passc").val();
    var gender = $("#gender option:selected").text();

    if (pass === passc) {
      $.ajax({
        url: base_url + "oper/ajax.php",
        method: "post",
        data: {
          add: 'editsupr',
          fname: fname,
          email: email,
          pass: pass,
          gender: gender,
          id: $id
        },
        success: function (data) {
          autoscroll();
          $("#result").html(data);
          setInterval(function () {
            $("#result").empty();
            $(location).attr('href', base_url + 'pages/supervisor');
          }, 5000);
        }
      })
    } else {
      $("#result").html("<p class='alert alert-danger'>passwords not match</p>");
    }
  })
  //************** */

  //edit teacher
  $("#editte").click(function (e) {
    e.preventDefault();
    var $id = $(this).data('del');
    var fname = $("#fname").val();
    var lname = $("#lname").val();
    var email = $("#email").val();
    var pass = $("#pass").val();
    var passc = $("#passc").val();
    var gender = $("#gender option:selected").text();
    var status = $("#status option:selected").text();

    if (pass === passc) {
      $.ajax({
        url: base_url + "oper/ajax.php",
        method: "post",
        data: {
          add: 'editte',
          fname: fname,
          lname: lname,
          email: email,
          pass: pass,
          gender: gender,
          status: status,
          id: $id
        },
        success: function (data) {
          autoscroll();
          $("#result").html(data);
          setInterval(function () {
            $("#result").empty();
            $(location).attr('href', base_url + 'pages/teacher');
          }, 5000);
        }
      })
    } else {
      $("#result").html("<p class='alert alert-danger'>passwords not match</p>");
    }
  })
  //************* */

  //edit student
  $("#editstudent").click(function (e) {
    e.preventDefault();
    var $id = $(this).data('del');
    var oldtea = $("#oldtea").val();
    var fname = $("#fname").val();
    var lname = $("#lname").val();
    var email = $("#email").val();
    var pass = $("#pass").val();
    var passc = $("#passc").val();
    var gender = $("#gender option:selected").text();
    var status = $("#status option:selected").text();
    var teacherid = $("#selectTeachers").find(':selected').data('te');
    var teachername = $("#selectTeachers").find(':selected').data('tename');

    if (pass === passc) {
      $.ajax({
        url: base_url + "oper/ajax.php",
        method: "post",
        data: {
          add: 'editstudent',
          fname: fname,
          lname: lname,
          email: email,
          pass: pass,
          gender: gender,
          status: status,
          id: $id,
          teacherid: teacherid,
          oldtea: oldtea,
          teachername: teachername
        },
        success: function (data) {
          autoscroll();
          $("#result").html(data);
          setInterval(function () {
            $("#result").empty();
            $(location).attr('href', base_url + 'pages/student');
          }, 5000);
        }
      })
    } else {
      $("#result").html("<p class='alert alert-danger'>passwords not match</p>");
    }
  });
 
  // edit Family
  $("#editfamily").click(function (e) {
    e.preventDefault();
    var $id = $(this).data('del');
    var fname = $("#fname").val();
    var lname = $("#lname").val();
    var email = $("#email").val();
    var pass = $("#pass").val();
    var purl = $("#pUrl").val();
    var phone = $("#phone").val();
    var zoom = $("#uzoom").val();
    var passc = $("#passc").val();
    var gender = $("#gender option:selected").text();
    var status = $("#status option:selected").text();

    if (pass === passc) {
      $.ajax({
        url: base_url + "oper/ajax.php",
        method: "post",
        data: {
          add: 'editfamily',
          fname: fname,
          lname: lname,
          email: email,
          purl: purl,
          phone: phone,
          zoom: zoom,
          pass: pass,
          gender: gender,
          status: status,
          id: $id,
        },
        success: function (data) {
          autoscroll();
          $("#result").html(data);
          setInterval(function () {
            $("#result").empty();
            $(location).attr('href', base_url + 'pages/student');
          }, 5000);
        }
      })
    } else {
      $("#result").html("<p class='alert alert-danger'>passwords not match</p>");
    }
  })

  //edit group
  $("#editgroup").click(function (e) {
    e.preventDefault();
    var $id = $(this).data('del');
    var supervalue = $("#selectSuper").val();
    var namegroup = $("#nameGroup").val();
    var status = $("#status option:selected").text();

    $.ajax({
      url: base_url + "oper/ajax.php",
      method: "post",
      data: {
        add: 'editgroup',
        $id: $id,
        status: status,
        namegroup: namegroup,
        supervalue: supervalue
      },
      success: function (data) {
        autoscroll();
        $("#result").html(data);
      }

    });
  })








  // *************************************************************************************
  // delete Admin
  $(".DeleteId").click(function (e) {
    e.preventDefault();
    var $ID = $(this).data('del');

    $.confirm({
      title: 'Delete Admin',
      content: 'You want delete this Admin',
      buttons: {
        confirm: function () {
          $("#" + $ID).fadeOut(1500);

          $.ajax({
            url: base_url + "oper/ajax.php",
            method: "post",
            data: {
              add: 'deleteadmin',
              id: $ID
            },
            success: function (data) {
              $.alert(data.msg);
            }
          });
        },
        cancel: function () {

        }
      }
    });
  })


  // delete Child
  $(".DeleteChild").click(function (e) {
    e.preventDefault();
    var $ID = $(this).data('del');

    $.confirm({
      title: 'Delete Child',
      content: 'You want delete this Child',
      buttons: {
        confirm: function () {
          $("#" + $ID).fadeOut(1500);

          $.ajax({
            url: base_url + "oper/ajax.php",
            method: "post",
            dataType: "JSON",
            data: {
              add: 'deletechild',
              id: $ID
            },
            success: function (data) {
              $.alert(data.msg);
            }
          });
        },
        cancel: function () {

        }
      }
    });
  })

  // supervisor
  $(".Deletesuper").click(function (e) {
    e.preventDefault();
    var $ID = $(this).data('del');

    $.confirm({
      title: 'Delete member',
      content: 'You want delete this member',
      buttons: {
        confirm: function () {
          $("#" + $ID).fadeOut(1500);

          $.ajax({
            url: base_url + "oper/ajax.php",
            method: "post",
            dataType: "JSON",
            data: {
              add: 'Deletemember',
              id: $ID
            },
            success: function (data) {
              $.alert(data.msg);
            }
          });
        },
        cancel: function () {

        }
      }
    });
  })

  // problem
  $(".Deleteproblem").click(function (e) {
    e.preventDefault();
    var $ID = $(this).data("del");

    $.confirm({
      title: "Delete Problem",
      content: "You want delete this problem",
      buttons: {
        confirm: function () {
          $("#" + $ID).fadeOut(1500);

          $.ajax({
            url: base_url + "oper/ajax.php",
            method: "post",
            dataType: "JSON",
            data: {
              add: "Deleteproblem",
              id: $ID,
            },
            success: function (data) {
              $.alert(data.msg);
            },
          });
        },
        cancel: function () { },
      },
    });
  });


  // supervisor from Groups
  $(".Deletesupgrou").click(function (e) {
    e.preventDefault();
    var $ID = $(this).data('del');
    var $IDgroup = $(this).data('group');

    $.confirm({
      title: 'Delete member',
      content: 'You want delete this member',
      buttons: {
        confirm: function () {
          $("#" + $ID).fadeOut(1500);

          $.ajax({
            url: base_url + "oper/ajax.php",
            method: "post",
            dataType: "JSON",
            data: {
              add: 'Deletemembersup',
              id: $ID,
              idgroup: $IDgroup
            },
            success: function (data) {
              $.alert(data.msg);
            }
          });
        },
        cancel: function () {

        }
      }
    });
  })


  // teacher
  $(".Deletete").click(function (e) {
    e.preventDefault();
    var $ID = $(this).data('del');

    $.confirm({
      title: 'Delete member',
      content: 'You want delete this member',
      buttons: {
        confirm: function () {

          $.ajax({
            url: base_url + "oper/ajax.php",
            method: "post",
            dataType: "JSON",
            data: {
              add: 'Delette',
              id: $ID
            },
            success: function (data) {
              $.alert(data.msg);

              if (data.valid == 1) {
                $("#" + $ID).fadeOut(1500);
              }
            }
          });
        },
        cancel: function () {

        }
      }
    });
  })


  // Add Family
  $("#AddFamilyForm").submit(function (e) {
    e.preventDefault();
    $.ajax({
      url: base_url + "oper/addfamily.php",
      type: "POST",
      data: new FormData(this),
      dataType: "JSON",
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
        autoscroll();
        if (data.state != undefined) {
          $("#result").html(
            `<div class="alert alert-danger">` + data.state + `</div>`
          );
        } else if (data.bool == "1") {
          $("#result").html(
            `<div class="alert alert-success">` + data.adding + `</div>`
          );
          $("#addChild").html(`<a href="` + base_url + `pages/add.php?child=` + data.lastId + `">Add children</a>`);

          $("input").val('');
        }
        setInterval(function () { $("#result").empty(); }, 7000);
      }
    });
  });
  // EndAdd Family

  // add child
  $("#AddChildForm").submit(function (e) {
    e.preventDefault();
    $.ajax({
      url: base_url + "oper/addChild.php",
      type: "POST",
      data: new FormData(this),
      dataType: "JSON",
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
        console.log(data.state);
        autoscroll();
        
        if (data.state != undefined) {
          $("#result").html(
            `<div class="alert alert-danger">` + data.state + `</div>`
          );
        }
        if (data.done != undefined) {
          $("#result").html(
            `<div class="alert alert-success">` + data.done + `</div>`
          );
          $("#selectTeacher").prop('selectedIndex', 0);
          $("input[type='text']").val('');

        }
        setInterval(function () { $("#result").empty(); }, 7000);
      }
    });
  });
  // End add child

});