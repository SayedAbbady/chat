<?php
include "session.php";
include "../oper/data.php";
include "../include/header.php";
$user = new data();
$id = $_SESSION['userChatId'];
$col = '`uFname`,`uLname`';
$table = "`users`";
$cond = "`users`.`uId`='$id'";
$users = $user->fetchclumn($col, $table, $cond);
$dtat = $users->fetch(PDO::FETCH_ASSOC);
$name = $dtat['uFname'] . " " . $dtat['uLname'];
?>
<div class="user">
  <div class="container">
    <div class="chat">
      <div class="row">
        <div class="col-md-4 right-side d-flex justify-content-center align-items-center border-right text-center border-light">
          <div>
            <img src="<?php echo base_url ?>assets/img/icons/download.jpg" class="mx-auto dblock" width="100px" alt="">
            <p class="mt-3">Eaalim Institute thanks you for your support and confidence in our ability to solve your problem, we wish you all the best</p>
          </div>
        </div>
        <!--=================================Right side=================================-->
        <!--Chat messages-->
        <div class="col-md-8 chat-message-repo d-flex justify-content-center align-items-center">
          <div class="">
            <div class="repo">
              <h4>Report a problem</h4>
              <form action="" class="form-group" method="POST">
                <div id="result"></div>
                  <div class="my-3">
                  <label for="fname">Full name</label>
                  <input type="text" class="form-control" value="<?php echo $name ?>" readonly>
                </div>

                <div class="my-3">
                  <label for="levels">Problem type</label>
                  <select class="form-control" id="levels">
                    <option value="0">--SELECT the type--</option>
                    <option value="1">with <?php echo ($_SESSION['userChatType'] == "Te" ? "Student" : "Teacher") ?></option>
                    <option value="2">Support</option>
                    <option value="3">Technical</option>
                  </select>
                </div>

                <div class="my-4">
                  <label for="">Description</label>
                  <textarea name="data" id="text" rows="5" class="form-control" placeholder="Tell your problem"></textarea>
                </div>


                <div class=" my-4">
                  <input type="submit" value="Send" id="sendProblem" class=" btn btn-primary">
                </div>
              </form>
            </div>
          </div>
        </div>
        <!--Chat meassage-->
      </div>
    </div>
  </div>
</div>
<?php
include "../include/footer.php";
?>