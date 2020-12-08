<?php
include "../oper/data.php";
  include "session.php";
  include "../include/header.php";
  include "../include/aside.php";
  $student = new data();
?>
<div class="row mb-5">
  <div class="col-6">
    <h3 class="text-uppercase font-weight-bold">Groups</h3>
  </div>
  <div class="col-6 text-right">
    <!-- <a href="<?php echo base_url."dash/pages/add?group"?>" class="btn btn-primary addBtn">Add Groups</a> -->
  </div>
</div>
<table id="example1" class="table table-bordered text-center table-striped ">
  <thead>
    <tr>
      <th>#</th>
      <th>Name <sub>(student)</sub></th>
      <th>Teacher's name</th>
      <th>Status</th>
      <th>Supervisors</th>
      <th>Controls</th>
    </tr>
  </thead>
  <tbody>
  <?php
    $table = '`groups`';
    $stCount = $student->getAdminGroup($table);
    
    if ($stCount->rowCount() >= 1) {
      $ID=1;
      while ($stu = $stCount->fetch(PDO::FETCH_ASSOC)) {
        $ip = $stu["gId"];
        $con = "`groups`.`gId`=`gsuper`.`gId` AND `gsuper`.`gId`='$ip'";
      $supergroup = $student->fetchCon('`groups`,`gsuper`',$con);
      

  ?>
    <tr>
      <td><?php echo $ID++?></td>
      <td><?php echo $stu['gName']?></td>
      <td><?php echo $stu['gSubname']?></td>
      <td><?php echo ($stu['status'] == 1 ? "<span class='text-white bg-success'>working</span>" : "<span class='text-white bg-danger'>stopped</span>") ?></td>
      <td><?php echo ($stu['empty'] == 0 ? "<span class='text-black bg-warning'>No supervisor</span>" : "<span class='text-success'> supervisor <span class='numsup'>". $supergroup->rowCount()."</span></span>") ?></td>
      <td>
        <a href="<?php echo base_url."dash/pages/preview?group=".base64_encode($stu['gId']).""?>" class=" px-2 h6 text-success" data-toggle="tooltip" data-placement="bottom" title="See details"><i class="far fa-eye"></i></a>
        <a href="<?php echo base_url."dash/pages/edit?group=".base64_encode($stu['gId']).""?>" class=" px-2 h6 text-primary" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fas fa-pencil-alt"></i></a>

      </td>
    </tr>
  <?php }}?>
  </tbody>
</table>
<?php
  include "../include/endside.php";
  include "../include/footer.php";
?>