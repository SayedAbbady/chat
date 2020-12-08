<?php
  // include "../../config.php";
  error_reporting(E_ALL);

  class data {

	  private $option = array (
		  PDO:: MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
		  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
	  );

	  private function conn(){
		  $dsn = 'mysql:host='.db_host . ';dbname=' .db_name;
		  $pdo = new PDO($dsn , db_user , db_pwd , $this->option);

		  $pdo->setAttribute(PDO:: ATTR_DEFAULT_FETCH_MODE , PDO:: FETCH_ASSOC);

		  return $pdo;
	  }

    public function fetchCon($table , $condition)
    {
      $sql = "SELECT * FROM $table WHERE $condition ";
      $stmt = $this->conn()->query($sql);
      return $stmt;
    }
	  public function login($username , $pass)
	  {
		  $sql = "SELECT * FROM `admin` WHERE `dEmail`= ? AND `dPass`= ?";
		  $stmt = $this->conn()->prepare($sql);
		  $stmt->execute([$username , base64_encode($pass)]);

		  return $stmt;
	  }

    public function add($table , $colume , $values)
    {
      $sqlIsset = "SELECT * FROM $table WHERE `uEmail` = '$values[7]' ";
      $stmtIsset = $this->conn()->prepare($sqlIsset);
      $stmtIsset->execute();
      $num = $stmtIsset->rowCount();
      if ($num >= 1) {
        echo "<div class='alert alert-danger'>the user is exist</div>";
      } else {

        try {
          $pdo = $this->conn();
          $sql = "INSERT INTO $table ($colume) VALUES (:name,:last,:gender,:te,:phone,:url,:zoom,:id,:img,:active,:email,:pass,:gid)";
          $sql = $pdo->prepare($sql);
          $sql->bindParam(':name' , $values[0]);
          $sql->bindParam(':last' , $values[1]);
          $sql->bindParam(':gender' , $values[2]);
          $sql->bindParam(':te' , $values[3]);
          $sql->bindParam(':phone' , $values[10]);
          $sql->bindParam(':url' , $values[11]);
          $sql->bindParam(':zoom' , $values[12]);
          $sql->bindParam(':id' , $values[4]);
          $sql->bindParam(':img' , $values[5]);
          $sql->bindParam(':active' , $values[6]);
          $sql->bindParam(':email' , $values[7]);
          $sql->bindParam(':pass' , $values[8]);
          $sql->bindParam(':gid' , $values[9]);

          if ($values[3] == "stu"){
            $sql->execute();
            $lastId = $pdo->lastInsertId();
            $name = "$values[0] $values[1] " . "`s Group";
            $teachername = $values[13];
            $pdo->query("INSERT INTO `groups` (`gName`,`gSubname`,`idTeacher`, `idStudent`) VALUES ('$name', '$teachername','$values[4]', '$lastId')");
            
            echo "<div class='alert alert-success'>student and group added </div>";
            
          } else {
            if( $sql->execute()){
              echo "<div class='alert alert-success'>user added</div>";
            } else {
              echo "<div class='alert alert-danger'>something is wrong</div>";
            }
          }
          
        } catch (PDOException $e) {
          echo "Failed: " . $e->getMessage();
        }
      } // end al IF
        
      
    } // end al function

  public function addFamily($table, $colume, $values)
  {
    $info = [];
    $sqlIsset = "SELECT * FROM $table WHERE `uEmail` = '$values[7]'";
    $stmtIsset = $this->conn()->prepare($sqlIsset);
    $stmtIsset->execute();
    $num = $stmtIsset->rowCount();
    if ($num >= 1) {
      $info['state'] = "This email is exists";
      echo json_encode($info);

    } else {

      try {
        $pdo = $this->conn();
        $sql = "INSERT INTO $table ($colume) VALUES (:name,:last,:gender,:te,:phone,:url,:zoom,:id,:img,:active,:email,:pass,:gid)";
        $sql = $pdo->prepare($sql);
        $sql->bindParam(':name', $values[0]);
        $sql->bindParam(':last', $values[1]);
        $sql->bindParam(':gender', $values[2]);
        $sql->bindParam(':te', $values[3]);
        $sql->bindParam(':phone', $values[10]);
        $sql->bindParam(':url', $values[11]);
        $sql->bindParam(':zoom', $values[12]);
        $sql->bindParam(':id', $values[4]);
        $sql->bindParam(':img', $values[5]);
        $sql->bindParam(':active', $values[6]);
        $sql->bindParam(':email', $values[7]);
        $sql->bindParam(':pass', $values[8]);
        $sql->bindParam(':gid', $values[9]);

        if ($sql->execute()) {
          $info['adding'] = "Family added";
          $info['bool'] = "1";
          $info['lastId'] = base64_encode($pdo->lastInsertId());
          echo json_encode($info);
          
        } else {
          $info['error'] = "something is wrong";
          echo json_encode($info);
        }
        
      } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage();
      }
    } // end al IF

  } // end al function

  public function addChild($table, $colume, $values)
  {
    $info = [];
    try {
      $pdo = $this->conn();
      $sql = "INSERT INTO $table ($colume) VALUES (:parent,:fname,:lname,:status,:gender,:te)";
      $sql = $pdo->prepare($sql);
      $sql->bindParam(':parent', $values[0]);
      $sql->bindParam(':fname', $values[1]);
      $sql->bindParam(':lname', $values[2]);
      $sql->bindParam(':status', $values[3]);
      $sql->bindParam(':gender', $values[4]);
      $sql->bindParam(':te', $values[5]);
      
      if ($sql->execute()) {
        $lastId = $pdo->lastInsertId();
        $name = "$values[1] $values[2] " . "`s Group";
        $teachername = "teacher";
        $pdo->query("INSERT INTO `groups` (`gName`,`gSubname`,`idTeacher`, `idStudent`,`gType`) VALUES ('$name', '$teachername','$values[5]', '$lastId','$values[0]')");

        $info['done'] = "Child and group added";
        echo json_encode($info);
      } else {
        $info['state'] = "Something is wrong";
        echo json_encode($info);
        
      }
    } catch (PDOException $e) {
      echo "Failed: " . $e->getMessage();
    }
  }

    public function addAdminOrGroup($table , $colume , $values)
    {
       $sqlIsset = "SELECT * FROM $table WHERE `dEmail` = '$values[0]' ";
      $stmtIsset = $this->conn()->prepare($sqlIsset);
      $stmtIsset->execute();
      $num = $stmtIsset->rowCount();
      if ($num >= 1) {
        echo "<div class='alert alert-danger'>the user is exist</div>";
      } else {
        try {
          $pdo = $this->conn();
          $sql = "INSERT INTO $table ($colume) VALUES (:email,:name,:pass,:level)";
          $sql = $pdo->prepare($sql);

          $sql->bindParam(':email' , $values[0]);
          $sql->bindParam(':name' , $values[1]);
          $sql->bindParam(':pass' , $values[2]);
          $sql->bindParam(':le"vel' , $values[3]);
          
          if( $sql->execute()){
            echo "<div class='alert alert-success'>user added</div>";
            
          } else {
            echo "<div class='alert alert-danger'>something is wrong</div>";
          }
          
        } catch (PDOException $e) {
          echo "Failed: " . $e->getMessage();
        }
      } // end al IF
    }

    public function getAdminGroup($table)
    {
      $sql = "SELECT * FROM $table";
      $stmt = $this->conn()->query($sql);
      return $stmt;
    }
    
    public function editAdmin($table , $data)
    {
      $sql = "UPDATE $table SET $data";
      $stmt = $this->conn()->query($sql);
      if ($stmt) {
        echo "<div class='alert alert-success'>Edit successfully</div>";
      } else {
        echo "<div class='alert alert-danger'>something is wrong</div>";
      }
      
    }

    public function delete($table , $dataq)
    {
      $sql = "DELETE FROM $table WHERE $dataq";
      $stmt = $this->conn()->query($sql);
      if ($stmt) {
        $data['msg'] = "<span class='text-white bg-success'>Member has removed successfully</span>";
        $data['valid'] = 1;
        echo json_encode($data);
        
      } else {
        echo "<div class='alert alert-danger'>something is wrong</div>";
      }
    }
    
    public function addgroupstudent($table,$value)
    {
      $pdo = $this->conn();
      $name = "$value[0] $value[4]" . "`s Group ";
      $techerid = $value[1];
      $student = $value[2];
      $teachername = $value[3];
      $stmt = $pdo->query("INSERT INTO $table (`gName`,`gSubname`,`idTeacher`, `idStudent`) VALUES ('$name','$teachername','$techerid', '$student')");

      if ($stmt) {
        echo "<div class='alert alert-success'>Add new group</div>";
      } else {
        echo "<div class='alert alert-danger'>something is wrong</div>";
      }
    }

    //insert multi super
    public function multisuper($id,$value)
    {
      for ($i=0; $i < count($value) ; $i++) { 
        $sqli = "SELECT * FROM `gsuper` WHERE `gId`='$id' AND `idSupervisor`='$value[$i]'";
        $stmti = $this->conn()->query($sqli);

        $co = $stmti->rowCount();
        if ($co >= 1) {
          echo "<div class='alert alert-danger'>this member already exist</div>"; 
        } else {
          $sql = "INSERT INTO `gsuper` (`gId`,`idSupervisor`) VALUES ('$id','$value[$i]')";
          $stmt = $this->conn()->query($sql);
          if ($stmt) {
            $this->conn()->query("UPDATE `groups` SET `empty` = '1' WHERE `groups`.`gId` = $id");
            
            echo "<div class='alert alert-success'>Edit successfully</div>";
          } else {
            echo "<div class='alert alert-danger'>something is wrong</div>";
          }
        }
      }
    }
  }

?>