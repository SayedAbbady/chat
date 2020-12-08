<?php
include "../oper/data.php";
  include "session.php";
  include "../include/header.php";
  include "../include/aside.php";
  $student = new data();
?>
<div class="row mb-5">
  <div class="col-6">
    <h3 class="text-uppercase font-weight-bold">supervisors</h3>
  </div>
  <div class="col-6 text-right">
    <a href="<?php echo base_url."dash/pages/add?supervisor"?>" class="btn btn-primary addBtn">Add Supervisor</a>
  </div>
</div>
<table id="example1" class="table table-bordered text-center table-striped ">
  <thead>
    <tr>
      <th>#</th>
      <th>Profile</th>
      <th>Name</th>
      <th>Email</th>
      <th>Status</th>
      <th>Password</th>
      <th>Controls</th>
    </tr>
  </thead>
  <tbody>
  <?php
    $table = '`users`';
    $condition = "`uType` = 'supr'";
    $stCount = $student->fetchCon($table,$condition);
    if ($stCount->rowCount() >= 1) {
      $ID=1;
      while ($stu = $stCount->fetch(PDO::FETCH_ASSOC)) {
      
      $idg = $stu['uId'];
    
  ?>
    <tr id="<?php echo $stu['uId']?>">
      <td><?php echo $ID++?></td>
      <td class="imgProfile"><img src="<?php echo base_url.'assets/img/'.$stu['uImage']?>"></td>
      <td><?php echo $stu['uFname'] . " " . $stu['uLname']?></td>
      <td><?php echo $stu['uEmail']?></td>
      <td><?php echo ($stu['uStatus'] == 1 ? "<span class='text-white bg-success'>working</span>" : "<span class='text-white bg-danger'>stopped</span>") ?></td>
      <td> <?php echo $stu['uPassword']?> </td>
      <td>
        <a href="<?php echo base_url."dash/pages/preview?supervisor=".base64_encode($idg).""?>" class=" px-2 h6 text-success" data-toggle="tooltip" data-placement="bottom" title="See details"><i class="far fa-eye"></i></a>
        <a href="<?php echo base_url."dash/pages/edit?supervisor=".base64_encode($idg).""?>" class=" px-2 h6 text-primary" data-toggle="tooltip" data-placement="bottom" title="Edit <?php echo $stu['uFname'] ?>"><i class="fas fa-pencil-alt"></i></a>
        <?php
          if ($_SESSION['idAdmin'] != 3) {
        ?>
        <button data-del="<?php echo $stu['uId']?>" class="Deletesuper py-2 px-2 h6 text-danger" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="far fa-trash-alt"></i></button>
          <?php }?>
      </td>
    </tr>
  <?php }}?>
  </tbody>
</table>
<?php
  include "../include/endside.php";
  include "../include/footer.php";
?>