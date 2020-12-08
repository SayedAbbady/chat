<?php
include "../../config.php";
include "data.php";

$addTe = new data();

// adding

if (isset($_POST['add']) && $_POST['add'] == 'addTe') {
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $url = $_POST['url'];
  $zoomlink = $_POST['zoomlink'];
  $pass = base64_encode($_POST['pass']);
  $gender = $_POST['gender'];
  if (empty($fname) || empty($lname) || empty($email) || empty($pass) || empty($gender) || empty($phone) || empty($url) ||empty($zoomlink)) {
    echo "<div class='alert alert-danger'>all failds must be full</div>";
  } else {
    if ($gender == "-- select gender --") {
      echo "<div class='alert alert-danger'>Select gender is required</div>";
    } else {
      if ($gender == "Male") {
        $img = "Avatarmale.png";
      } else {
        $img = "avatarfemale.png";
      }
      $table = '`users`';
      $colums = '`uFname`, `uLname`, `uGender`, `uType`, `uPhone`,`uUrl`,`uZoom`, `tId`, `uImage`, `uActive`, `uEmail`, `uPassword`, `gId`';
      $values = array(
        "$fname",
        "$lname",
        "$gender",
        'Te',
        '0',
        "$img",
        '0',
        "$email",
        "$pass",
        '0',
        "$phone",
        "$url",
        "$zoomlink"
      );
      $addTe->add($table, $colums, $values);
    }
  }
}
if (isset($_POST['add']) && $_POST['add'] == 'addstu') {
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $url = $_POST['url'];
  $zoomlink = $_POST['zoomlink'];
  $pass = base64_encode($_POST['pass']);
  $gender = $_POST['gender'];
  $teacherid = base64_decode($_POST['teacherid']);
  $teachername = base64_decode($_POST['teachername']);
  if (empty($fname) || empty($lname) || empty($email) || empty($pass) || empty($gender) || empty($teacherid) || empty($phone) || empty($url) || empty($zoomlink) ) {
    echo "<div class='alert alert-danger'>all failds must be full</div>";
  } else {
    if ($gender == "-- select gender --") {
      echo "<div class='alert alert-danger'>Select gender is required</div>";
    } else {
      if ($gender == "Male") {
        $img = "Avatarmale.png";
      } else {
        $img = "avatarfemale.png";
      }
      $table = '`users`';
      $colums = '`uFname`, `uLname`, `uGender`, `uType`, `uPhone`,`uUrl`,`uZoom`, `tId`, `uImage`, `uActive`, `uEmail`, `uPassword`, `gId`';
      $values = array(
        "$fname",
        "$lname",
        "$gender",
        'stu',
        "$teacherid",
        "$img",
        '0',
        "$email",
        "$pass",
        '0',
        "$phone",
        "$url",
        "$zoomlink",
        "$teachername"
      );
      $addTe->add($table, $colums, $values);
    }
  }
}
if (isset($_POST['add']) && $_POST['add'] == 'addsupr') {
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $pass = base64_encode($_POST['pass']);
  $gender = $_POST['gender'];
  if (empty($fname) || empty($lname) || empty($email) || empty($pass) || empty($gender)) {
    echo "<div class='alert alert-danger'>all failds must be full</div>";
  } else {
    if ($gender == "-- select gender --") {
      echo "<div class='alert alert-danger'>Select gender is required</div>";
    } else {

      if ($gender == "Male") {
        $img = "Avatarmale.png";
      } else {
        $img = "avatarfemale.png";
      }
      $table = '`users`';
      $colums = '`uFname`, `uLname`, `uGender`, `uType`, `uPhone`,`uUrl`,`uZoom`, `tId`, `uImage`, `uActive`, `uEmail`, `uPassword`, `gId`';
      $values = array(
        "$fname",
        "$lname",
        "$gender",
        'supr',
        "0",
        "$img",
        '0',
        "$email",
        "$pass",
        '0',
        "3",
        "3",
        "3",
        "3"
      );
      $addTe->add($table, $colums, $values);
      
    }
  }
}
if (isset($_POST['add']) && $_POST['add'] == 'addadmin') {
  $fname = $_POST['fname'];
  $email = $_POST['email'];
  $level = $_POST['level'];

  $pass = base64_encode($_POST['pass']);
  if (empty($fname)  || empty($email) || empty($pass) || empty($level)) {
    echo "<div class='alert alert-danger'>all failds must be full</div>";
  } else {
    $table = '`admin`';
    $colums = '`dEmail`, `dName`, `dPass`,`dLevel`';
    $values = array(
      "$email",
      "$fname",
      "$pass", 
      "$level"
    );
    $addTe->addAdminOrGroup($table, $colums, $values);
  }
}

