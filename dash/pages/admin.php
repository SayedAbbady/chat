<?php
  include "../oper/data.php";
  include "session.php";
  include "../include/header.php";
  include "../include/aside.php";
  $student = new data();
?>
<div class="row mb-5">
  <div class="col-6">
    <h3 class="text-uppercase font-weight-bold">Admins</h3>
  </div>
  <div class="col-6 text-right">
    <a href="<?php echo base_url."dash/pages/add?admin"?>" class="btn btn-primary addBtn">Add Admin</a>
  </div>
</div>
<table id="example1" class="table table-bordered text-center table-striped ">
  <thead>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Email</th>
      <th>Level</th>
      <th>Password</th>
      <th>Controls</th>
    </tr>
  </thead>
  <tbody>
  <?php
    $table = '`admin`';
    $stCount = $student->getAdminGroup($table);
    if ($stCount->rowCount() >= 1) {
      $ID=1;
      while ($stu = $stCount->fetch(PDO::FETCH_ASSOC)) {
      
      
    $idg = $stu['dId'];
  ?>
    <tr id ="<?php echo $stu['dId']?>">
      <td><?php echo $ID++?></td>
      <td><?php echo $stu['dName']?></td>
      <td><?php echo $stu['dEmail']?></td>
      <td><?php 
        if ($stu['dLevel'] == 1) {
          echo "<span class='text-white bg-success'>Admin</span>";
        } elseif ($stu['dLevel'] == 2) {
          echo "<span class='text-white bg-info'>Manager</span>";
        } else {
          echo "<span class='text-white bg-danger'>Support</span>";
        }
        ?>
      </td>
      
      <td> <?php echo $stu['dPass']?> </td>
      <td>
        <a href="<?php echo base_url."dash/pages/edit?admin=".base64_encode($idg).""?>" class=" px-2 h6 text-primary" data-toggle="tooltip" data-placement="bottom" title="Edit <?php echo $stu['dName'] ?>"><i class="fas fa-pencil-alt"></i></a>

        <button data-del="<?php echo $stu['dId']?>" class="DeleteId py-2 px-2 h6 text-danger" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="far fa-trash-alt"></i></button>
      </td>
    </tr>
  <?php }}?>
  </tbody>
</table>
<?php
  include "../include/endside.php";
  include "../include/footer.php";
?>