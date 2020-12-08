<?php
  include "session.php";
  include "../oper/data.php";
  include "../include/header.php";
  include "../include/aside.php";


  $date = new data();
  $table = '`users`';
  $condition = "`uType`='stu' ORDER BY `users`.`uActive` DESC";
  $condition2 = "`uType`='supr' ORDER BY `users`.`uActive` DESC";
  $condition3 = "`uType`='te' ORDER BY `users`.`uActive` DESC";
  $student = $date->fetchCon($table,$condition);
  $super = $date->fetchCon($table,$condition2);
  $teacher = $date->fetchCon($table,$condition3);

?>
  <h4>Short Details</h4>
  <div class="row mt-5 homepage">
    <div class="col-12">
      <p class="h5 border-bottom">Overview</p>
      <canvas id="myChart" style=" height:100vh"></canvas>
    </div>

    <div class="col-12 mt-5">
      <p class="h5 mb-5 border-bottom">Online users</p>
      <div class="row">
        <div class="col-4">
          <div class="online">
            <div class="row">
              <p class="col-12 mb-3 border-bottom">Online students</p>
              <?php
                if ($student->rowCount() < 1) {
                  echo "<span class='bg-danger text-white'>No student online</span>";
                } else {
                  while ($a = $student->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <div class=" col-12 ">
                      <div class="row border-bottom">
                        <div class="col-9 my-2">
                          <span><?php echo $a['uFname'] ." ".$a['uLname']?></span>
                        </div>
                        <div class="col-3 my-2 text-right">
                          <span><i class="<?php echo ($a['uActive']=="1" ?"fas":"far")?> fa-circle"></i></span>
                        </div>
                      </div>
                    </div>
                    <?php
                  }
                }
              ?>
            </div>
          </div>
        </div>
        <div class="col-4">
          <div class="online">
            <div class="row">
              <p class="col-12 mb-3 border-bottom">Online supervisor</p>
              <?php
                if ($super->rowCount() < 1) {
                  echo "<span class='bg-danger text-white'>No student online</span>";
                } else {
                  while ($a = $super->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <div class=" col-12 ">
                      <div class="row border-bottom">
                        <div class="col-9 my-2">
                          <span><?php echo $a['uFname'] ." ".$a['uLname']?></span>
                        </div>
                        <div class="col-3 my-2 text-right">
                          <span><i class="<?php echo ($a['uActive']=="1" ?"fas":"far")?> fa-circle"></i></span>
                        </div>
                      </div>
                    </div>
                    <?php
                  }
                }
              ?>
            </div>
          </div>
        </div>
        <div class="col-4">
          <div class="online">
            <div class="row">
              <p class="col-12 mb-3 border-bottom">Online teachers</p>
              <?php
                if ($teacher->rowCount() < 1) {
                  echo "<span class='bg-danger text-white'>No student online</span>";
                } else {
                  while ($a = $teacher->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <div class=" col-12 ">
                      <div class="row border-bottom">
                        <div class="col-9 my-2">
                          <span><?php echo $a['uFname'] ." ".$a['uLname']?></span>
                        </div>
                        <div class="col-3 my-2 text-right">
                          <span><i class="<?php echo ($a['uActive']=="1" ?"fas":"far")?> fa-circle"></i></span>
                        </div>
                      </div>
                    </div>
                    <?php
                  }
                }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  
  </div>
<?php
  include "../include/endside.php";
  include "../include/footer.php";
?>