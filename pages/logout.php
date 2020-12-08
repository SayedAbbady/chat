<?php
  session_start();

  $id = $_SESSION['userChatId'];
include_once "../config.php";
  include "../oper/data.php";

  $data = new data();
  if(session_destroy()){
	  $data->logout($id);
  }

  // var_dump($_SESSION['EXPIRES']);
  
  header("location: ../");
?>