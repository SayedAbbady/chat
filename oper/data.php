<?php

  error_reporting(E_ALL);

  class data {
	  private $option = array (
		  PDO:: MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4',
		  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
	  );

	  private function conn(){
		  $dsn = 'mysql:host='.db_host . ';dbname=' .db_name;
		  $pdo = new PDO($dsn , db_user , db_pwd , $this->option);

		  $pdo->setAttribute(PDO:: ATTR_DEFAULT_FETCH_MODE , PDO:: FETCH_ASSOC);

		  return $pdo;
	  }

  	public function login($email, $pass){
	    $upass = base64_encode($pass);
	    $pdo = $this->conn();
	    $sql = "SELECT * FROM `users` WHERE `uEmail`='$email' AND `uPassword`='$upass'";
	    $stmt = $pdo->query($sql);
//	    $num = $stmt->rowCount();
	    $data = $stmt->fetch(PDO::FETCH_ASSOC);
	    if (!empty($data) && $data['uStatus'] == 1){
		    $id = $data['uId'];
		    $pdo->query("UPDATE `users` SET `uActive` = '1' WHERE `users`.`uId` = '$id'");
	    }

	    return empty($data)?false : $data;
    }

    public function getuser($id) {
      $sql = "SELECT * FROM `users` WHERE `users`.`uId`='$id' ";
      $stmt = $this->conn()->query($sql);
      $users = $stmt->fetch(PDO::FETCH_ASSOC);
      return $users; 
    }

    public function fetchMessage($condition,$id,$type)
    {
//	    $sql = "SELECT msg.*, users.uImage AS mSenderPhoto FROM `msg` LEFT JOIN `users` ON msg.mSender = users.uId  WHERE $condition ORDER BY mId ASC LIMIT 80";
        $sql = "SELECT * FROM (SELECT * FROM `msg` WHERE $condition ORDER BY mId DESC LIMIT 80 )Var1 ORDER BY mId ASC";
        $stmt = $this->conn()->query($sql);
        $this->conn()->exec("UPDATE `msg` SET $type = '1' WHERE `msg`.`gId` = '$id'");
        return $stmt;
    }

    public function fetchCon($table , $condition)
    {
      $sql = "SELECT * FROM $table WHERE $condition ";
      $stmt = $this->conn()->query($sql);
      return $stmt;
    }

  public function tealtime($table, $condition, $id)
  {
    $pdo = $this->conn();
    $pdo->beginTransaction();

    $sql = "SELECT * FROM $table WHERE $condition ";
    $stmt = $pdo->query($sql);
    $pdo->exec("UPDATE `msg` SET `mSeen` = '1' WHERE `msg`.`gId` = '$id' ");
    $pdo->commit();
    return $stmt;
  }
  
  public function tealtimeteacher ($table, $condition, $id)
  {
    $pdo = $this->conn();
    $pdo->beginTransaction();

    $sql = "SELECT * FROM $table WHERE $condition ";
    $stmt = $pdo->query($sql);
    $pdo->exec("UPDATE `msg` SET `mSeenT` = '1' WHERE `msg`.`gId` = '$id' ");
    $pdo->commit();
    return $stmt;
  }
  public function tealtimesuper ($table, $condition, $id)
  {
    $pdo = $this->conn();
    $pdo->beginTransaction();

    $sql = "SELECT * FROM $table WHERE $condition ";
    $stmt = $pdo->query($sql);
    $pdo->exec("UPDATE `msg` SET `mSeenS` = '1' WHERE `msg`.`gId` = '$id' ");
    $pdo->commit();
    return $stmt;
  }


    public function fetchclumn($column , $table , $condition)
    {
      $sql = "SELECT $column FROM $table WHERE $condition ";
      $stmt = $this->conn()->query($sql);
      return $stmt;
    }

    public function fetchall($table)
    {
      $sql = "SELECT * FROM $table";
      $stmt = $this->conn()->query($sql);
      return $stmt;
    }

    public function makeSeen($type, $group) {
      $sql = "UPDATE `msg` SET $type = '1' WHERE `msg`.`gId` = '$group'";
      $this->conn()->query($sql);
    }
    
    public function edit($table , $data)
    {
      $sql = "UPDATE $table SET $data";
      $stmt = $this->conn()->query($sql);
      if ($stmt) {
        $d = "<div class='text-white bg-success'>Edit successfully</div>";
        echo $d;
      } else {
        $d = "<div class='text-white bg-danger'>someting is wrong</div>";
        echo $d;
      }
      
    }

    public function delete($table , $dataq)
    {
      $sql = "DELETE FROM $table WHERE $dataq";
      $stmt = $this->conn()->query($sql);
      if ($stmt) {
        echo "<span class='text-white bg-success'> removed successfully</span>";
      } else {
        echo "<div class='alert alert-danger'>something is wrong</div>";
      }
    }

    public function insert($table, $value){
      $sql = "INSERT INTO $table (`u_id`,`p_text`,`p_date`,`p_type`) VALUES ('$value[0]','$value[1]','$value[2]','$value[3]')";
      $this->conn()->query($sql);
      $info['send'] = '1';
      echo json_encode($info);
    }

    public function insertData($type,$table , $value) {
      $info=[];
      try {
        $pdo = $this->conn();
        $sql = "INSERT INTO $table (`mText`,`gId`,`mDate`,`mSender`,`mName`,`mType`,$type) VALUES ('$value[0]','$value[1]','$value[3]','$value[2]','$value[5]','$value[4]','1')";
        if($pdo->query($sql)){
          $last = $pdo->lastInsertId();
          $info['send'] = "1";
          $info['sendId'] = $last;
          // array_push($info,$last);
          echo json_encode($info);
        }
        
      } catch (Exception $th) {
        $info['error'] = $th->getMessage();
        echo json_encode($info);
      }
      
    }

    public function deleteMsgUser($id){
      $pdo= $this->conn();
      $pdo->query("UPDATE `msg` SET `mText` = 'this message deleted', `mType`='4' WHERE `msg`.`mId` = '$id'");
      $info = [];
      $info['done'] = "1";
      echo json_encode($info);
    }

    public function logout($id){
      $pdo = $this->conn();
      $pdo->query("UPDATE `users` SET `uActive` = '0' WHERE `users`.`uId` = '$id'");
      session_unset();
      session_destroy();
      $_SESSION = [""];
    }
    
  }

?>