// Editting********************************************
//admin
if (isset($_POST['add']) && $_POST['add'] == 'editadmin') {
  $id = base64_decode($_POST['id']);
  $fname = $_POST['fname'];
  $email = $_POST['email'];
  $pass = base64_encode($_POST['pass']);
  if (empty($fname)  || empty($email) || empty($pass) ) {
    echo "<div class='alert alert-danger'>all failds must be full</div>";
  } else {
    $table = '`admin`';
    $data =  "`dEmail` = '$email', `dName` = '$fname', `dPass` = '$pass'  WHERE `admin`.`dId` = '$id'";
    $addTe->editAdmin($table , $data);
  }
}

  //supervisor
if (isset($_POST['add']) && $_POST['add'] == 'editsupr') {
  $id = base64_decode($_POST['id']);
  $fname = $_POST['fname'];
  $email = $_POST['email'];
  $pass = base64_encode($_POST['pass']);
  $gender = $_POST['gender'];
  if (empty($fname)  || empty($email) || empty($pass) || empty($gender)) {
    echo "<div class='alert alert-danger'>all failds must be full</div>";
  } else {
    if ($gender == "Male") {
      $img = "Avatarmale.png";
    } else {
      $img = "avatarfemale.png";
    }
    $table = '`users`';
    $data =  " `uFname` = '$fname', `uGender` = '$gender' , `uImage` = '$img' ,`uEmail` = '$email', `uPassword` = '$pass'  WHERE `users`.`uId` = '$id'";
    $addTe->editAdmin($table , $data);
  }
}

//teacher
if (isset($_POST['add']) && $_POST['add'] == 'editte') {
  $id = base64_decode($_POST['id']);
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $pass = base64_encode($_POST['pass']);
  $gender = $_POST['gender'];
  $status = $_POST['status'];
  if (empty($fname)  || empty($lname) || empty($email) || empty($pass) || empty($gender)) {
    echo "<div class='alert alert-danger'>all failds must be full</div>";
  } else {
    if ($gender == "Male") {
      $img = "Avatarmale.png";
    } else {
      $img = "avatarfemale.png";
    }
    if ($status == 'Active') {
      $statu = "1";
    } else {
      $statu = "0";
    }
    $table = '`users`';
    $data =  " `uFname` = '$fname',`uLname` = '$lname', `uStatus` = '$statu' ,`uGender` = '$gender' , `uImage` = '$img' ,`uEmail` = '$email', `uPassword` = '$pass'  WHERE `users`.`uId` = '$id'";
    $addTe->editAdmin($table , $data);
  }
}

// student
if (isset($_POST['add']) && $_POST['add'] == 'editstudent') {
  $id = base64_decode($_POST['id']);
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $pass = base64_encode($_POST['pass']);
  $gender = $_POST['gender'];
  $status = $_POST['status'];
  $teacherid = base64_decode($_POST['teacherid']);
  $oldtea = base64_decode($_POST['oldtea']);
  $teachername = base64_decode($_POST['teachername']);
  if (empty($fname) || empty($lname) || empty($email) || empty($pass) || empty($gender)) {
    echo "<div class='alert alert-danger'>all failds must be full</div>";
  } else {
    if ($gender == "Male") {
      $img = "Avatarmale.png";
    } else {
      $img = "avatarfemale.png";
    }
    if ($status == 'Active') {
      $statu = "1";
    } else {
      $statu = "0";
    } 
    $table = '`users`';
    $data =  " `uFname` = '$fname',`uLname` = '$lname', `uStatus` = '$statu' ,`uGender` = '$gender' , `tId` = '$teacherid' ,`uImage` = '$img' ,`uEmail` = '$email', `uPassword` = '$pass'  WHERE `users`.`uId` = '$id'";

    $addTe->editAdmin($table , $data);

    if ($teacherid !== $oldtea) {
      $tableg = '`groups`';
      $datag = "`status` = '0' WHERE `idStudent` = '$id' AND `idTeacher` = '$oldtea' ";
      $value = array(
        "$fname",
        "$teacherid",
        "$id",
        "$teachername",
        "$lname"
      );
      $addTe->editAdmin($tableg , $datag);
      $addTe->addgroupstudent($tableg,$value);
    }
    
  }
}

