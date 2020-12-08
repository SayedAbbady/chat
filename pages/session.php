<?php
  session_start();
  ob_start();
  if (!isset($_SESSION['chatUserLogin']) && $_SESSION['chatUserLogin'] !== true) {
    header("location: ../login");
  } 

  include '../config.php';

?>