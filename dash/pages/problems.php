<?php
include "../oper/data.php";
include "session.php";
include "../include/header.php";
include "../include/aside.php";
$student = new data();
?>
<div class="row mb-5">
  <div class="col-6">
    <h3 class="text-uppercase font-weight-bold">Problems</h3>
  </div>

</div>
<table id="example1" class="table table-bordered text-center table-striped ">
  <thead>
    <tr>
      <th>#</th>
      <th>Sender</th>
      <th>Problem msg</th>
      <th>Date</th>
      <th>Type</th>
      <?php
            if ($_SESSION['idAdmin'] != 3) {
            ?>
      <th>Controls</th>
            <?php }?>
    </tr>
  </thead>
  <tbody>
    <?php
    $table = '`problem`';

    $stCount = $student->getAdminGroup($table);
    if ($stCount->rowCount() >= 1) {
      $ID = 1;
      while ($stu = $stCount->fetch(PDO::FETCH_ASSOC)) {

        $idg = $stu['u_id'];
        $user = $student->fetchCon('`users`', "`uId`='$idg'");
        $oneUser = $user->fetch(PDO::FETCH_ASSOC);
        if($oneUser['uType'] == "Te"){
          $page = "teacher";
        } else if($oneUser['uType'] == "stu") {
          $page = "student";
        } else {
          $page = "supervisor";
        }
    ?>
        <tr id="<?php echo $stu['p_id'] ?>">
          <td><?php echo $ID++ ?></td>
          <td><a style="color:blue;text-decoration:underline" target="_blank" href="<?php echo base_url . "dash/pages/preview?$page=" . base64_encode($idg) . "" ?>"><?php echo $oneUser['uFname'] . " " . $oneUser['uLname'] ?></a></td>

          <td> <?php echo $stu['p_text'] ?> </td>
          <td> <?php echo date("Y-m-d h:i a",strtotime($stu['p_date'])) ?> </td>
          <td> <?php
            if ($stu['p_type']=="user" and $oneUser['uType']== "stu"){
              echo "with Teacher";
            } else if ($stu['p_type'] == "user" and $oneUser['uType'] == "Te"){
              echo "with Student";
            } else {
              echo $stu['p_type'];
            }
          ?> </td>
          <td>
            <!-- <a href="<?php echo base_url . "dash/pages/preview?problem=" . base64_encode($idg) . "" ?>" class=" px-2 h6 text-success" data-toggle="tooltip" data-placement="bottom" title="See details"><i class="far fa-eye"></i></a> -->
            
            <?php
            if ($_SESSION['idAdmin'] != 3) {
            ?>
              <button data-del="<?php echo $stu['p_id'] ?>" class="Deleteproblem py-2 px-2 h6 text-danger" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="far fa-trash-alt"></i></button>
            <?php } ?>
          </td>
        </tr>
    <?php }
    } ?>
  </tbody>
</table>
<?php
include "../include/endside.php";
include "../include/footer.php";
?>