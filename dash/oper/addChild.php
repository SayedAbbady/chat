<?php
include "../../config.php";

include "data.php";


$addTe = new data();

$info = [];

$parentId = base64_decode($_POST['parentId']);
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$gender = $_POST['gender'];
$teacherId = base64_decode($_POST['teacher']);


if (empty($fname) || empty($lname) || empty($gender)|| empty($parentId) || empty($teacherId)) {
  $info['state'] = "All failds are required";
  echo json_encode($info);
} else {
  $table = '`family`';
  $colums = '`u_id`, `f_fname`, `f_lname`, `f_status`, `f_gender`,`f_teacher`';
  $values = array(
    "$parentId",
    "$fname",
    "$lname",
    "1",
    "$gender",
    "$teacherId"
  );
  if ($addTe->addChild($table, $colums, $values)) {
    // $info['done'] = "Family added";
    echo json_encode($info);
  }
}



?>