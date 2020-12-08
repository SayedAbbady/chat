$(function () {
  "use strict";
 

  $("#example1").DataTable();
  $("#example2").DataTable();

  // $("#selectTeacher").select2({
  //   placeholder: $(this).prop('selectedIndex', 0),
  //   allowClear: true
  // });
  $("#selectSuper").select2();
  $("#selectStudent").select2();
  $("#selectSuper").select2();
  $('[data-toggle="tooltip"]').tooltip();

  $('#myTab a').on('click', function (e) {
    e.preventDefault()
    $(this).tab('show')
  })
});






