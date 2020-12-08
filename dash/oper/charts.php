<?php
  include '../../config.php';
  include "data.php";

  $date = new data();
  $table = '`users`';
  $family = '`family`';

  //family
  $condition0 = "`uType`='par'";
  
  //student
  $condition = "`uType`='stu'";
  $condition11 = "`uType`='stu' AND `uStatus` = '0'";

  //supervisor
  $condition2 = "`uType`='supr'";

  //teacher
  $condition3 = "`uType`='te'";
  $condition33 = "`uType`='te' AND `uStatus` = '0'";

  //family
  $parent = $date->fetchCon($table, $condition0);

  //student
  $student = $date->fetchCon($table,$condition);
  $studentnoactive = $date->fetchCon($table,$condition11);

  //supervisor
  $super = $date->fetchCon($table,$condition2);

  //teacher
  $teacher = $date->fetchCon($table,$condition3);
  $teachernoactive = $date->fetchCon($table,$condition33);

  //family
  $familyn = $date->getAdminGroup('`family`');

  // admins
  $admin = $date->getAdminGroup('`admin`');

  //groups
  $groups = $date->getAdminGroup('`groups`');
  $groupsnoactive = $date->fetchCon('`groups`',"status = '0'");


  $data['student'] = $student->rowCount();
  $data['studentnoactive'] = $studentnoactive->rowCount();
  $data['parent'] = $parent->rowCount();
  $data['child'] = $familyn->rowCount();
  $data['supere'] = $super->rowCount();
  $data['teacher'] = $teacher->rowCount();
  $data['teachernoactive'] = $teachernoactive->rowCount();
  $data['admin'] = $admin->rowCount();
  $data['groups'] = $groups->rowCount();
  $data['groupsnoactive'] = $groupsnoactive->rowCount();

  echo json_encode($data);

?>