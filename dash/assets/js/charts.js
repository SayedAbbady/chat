
$(function () {

  $.ajax({

    url: base_url + "dash/oper/charts.php",
    method:'post',
    dataType: "JSON",
    success: function (data) {
      var student = data.student;
      var studentnoactive = data.studentnoactive;
      var supere = data.supere;
      var teacher = data.teacher;
      var teachernoactive = data.teachernoactive;
      var admin = data.admin;
      var groups = data.groups;
      var groupsnoactive = data.groupsnoactive;
      var parent = data.parent;
      var child = data.child;
    
      
var ctx = document.getElementById('myChart').getContext('2d');

 new Chart(ctx, {
   type: 'bar',
    data: {
      labels: ['Student', 'Unactive students','Familys','Child','Supervisor', 'Teachers', 'Unactive teachers', 'Admins', 'groups', 'Unactive groups'],
        datasets: [{
          label: 'Number',
          data: [student, studentnoactive, parent, child, supere, teacher, teachernoactive, admin, groups, groupsnoactive],
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                'rgba(255, 159, 64, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(255, 99, 132, 0.5)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(255, 99, 132, 1)',
            ],
            borderWidth: 2
        }]
    },
    options: {
        scales: {
        
            yAxes: [{
                ticks: {
                  beginAtZero: true
                }
            }]
        }
    }
});

    }
  });

});