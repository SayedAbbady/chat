<?php
include "../oper/data.php";
include "session.php";
include "../include/header.php";
include "../include/aside.php";

$admin = new data();


if (isset($_GET['supervisor']) && $_GET['supervisor'] != "") {
  $id = base64_decode($_GET['supervisor']);
  $table = '`users`';
  $condition = "`uId` = '$id'";
  $condetionSuper = "`groups`.`gId` = `gsuper`.`gId` AND `gsuper`.`idSupervisor`='$id'";
  $nogroups = $admin->fetchCon('`groups`,`gsuper`', "$condetionSuper");
  $adm = $admin->fetchCon($table, $condition);
  if ($adm->rowCount() >= 1) {
    $qadmin = $adm->fetch(PDO::FETCH_ASSOC);

?>
    <div class="add-student">
      <h4>Preview Supervisor <span class="text-primary"><?php echo $qadmin['uFname'] ?></span></h4>
      <div class="privsuper">
        <div class="row">
          <div class="col-12 text-center">
            <div class="privImg">
              <img src="<?php echo base_url . 'dash/assets/img/' . $qadmin['uImage'] ?>">
            </div>
          </div>
          <div class="col-6"><b>First name: </b> <?php echo $qadmin['uFname'] ?></div>
          <div class="col-6"><b>Last name: </b> <?php echo $qadmin['uLname'] ?></div>
          <div class="col-12"><b>Gender: </b> <?php echo $qadmin['uGender'] ?></div>
          <div class="col-12"><b>Status: </b>
            <?php echo ($qadmin['uStatus'] == '1' ? '<span class="bg-success text-white">Active</span>' : '<span class="bg-danger text-white">Unactive</span>') ?>
          </div>
          <div class="col-12"><b>Email: </b> <?php echo $qadmin['uEmail'] ?></div>
          <div class="col-12"><b>No.Groups:</b> <?php echo $nogroups->rowCount() ?></div>
          <div class="col-12"><b>See chat:</b><a href="<?php echo base_url ?>" target="_blank">open chat <i class="far fa-share-square"></i></a></div>
          <div class="col-12 text-right"><a href="<?php echo base_url . "dash/pages/edit?supervisor=" . base64_encode($qadmin['uId']) . "" ?>">Edit <?php echo $qadmin['uFname'] ?></a>

            <div class="col-12 mt-5">
              <table class="table">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Teacher</th>
                    <th scope="col"> student</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $count = 1;
                  while ($group = $nogroups->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                    <tr>
                      <td><?php echo $count++ ?></td>
                      <td><?php echo $group['gSubname'] ?></td>
                      <td><?php echo str_replace("`s Group", "", $group['gName']) ?></td>
                      <td><?php echo ($group['status'] == '1' ? '<span class="bg-success text-white">Active</span>' : '<span class="bg-danger text-white">Unactive</span>') ?></td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>


          </div>
        </div>
      </div>
    </div>
  <?php
  } else {
    echo "<div class='alert alert-danger text-center'>Not valid data</div>";
  }
} elseif (isset($_GET['teacher']) && $_GET['teacher'] != "") {
  $id = base64_decode($_GET['teacher']);
  $table = '`users`';
  $condition = "`uId` = '$id'";
  $adm = $admin->fetchCon($table, $condition);
  $nogroups = $admin->fetchCon('`groups`', "idTeacher = '$id'");
  $nostudent = $admin->fetchCon('`groups`', "idTeacher = '$id' AND `status`= '1'");
  if ($adm->rowCount() >= 1) {
    $eadmin = $adm->fetch(PDO::FETCH_ASSOC);

  ?>
    <div class="add-student">
      <h4>Preview Teacher <span class="text-primary"><?php echo $eadmin['uFname'] ?></span></h4>
      <div class="privsuper">
        <div class="row">
          <div class="col-12 text-center">
            <div class="privImg">
              <img src="<?php echo base_url . 'dash/assets/img/' . $eadmin['uImage'] ?>">
            </div>
          </div>
          <div class="col-6"><b>First name : </b> <?php echo $eadmin['uFname'] ?></div>
          <div class="col-6"><b>Last name : </b> <?php echo $eadmin['uLname'] ?></div>
          <div class="col-12"><b>Gender : </b> <?php echo $eadmin['uGender'] ?></div>
          <div class="col-12"><b>Status : </b>
            <?php echo ($eadmin['uStatus'] == '1' ? '<span class="bg-success text-white">Active</span>' : '<span class="bg-danger text-white">Unactive</span>') ?>
          </div>
          <div class="col-12"><b>Email : </b> <?php echo $eadmin['uEmail'] ?></div>
          <div class="col-12"><b>No.Groups :</b> <?php echo $nogroups->rowCount(); ?></div>
          <div class="col-12"><b>Active Students :</b> <?php echo $nostudent->rowCount(); ?></div>
          <div class="col-12 text-right"><a href="<?php echo base_url . "dash/pages/edit?teacher=" . base64_encode($eadmin['uId']) . "" ?>">Edit
              <?php echo $eadmin['uFname'] ?></a></div>

          <div class="col-12 mt-5">
            <table class="table">
              <thead class="thead-light">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Teacher</th>
                  <th scope="col"> student</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $count = 1;
                while ($group = $nogroups->fetch(PDO::FETCH_ASSOC)) {
                ?>
                  <tr>
                    <td><?php echo $count++ ?></td>
                    <td><?php echo $group['gSubname'] ?></td>
                    <td><?php echo str_replace("`s Group", "", $group['gName']) ?></td>
                    <td><?php echo ($group['status'] == '1' ? '<span class="bg-success text-white">Active</span>' : '<span class="bg-danger text-white">Unactive</span>') ?></td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  <?php
  } else {
    echo "<div class='alert alert-danger text-center'>Not valid data</div>";
  }
} elseif (isset($_GET['student']) && $_GET['student'] != "") {
  $id = base64_decode($_GET['student']);
  $table = '`users`';
  $condition = "`uId` = '$id'";
  $condition2 = "`idStudent` = '$id' AND `status`= '1'";
  $adm = $admin->fetchCon($table, $condition);
  $teacher = $admin->fetchCon('`groups`', $condition2);
  $groups = $admin->fetchCon('`groups`', "`idStudent` = '$id'");
  $teachere = $teacher->fetch(PDO::FETCH_ASSOC);
  if ($adm->rowCount() >= 1) {
    $admins = $adm->fetch(PDO::FETCH_ASSOC);

  ?>
    <div class="add-student">
      <h4>Preview Student <span class="text-primary"><?php echo $admins['uFname'] ?></span></h4>
      <div class="privsuper">
        <div class="row">
          <div class="col-12 text-center">
            <div class="privImg">
              <img src="<?php echo base_url . 'dash/assets/img/upload/' . str_replace("assets/img/upload/", "", $admins['uImage']) ?>">
            </div>
          </div>
          <div class="col-6"><b>First name : </b> <?php echo $admins['uFname'] ?></div>
          <div class="col-6"><b>Last name : </b> <?php echo $admins['uLname'] ?></div>
          <div class="col-12"><b>Gender : </b> <?php echo $admins['uGender'] ?></div>
          <div class="col-12"><b>Status : </b>
            <?php echo ($admins['uStatus'] == '1' ? '<span class="bg-success text-white">Active</span>' : '<span class="bg-danger text-white">Unactive</span>') ?>
          </div>
          <div class="col-6"><b>Email : </b> <?php echo $admins['uEmail'] ?></div>
          <div class="col-6"><b>Phone : </b> <?php echo $admins['uPhone'] ?></div>
          <div class="col-12"><b>Website URL : </b> <?php echo $admins['uUrl'] ?></div>
          <div class="col-12"><b>Zoom URL : </b> <?php echo $admins['uZoom'] ?></div>
          <div class="col-12"><b>Current Teacher :</b> <?php echo $teachere['gSubname'] ?></div>
          <div class="col-12"><b>No.Groups :</b> <?php echo $groups->rowCount() ?></div>

          <div class="col-12 text-right "><a href="<?php echo base_url . "dash/pages/edit?student=" . base64_encode($admins['uId']) . "" ?>">
              Edit <?php echo $admins['uFname'] ?></a></div>

          <div class="col-12 mt-5">
            <table class="table">
              <thead class="thead-light">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col"> student</th>
                  <th scope="col">Teacher</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $count = 1;
                while ($group = $groups->fetch(PDO::FETCH_ASSOC)) {
                ?>
                  <tr>
                    <td><?php echo $count++ ?></td>
                    <td><?php echo str_replace("`s Group", "", $group['gName']) ?></td>
                    <td><?php echo $group['gSubname'] ?></td>
                    <td><?php echo ($group['status'] == '1' ? '<span class="bg-success text-white">Active</span>' : '<span class="bg-danger text-white">Unactive</span>') ?></td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  <?php
  } else {
    echo "<div class='alert alert-danger text-center'>Not valid data</div>";
  }
} elseif (isset($_GET['family']) && $_GET['family'] != "") {
  $id = base64_decode($_GET['family']);
  // get data for family
  $table = '`users`';
  $condition = "`uId` = '$id'";
  $adm = $admin->fetchCon($table, $condition);
  // End data for family

  // Get data for child of this family
  $tablef = '`family`';
  $conditionf = "`u_id` = '$id'";
  $child = $admin->fetchCon($tablef, $conditionf);
  // Get data for child of this family
  if ($adm->rowCount() >= 1) {
    $admini = $adm->fetch(PDO::FETCH_ASSOC);

  ?>
    <div class="add-student">
      <h4>Preview Student <span class="text-primary"><?php echo $admini['uFname'] ?></span></h4>
      <div class="privsuper">
        <div class="row">
          <div class="col-12 text-center">
            <div class="privImg">
              <img src="<?php echo base_url . 'assets/img/upload/' . str_replace("assets/img/upload/", "", $admini['uImage']) ?>">

            </div>
          </div>
          <div class="col-6"><b>First name : </b> <?php echo $admini['uFname'] ?></div>
          <div class="col-6"><b>Last name : </b> <?php echo $admini['uLname'] ?></div>
          <div class="col-12"><b>Gender : </b> <?php echo $admini['uGender'] ?></div>
          <div class="col-12"><b>Status : </b>
            <?php echo ($admini['uStatus'] == '1' ? '<span class="bg-success text-white">Active</span>' : '<span class="bg-danger text-white">Unactive</span>') ?>
          </div>
          <div class="col-12"><b>Email : </b> <?php echo $admini['uEmail'] ?></div>
          <div class="col-12"><b>Phone : </b> <?php echo $admini['uPhone'] ?></div>
          <div class="col-12"><b>Website URL : </b> <?php echo $admini['uUrl'] ?></div>
          <div class="col-12"><b>Zoom URL : </b> <?php echo $admini['uZoom'] ?></div>

          <div class="col-9 text-right ">
            <a href="<?php echo base_url . "dash/pages/edit?student=" . base64_encode($admini['uId']) . "" ?>">Edit <?php echo $admini['uFname'] ?></a></div>
          <div class="col-3 text-right ">
            <a href="<?php echo base_url . "dash/pages/add?child=" . base64_encode($admini['uId']) . "" ?>">Add Children</a></div>

          <div class="col-12 mt-5">
            <table class="table table-bordered text-center table-striped ">
              <thead class="thead-light">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Student name</th>
                  <th scope="col">Status</th>
                  <th scope="col">Gender</th>
                  <th scope="col">Teacher</th>
                  
                  <th scope="col">Controlls</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($child->rowCount() < 1) {
                ?>
                  <tr>
                    <td colspan="6">
                      <div class="alert alert-danger">no child added</div>
                    </td>
                  </tr>
                  <?php
                } else {
                  $iD = 1;
                  while ($oneChild = $child->fetch(PDO::FETCH_ASSOC)) {
                    $teacherIdF = $oneChild['f_teacher'];
                    
                    $teacher = $admin->fetchCon('`users`'," `users`.`uId` = '$teacherIdF'")->fetch(PDO::FETCH_ASSOC);
                  ?>
                    <tr id='<?php echo $oneChild['f_id']?>'>
                      <td><?php echo $iD++ ?></td>
                      <td><?php echo $oneChild['f_fname'] . " " . $oneChild['f_lname'] ?></td>
                      <td><?php echo $oneChild['f_status'] ?></td>
                      <td><?php echo $oneChild['f_gender'] ?></td>

                      <td><?php echo $teacher['uFname'].' '.$teacher['uLname'] ?></td>
                      
                      <td>
                        <button data-del="<?php echo $oneChild['f_id']?>" class=" py-2 px-2 h6 text-danger DeleteChild" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="far fa-trash-alt"></i></button>

                      </td>
                    </tr>
                <?php
                  }
                }
                ?>
              </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>
  <?php
  } else {
    echo "<div class='alert alert-danger text-center'>Not valid data</div>";
  }
} elseif (isset($_GET['group']) && $_GET['group'] != "") {
  $id = base64_decode($_GET['group']);
  $table = '`groups`';
  $condition = "`gId` = '$id'";
  $condetionSuper = "`gsuper`.`idSupervisor` = `users`.`uId` AND `gsuper`.`gId` = '$id'";
  $nogroups = $admin->fetchCon('`gsuper`,`users`', "$condetionSuper");

  $adm = $admin->fetchCon($table, $condition);
  if ($adm->rowCount() >= 1) {
    $admin = $adm->fetch(PDO::FETCH_ASSOC);

  ?>
    <div class="add-student">
      <h4 class="mb-5">Preview Group</h4>
      <div class="privsuper">
        <div class="row">

          <div class="col-12"><b>Student name : </b> <?php echo str_replace("`s Group", "", $admin['gName']) ?></div>
          <div class="col-12"><b>Teacher name : </b> <?php echo $admin['gSubname'] ?></div>

          <div class="col-12"><b>Supervisor :</b> <?php echo $nogroups->rowCount() ?></div>

          <div class="col-12"><b>Status : </b>
            <?php echo ($admin['status'] == '1' ? '<span class="bg-success text-white">Active</span>' : '<span class="bg-danger text-white">Unactive</span>') ?>
          </div>

          <div class="col-12 text-right">
            <a href="<?php echo base_url . "dash/pages/edit?group=" . base64_encode($admin['gId']) . "" ?>">Edit Group</a>
          </div>


          <div class="col-12 mt-5">
            <table class="table">
              <thead class="thead-light">
                <tr>
                  <th>#</th>
                  <th>Name of supervisors</th>
                  <th>control</th>

                </tr>
              </thead>
              <tbody>
                <?php
                $count = 1;
                if ($nogroups->rowCount() < 1) {
                ?>
                  <tr>
                    <td colspan="3">No supervisor added</td>
                  </tr>
                  <?php
                } else {

                  while ($group = $nogroups->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                    <tr id="<?php echo $group['uId'] ?>">
                      <td><?php echo $count++ ?></td>
                      <td><?php echo $group['uFname'] ?></td>
                      <td>
                        <?php
                        if ($_SESSION['idAdmin'] != 3) {
                        ?>
                          <button data-del="<?php echo $group['uId'] ?>" data-group="<?php echo $id ?>" class="Deletesupgrou  h6 text-danger" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="far fa-trash-alt"></i></button>

                        <?php } else {
                          echo "<span class='bg-danger text-white'>You not have permission to delete</span>";
                        } ?>
                      </td>

                    </tr>
                <?php
                  }
                }

                ?>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
<?php
  } else {
    echo "<div class='alert alert-danger text-center'>Not valid data</div>";
  }
} else {
  echo "<div class='alert alert-danger text-center'>you not have permission to access this page</div>";
}
?>

<?php
include "../include/endside.php";
include "../include/footer.php";
?>