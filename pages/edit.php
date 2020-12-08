<?php
include "session.php";
include "../oper/data.php";
include "../include/header.php";
$user = new data();
$id = $_SESSION['userChatId'];

$table = "`users`";
$cond = "`users`.`uId`='$id'";
$users = $user->fetchCon($table, $cond);
$dtat = $users->fetch(PDO::FETCH_ASSOC);
$name = $dtat['uFname'] . " " . $dtat['uLname'];
?>
<div class="user">
  <div class="container">
    <div class="chat">
      <div class="row">
        <div class="col-md-4 right-side d-flex justify-content-center align-items-center border-right text-center border-light">
          <div class="image-portfolio">
            <img src="<?php echo base_url ?>assets/img/<?php echo str_replace("../assets/img/", "", $dtat['uImage']) ?>" class="mx-auto d-block rounded-circle" style="width:200px;height:200px;object-fit:cover;" alt="">

            <p class="mt-3"><b>status :</b> <span class="online"><i class="fas fa-circle text-success"></i></span> Available now</p>
          </div>
        </div>
        <!--=================================Right side=================================-->
        <!--Chat messages-->
        <div class="col-md-8 chat-message-repo d-flex justify-content-center align-items-center">
          <div class="">
            <div class="repo">
              <form action="" method="post" id="formEdit" class="form-group row">
                <h4 class="col-12 my-4">Edit profile</h4>
                <div class="col-6">
                  <label for="fname">Firstname</label>
                  <input type="text" class="form-control" name="fname" value="<?php echo $dtat['uFname'] ?>">
                </div>
                <div class="col-6">
                  <label for="lname">Lastname</label>
                  <input type="text" class="form-control" name="lname" value="<?php echo $dtat['uLname'] ?>">
                </div>

                <div class="col-12 my-4">
                  <label for="emaili">Email</label>
                  <input type="text" id="emaili" class="form-control" name="email" value="<?php echo $dtat['uEmail'] ?>">
                </div>

                <div class="col-12">
                  <label for="image">Image</label>
                  <input type="file" id="editFileImage" class="form-control" name="image">
                </div>

                <div class="col-6 my-4 passfaild">
                  <label for="pass">Password</label>
                  <input type="password" class="form-control" name="pass" value="<?php echo base64_decode($dtat['uPassword']) ?>">
                  <i class="far fa-eye"></i>
                </div>

                <div class="col-6 my-4 passfaild">
                  <label for="passc">Confirm Password</label>
                  <input type="password" class="form-control" name="passc" value="<?php echo base64_decode($dtat['uPassword']) ?>">
                  <i class="far fa-eye"></i>
                </div>

                <div class="col-12">
                  <input type="submit" value="Edit" id="sendstudent" class=" btn btn-primary">
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