<?php

session_start();


  if (@$_SESSION['loginAdmin'] !== "EaaliMChatSession") {
    header("location: ../index");
	}
  
  include "../../config.php";
?>