<?php
// include_once "../../config.php";
include "../oper/data.php";
include "session.php";
include "../include/header.php";
include "../include/aside.php";

$user = new data();
$teacher = $user->fetchCon("`users`", "`uType` = 'te'");
$student = $user->fetchCon("`users`", "`uType` = 'stu'");
$supervisor = $user->fetchCon("`users`", "`uType` = 'supr'");

if (isset($_GET['student'])) {

?>
  <div class="add-student">
    <h4>Add student</h4>
    <ul class="nav mt-4 nav-tabs" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Single student</a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <form action="" class="form-group row">
          <div class="col-12 text-center my-4" id="result"></div>
          <div class="col-12 mb-4">
            <p class="text-danger ">*Remember, all fields are required</p>

            <label for="type">Type</label>
            <input type="text" class="form-control" id="type" value="student" readonly>
          </div>
          <div class="col-6">
            <label for="fname">Firstname</label>
            <input type="text" class="form-control" id="fname" placeholder="Firstname">
          </div>
          <div class="col-6">
            <label for="lname">Lastname</label>
            <input type="text" class="form-control" id="lname" placeholder="Lastname">
          </div>
          <div class="col-12 my-4">
            <label for="gender">Gender</label>
            <select class="form-control" id="gender">
              <option value="">-- select gender --</option>
              <option value="male">Male</option>
              <option value="female">Female</option>
            </select>
          </div>
          <div class="col-12 ">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="email" placeholder="Email">
          </div>
          <div class="col-12 my-4">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="phone" placeholder="Phone">
          </div>
          <div class="col-6 ">
            <label for="pass">Password</label>
            <input type="password" class="form-control" id="pass" placeholder="Password">
          </div>
          <div class="col-6 ">
            <label for="passc">Confirm Password</label>
            <input type="password" class="form-control" id="passc" placeholder="Confirm password">
          </div>
          <div class="col-12 my-4">
            <label for="url">Page URL</label>
            <input type="text" class="form-control" id="url" placeholder="Page URL">
          </div>
          <div class="col-12 ">
            <label for="zoomlink">Zoom link</label>
            <input type="text" class="form-control" id="zoomlink" placeholder="Zoom link">
          </div>
          <div class="col-12 my-4">
            <label for="selectTeacher">Select his/her teacher</label>
            <select id="selectTeacher" class="form-control">
              <?php
              if ($teacher->rowCount() >= 1) {
              ?>
                <option value="">-- SELECT Teacher --</option>
                <?php while ($member = $teacher->fetch(PDO::FETCH_ASSOC)) {
                ?>

                  <option value="" class="form-control" data-tename="<?php echo base64_encode($member['uFname'] . " " . $member['uLname']) ?>" data-te="<?php echo base64_encode($member['uId']) ?>"><?php echo $member['uFname'] . " " . $member['uLname'] ?></option>
                <?php
                }
              } else {
                ?>
                <option>no data found</option>
              <?php
              }
              ?>
            </select>
          </div>
          <div class="col-12">
            <input type="submit" value="Add student" id="sendstudent" class=" btn btn-primary">
          </div>
        </form>
      </div>
    </div>
  </div>
<?php
} elseif (isset($_GET['teacher'])) {
?>

  <div class="add-student">
    <h4>Add Teacher</h4>
    <form action="" class="form-group row">
      <div class="col-12 text-center my-4" id="result"></div>
      <div class="col-12 mb-4">
        <p class="text-danger ">*Remember, all fields are required</p>
        <label for="type">Type</label>
        <input type="text" class="form-control" id="type" value="Teacher" readonly>
      </div>
      <div class="col-6">
        <label for="fname">Firstname</label>
        <input type="text" class="form-control" id="fname" placeholder="Firstname">
      </div>
      <div class="col-6">
        <label for="lname">Lastname</label>
        <input type="text" class="form-control" id="lname" placeholder="Lastname">
      </div>
      <div class="col-12 my-4">
        <label for="gender">Gender</label>
        <select class="form-control" id="gender">
          <option value="">-- select gender --</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
        </select>
      </div>
      <div class="col-12 ">
        <label for="email">Email</label>
        <input type="text" class="form-control" id="email" placeholder="Email">
      </div>
      <div class="col-12 my-4">
        <label for="phone">Phone</label>
        <input type="text" class="form-control" id="phone" placeholder="Phone">
      </div>
      <div class="col-6 ">
        <label for="pass">Password</label>
        <input type="password" class="form-control" id="pass" placeholder="Password">
      </div>
      <div class="col-6">
        <label for="passc">Confirm Password</label>
        <input type="password" class="form-control" id="passc" placeholder="Confirm password">
      </div>

      <div class="col-12 my-4">
        <label for="url">Page URL</label>
        <input type="text" class="form-control" id="url" placeholder="Page URL">
      </div>
      <div class="col-12">
        <label for="zoomlink">Zoom link</label>
        <input type="text" class="form-control" id="zoomlink" placeholder="Zoom link">
      </div>
      <div class="col-12 my-4">
        <input type="submit" value="Add Teacher" id="send" class=" btn btn-primary">
      </div>
    </form>
  </div>
<?php
} elseif (isset($_GET['supervisor'])) {
?>
  <div class="add-student">
    <h4>Add Supervisor</h4>
    <form action="" class="form-group row">
      <div class="col-12 text-center my-4" id="result"></div>
      <div class="col-12 mb-4">
        <label for="type">Type</label>
        <input type="text" class="form-control" id="type" value="Supervisor" readonly>
      </div>
      <div class="col-6">
        <label for="fname">Firstname</label>
        <input type="text" class="form-control" id="fname" placeholder="Firstname">
      </div>
      <div class="col-6">
        <label for="lname">Lastname</label>
        <input type="text" class="form-control" id="lname" value="Eaalim" placeholder="Lastname" readonly>
      </div>
      <div class="col-12 my-4">
        <label for="gender">Gender</label>
        <select class="form-control" id="gender">
          <option value="">-- select gender --</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
        </select>
      </div>
      <div class="col-12 ">
        <label for="email">Email</label>
        <input type="text" class="form-control" id="email" placeholder="Email">
      </div>
      <div class="col-6 my-4">
        <label for="pass">Password</label>
        <input type="password" class="form-control" id="pass" placeholder="Password">
      </div>
      <div class="col-6 my-4">
        <label for="passc">Confirm Password</label>
        <input type="password" class="form-control" id="passc" placeholder="Confirm password">
      </div>

      <div class="col-12">
        <input type="submit" value="Add Supervisor" id="sendsuper" class=" btn btn-primary">
      </div>
    </form>
  </div>
<?php
} elseif (isset($_GET['admin'])) {
?>
  <div class="add-student">
    <h4>Add Admin</h4>
    <form action="" class="form-group row">
      <div class="col-12 text-center my-4" id="result"></div>

      <div class="col-12 my-4">
        <label for="fname">Full name</label>
        <input type="text" class="form-control" id="fname" placeholder="Full name">
      </div>

      <div class="col-12 ">
        <label for="email">Email</label>
        <input type="text" class="form-control" id="email" placeholder="Email">
      </div>
      <div class="col-12 my-4">
        <label for="levels">Admin Level</label>
        <select class="form-control" id="levels">
          <option value="0">--SELECT level--</option>
          <option value="1">Admin</option>
          <option value="2">Manager</option>
          <option value="3">Support</option>
        </select>
      </div>
      <div class="col-md-6">
        <label for="pass">Password</label>
        <input type="password" class="form-control" id="pass" placeholder="Password">
      </div>
      <div class="col-md-6">
        <label for="passc">Confirm Password</label>
        <input type="password" class="form-control" id="passc" placeholder="Confirm password">
      </div>

      <div class="col-12 my-4">
        <input type="submit" value="Add Admin" id="sendadmin" class=" btn btn-primary">
      </div>
    </form>
  </div>
<?php
} elseif (isset($_GET['family'])) {
?>
  <div class="add-student">
    <h4>Add family</h4>
    <form action="" class="form-group row" method="post" id="AddFamilyForm">
      <div class="col-12 text-center my-4" id="result"></div>
      <div class="col-12">
        <p class="text-danger float-left">*Remember, all fields are required</p>
        <p id="addChild" class="float-right" style="color: blue !important;text-decoration:underline;">

        </p>
      </div>
      <div class="col-12 mb-4">

        <label for="type">Type</label>
        <input type="text" class="form-control" id="type" value="Family" readonly>
      </div>
      <div class="col-6">
        <label for="fname">Firstname</label>
        <input type="text" class="form-control" name="fname" placeholder="Firstname">
      </div>
      <div class="col-6">
        <label for="lname">Lastname</label>
        <input type="text" class="form-control" name="lname" placeholder="Lastname">
      </div>
      <div class="col-12 my-4">
        <label for="gender">Gender</label>
        <select class="form-control" name="gender">
          <option value="">-- select gender --</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
        </select>
      </div>
      <div class="col-12 ">
        <label for="email">Email</label>
        <input type="text" class="form-control" name="email" placeholder="Email">
      </div>
      <div class="col-12 my-4">
        <label for="phone">Phone</label>
        <input type="text" class="form-control" name="phone" placeholder="Phone">
      </div>
      <div class="col-6 ">
        <label for="pass">Password</label>
        <input type="password" class="form-control" name="pass" placeholder="Password">
      </div>
      <div class="col-6 ">
        <label for="passc">Confirm Password</label>
        <input type="password" class="form-control" name="passc" placeholder="Confirm password">
      </div>
      <div class="col-12 my-4">
        <label for="url">Page URL</label>
        <input type="text" class="form-control" name="url" placeholder="Page URL">
      </div>
      <div class="col-12 ">
        <label for="zoomlink">Zoom link</label>
        <input type="text" class="form-control" name="zoomlink" placeholder="Zoom link">
      </div>

      <div class="col-12 my-4">
        <input type="submit" value="Add student" name="addFamily" class=" btn btn-primary">
      </div>
    </form>
  </div>
<?php
} elseif (isset($_GET['child'])) {
  $idparent = base64_decode($_GET['child']);

?>
  <div class="add-student">
    <h4>Add child</h4>
    <form action="" class="form-group row" method="post" id="AddChildForm">
      <div class="col-12 text-center my-4" id="result"></div>
      <div class="col-12">
        <p class="text-danger float-left">*Remember, all fields are required</p>
      </div>

      <input type="hidden" class="form-control" name="parentId" value="<?php echo $_GET['child']; ?>">

      <div class="col-6">
        <label for="fname">Firstname</label>
        <input type="text" class="form-control" name="fname" placeholder="Firstname">
      </div>
      <div class="col-6">
        <label for="lname">Lastname</label>
        <input type="text" class="form-control" name="lname" placeholder="Lastname">
      </div>
      <div class="col-12 my-4">
        <label for="gender">Gender</label>
        <select class="form-control" name="gender">
          <option value="">-- select gender --</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
        </select>
      </div>

      <div class="col-12 my-4">
        <label for="selectTeacher">Select his/her teacher</label>
        <select id="selectTeacher" class="form-control" name="teacher">
          <?php
          if ($teacher->rowCount() >= 1) {
          ?>
            <option value="">-- SELECT Teacher --</option>
            <?php while ($member = $teacher->fetch(PDO::FETCH_ASSOC)) {
            ?>

              <option value="<?php echo base64_encode($member['uId'])?>" class="form-control" data-tename="<?php echo base64_encode($member['uFname'] . " " . $member['uLname']) ?>"><?php echo $member['uFname'] . " " . $member['uLname'] ?></option>
            <?php
            }
          } else {
            ?>
            <option>no data found</option>
          <?php
          }
          ?>
        </select>
      </div>

      <div class="col-12 my-4">
        <input type="submit" value="Add child" name="addFamily" class="btn btn-primary">
      </div>
    </form>
  </div>
<?php
} else {
  echo "<div class='alert alert-danger text-center'>you not have permission to access this page</div>";
}

?>

<?php
include "../include/endside.php";
include "../include/footer.php";
?>