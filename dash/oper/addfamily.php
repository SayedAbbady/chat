<?php
include "../../config.php";

include "data.php";

$addTe = new data();

$info = [];



  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $url = $_POST['url'];
  $zoomlink = $_POST['zoomlink'];
  $pass = base64_encode($_POST['pass']);
  $passc = base64_encode($_POST['passc']);
  $gender = $_POST['gender'];

  if (empty($fname) || empty($lname) || empty($email) || empty($pass) || empty($gender) || empty($phone) || empty($url) || empty($zoomlink)) {
    $info['state'] = "All failds are required";
  echo json_encode($info);

  } else {
    if ($gender == "") {
      $info['state'] = "All failds are required";
    echo json_encode($info);

    } else {
      if ($pass !== $passc) {
        $info['state'] = "password fildes not match";
      echo json_encode($info);

      } else {
        if ($gender == "male") {
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
          'par',
          "0",
          "$img",
          '0',
          "$email",
          "$pass",
          '0',
          "$phone",
          "$url",
          "$zoomlink"
        );
        if ($addTe->addFamily($table, $colums, $values)) {
          $info['state'] = "Family added";
          echo json_encode($info);
        }
      }
    }
  }