//family
if (isset($_POST['add']) && $_POST['add'] == 'editfamily') {
  $id = base64_decode($_POST['id']);
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $purl = $_POST['purl'];
  $phone = $_POST['phone'];
  $zoom = $_POST['zoom'];
  $pass = base64_encode($_POST['pass']);
  $gender = $_POST['gender'];
  $status = $_POST['status'];
  if (empty($fname) || empty($lname) || empty($email) || empty($pass) || empty($gender) || empty($phone)) {
    echo "<div class='alert alert-danger'>all failds must be full</div>";
  } else {
    if ($gender == "Male") {
      $img = "Avatarmale.png";
    } else {
      $img = "avatarfemale.png";
    }
    if ($status == 'Active') {
      $statu = "1";
    } else {
      $statu = "0";
    } 
    $table = '`users`';
    $data =  " `uFname` = '$fname',
               `uLname` = '$lname', 
               `uGender` = '$gender' ,
               `uPhone` = '$phone', 
               `uStatus` = '$statu', 
               `uImage` = '$img', 
               `uEmail` = '$email', 
               `uPassword` = '$pass' WHERE `users`.`uId` = '$id'";

    $addTe->editAdmin($table , $data);

    
  }
}

// group
if (isset($_POST['add']) && $_POST['add'] == 'editgroup') {
  $id = base64_decode($_POST['$id']);
  $status = $_POST['status'];
  @$value = $_POST['supervalue'];
  $namegroup = $_POST['namegroup'];

  if ($status == 'Active') {
      $statu = "1";
    } else {
      $statu = "0";
    } 

  $table = '`groups`';
  $data = "`gName` = '$namegroup',`status` = '$statu' WHERE `groups`.`gId` = '$id'";
  // $addTe->editAdmin($table,$data);
  if (@count($value) >= 1) {

      $addTe->multisuper($id,$value);

  }
}



// *****************************************************

// Deleting
// admin
if (isset($_POST['add']) && $_POST['add'] == 'deleteadmin') {
  $id = $_POST['id'];
  $table = '`admin`';
  $data = "`admin`.`dId` ='$id'";
  $addTe->delete($table,$data);
}

// child
if (isset($_POST['add']) && $_POST['add'] == 'deletechild') {
  $id = $_POST['id'];
  $table = '`family`';
  $data = "`family`.`f_id` ='$id'";
  $addTe->delete($table,$data);
}

// member (student AND super)
if (isset($_POST['add']) && $_POST['add'] == 'Deletemember') {
  $id = $_POST['id'];
  $table = '`users`';
  $data = "`users`.`uId` ='$id'";
  $addTe->delete($table,$data);
}

// member (Supervisor From group)
if (isset($_POST['add']) && $_POST['add'] == 'Deletemembersup') {
  $id = $_POST['id'];
  $idgroup = $_POST['idgroup'];
  $table = '`gsuper`';
  $data = "`idSupervisor` ='$id' AND `gId`='$idgroup'";
  $addTe->delete($table,$data);
}


// member (teacher)
if (isset($_POST['add']) && $_POST['add'] == 'Delette') {
  $id = $_POST['id'];
  $table = '`users`';
  $datagd = "`users`.`uId` ='$id'";
  $condtion = "`users`.`tId` = '$id'";

  $te = $addTe->fetchCon("$table" , "$condtion");
  if ($te->rowCount() >= 1) {
    $data['msg'] = "<span class='text-white bg-danger'>this teacher still has student</span>";
    echo json_encode($data);
  } else {
    
    $addTe->delete($table,$datagd);
    
  }

}

// member (Supervisor From group)
if (isset($_POST['add']) && $_POST['add'] == 'Deleteproblem') {
  $id = $_POST['id'];
  $table = '`problem`';
  $data = "`p_id` ='$id'";
  $addTe->delete($table, $data);
}