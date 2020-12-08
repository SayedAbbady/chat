<?php
  include "../oper/data.php";
  include "session.php";
  include "../include/header.php";
  include "../include/aside.php";
  $admin = new data();
  
  
  if (isset($_GET['admin']) && $_GET['admin'] != "") {
    $id = base64_decode($_GET['admin']);
    $table = '`admin`';
    $condition = "`dId` = '$id'";
    $adm = $admin->fetchCon($table,$condition);
    if ($adm->rowCount() >= 1) {
    
    $admin = $adm->fetch(PDO::FETCH_ASSOC);

    ?>
    <div class="add-student">
      <h4>Edit Admin</h4>
      <form action="" class="form-group row" >
        <div class="col-12 text-center my-4" id="result"></div>
        
        <div class="col-12 my-4">
          <label for="fname" >Full name</label>
          <input type="text" class="form-control" id="fname" placeholder="Full name"  value="<?php echo $admin['dName']?>">
        </div>
        
        <div class="col-12 ">
          <label for="email" >Email</label>
          <input type="text" class="form-control" id="email" placeholder="Email" value="<?php echo $admin['dEmail']?>">
        </div>
        <div class="col-6 my-4">
          <label for="pass" >Password</label>
          <input type="text" class="form-control" id="pass" placeholder="Password" value="<?php echo base64_decode($admin['dPass'])?>">
        </div>
        <div class="col-6 my-4">
          <label for="passc" >Confirm Password</label>
          <input type="text" class="form-control" id="passc" placeholder="Confirm password" value="<?php echo base64_decode($admin['dPass'])?>">
        </div>
        
        <div class="col-12">
          <input type="submit" value="Edit Admin" id="editadmin" class=" btn btn-primary" data-del="<?php echo $_GET['admin']?>">
        </div>
      </form>
    </div>
    <?php
  } else {echo "<div class='alert alert-danger text-center'>Not valid data</div>";}

  } elseif(isset($_GET['supervisor']) && $_GET['supervisor'] != "") {
    $id = base64_decode($_GET['supervisor']);
    $table = '`users`';
    $condition = "`uId` = '$id'";
    $adm = $admin->fetchCon($table,$condition);
    if ($adm->rowCount() >= 1) {
    $admin = $adm->fetch(PDO::FETCH_ASSOC);
    
    ?>
    <div class="add-student">
      <h4>Edit Supervisor</h4>
      <form action="" class="form-group row" >
        <div class="col-12 text-center my-4" id="result"></div>
        <div class="col-12 mb-4">
          <label for="type" >Type</label>
          <input type="text" class="form-control" id="type" value="Supervisor" readonly>
        </div>
        <div class="col-6">
          <label for="fname" >Firstname</label>
          <input type="text" class="form-control" id="fname" value="<?php echo $admin['uFname']?>" placeholder="Firstname" >
        </div>
        <div class="col-6">
          <label for="lname" >Lastname</label>
          <input type="text" class="form-control" id="lname" value="Eaalim" placeholder="Lastname" readonly>
        </div>
        <div class="col-12 my-4">
          <label for="gender" >Gender</label>
            <select class="form-control" id="gender">
              <option value="male" <?php echo ($admin['uGender']=='Male' ? 'selected' : '')?>>Male</option>
              <option value="female" <?php echo ($admin['uGender']=='Female' ? 'selected' : '')?>>Female</option>
            </select>
        </div>
        <div class="col-12 ">
          <label for="email" >Email</label>
          <input type="text" class="form-control" id="email" value="<?php echo $admin['uEmail']?>" placeholder="Email">
        </div>
        <div class="col-6 my-4">
          <label for="pass" >Password</label>
          <input type="text" class="form-control" id="pass" value="<?php echo base64_decode($admin['uPassword'])?>" placeholder="Password">
        </div>
        <div class="col-6 my-4">
          <label for="passc" >Confirm Password</label>
          <input type="text" class="form-control" id="passc" value="<?php echo base64_decode($admin['uPassword'])?>" placeholder="Confirm password">
        </div>
        
        <div class="col-12">
          <input type="submit" value="Edit Supervisor" id="editsuper" class=" btn btn-primary" data-del="<?php echo $_GET['supervisor']?>">
        </div>
      </form>
    </div>
    <?php
  } else {echo "<div class='alert alert-danger text-center'>Not valid data</div>";}
  } elseif(isset($_GET['teacher']) && $_GET['teacher'] != "") {
    $id = base64_decode($_GET['teacher']);
    $table = '`users`';
    $condition = "`uId` = '$id'";
    $adm = $admin->fetchCon($table,$condition);
    if ($adm->rowCount() >= 1) {
    $admin = $adm->fetch(PDO::FETCH_ASSOC);
    
    ?>
    <div class="add-student">
      <h4>Edit Teacher</h4>
      <form action="" class="form-group row" >
        <div class="col-12 text-center my-4" id="result"></div>
        <div class="col-12 mb-4">
          <label for="type" >Type</label>
          <input type="text" class="form-control" id="type" value="Teacher" readonly>
        </div>
        <div class="col-6">
          <label for="fname" >Firstname</label>
          <input type="text" class="form-control" id="fname" value="<?php echo $admin['uFname']?>" placeholder="Firstname" >
        </div>
        <div class="col-6">
          <label for="lname" >Lastname</label>
          <input type="text" class="form-control" id="lname" value="<?php echo $admin['uLname']?>" placeholder="Lastname">
        </div>
        <div class="col-12 my-4">
          <label for="gender" >Gender</label>
            <select class="form-control" id="gender">
              <option value="male" <?php echo ($admin['uGender']=='Male' ? 'selected' : '')?>>Male</option>
              <option value="female" <?php echo ($admin['uGender']=='Female' ? 'selected' : '')?>>Female</option>
            </select>
        </div>
        <div class="col-12 ">
          <label for="email" >Email</label>
          <input type="text" class="form-control" id="email" value="<?php echo $admin['uEmail']?>" placeholder="Email">
        </div>
        <div class="col-6 my-4">
          <label for="pass" >Password</label>
          <input type="text" class="form-control" id="pass" value="<?php echo base64_decode($admin['uPassword'])?>" placeholder="Password">
        </div>
        <div class="col-6 my-4">
          <label for="passc" >Confirm Password</label>
          <input type="text" class="form-control" id="passc" value="<?php echo base64_decode($admin['uPassword'])?>" placeholder="Confirm password">
        </div>
        <div class="col-12">
          <label for="status">Status</label>
          <select class="form-control" id="status">
            <option value="active" <?php echo ($admin['uStatus']=='1' ? 'selected' : '')?>>Active</option>
              <option value="unactive" <?php echo ($admin['uStatus']=='0' ? 'selected' : '')?>>Unactive</option>
          </select>
          
        </div>
        <div class="col-12 my-4">
          <input type="submit" value="Edit Teacher" id="editte" class=" btn btn-primary" data-del="<?php echo $_GET['teacher']?>">
        </div>
      </form>
    </div>
    <?php
  } else {echo "<div class='alert alert-danger text-center'>Not valid data</div>";}
  } elseif(isset($_GET['student']) && $_GET['student'] != "") {
      $id = base64_decode($_GET['student']);
      $table = '`users`';
      $condition = "`uId` = '$id'";
      $condition2 = "`uType` = 'te'";
      $adm = $admin->fetchCon($table,$condition);
      $teacher = $admin->fetchCon($table,$condition2);
      if ($adm->rowCount() >= 1) {
      $admin = $adm->fetch(PDO::FETCH_ASSOC);
      
      ?>
      <div class="add-student">
        <h4>Edit Student</h4>
        <form action="" class="form-group row" >
          <div class="col-12 text-center my-4" id="result"></div>
          <div class="col-12 mb-4">
            <label for="type" >Type</label>
            <input type="text" class="form-control" id="type" value="Student" readonly>
            <input type="hidden" id="oldtea" value="<?php echo base64_encode($admin['tId'])?>">
          </div>
          <div class="col-6">
            <label for="fname" >Firstname</label>
            <input type="text" class="form-control" id="fname" value="<?php echo $admin['uFname']?>" placeholder="Firstname" >
          </div>
          <div class="col-6">
            <label for="lname" >Lastname</label>
            <input type="text" class="form-control" id="lname" value="<?php echo $admin['uLname']?>" placeholder="Lastname">
          </div>
          <div class="col-12 my-4">
            <label for="gender" >Gender</label>
              <select class="form-control" id="gender">
                <option value="male" <?php echo ($admin['uGender']=='Male' ? 'selected' : '')?>>Male</option>
                <option value="female" <?php echo ($admin['uGender']=='Female' ? 'selected' : '')?>>Female</option>
              </select>
          </div>
          <div class="col-12 ">
            <label for="email" >Email</label>
            <input type="text" class="form-control" id="email" value="<?php echo $admin['uEmail']?>" placeholder="Email">
          </div>
          <div class="col-12 my-4">
            <label for="selectTeachers">Edit his/her teacher</label>
            <select id="selectTeachers" class="form-control">
              <?php  
                while ($member = $teacher->fetch(PDO::FETCH_ASSOC)) {
                $idte = $member['uId'];
                $te = $admin['tId'];
              ?>
              <option value="" data-tename="<?php echo base64_encode($member['uFname'] ." ". $member['uLname'])?>" class="form-control" <?php echo ($te == $idte ? "selected" : "")?> data-te="<?php echo base64_encode($member['uId'])?>"><?php echo $member['uFname'] ." ". $member['uLname']?></option>
              <?php 
              }  
              ?>
            </select>
          </div>
          <div class="col-6 ">
            <label for="pass" >Password</label>
            <input type="text" class="form-control" id="pass" value="<?php echo base64_decode($admin['uPassword'])?>" placeholder="Password">
          </div>
          <div class="col-6 ">
            <label for="passc" >Confirm Password</label>
            <input type="text" class="form-control" id="passc" value="<?php echo base64_decode($admin['uPassword'])?>" placeholder="Confirm password">
          </div>
          <div class="col-12 my-4">
            <label for="status">Status</label>
            <select class="form-control" id="status">
              <option value="active" <?php echo ($admin['uStatus']=='1' ? 'selected' : '')?>>Active</option>
                <option value="unactive" <?php echo ($admin['uStatus']=='0' ? 'selected' : '')?>>Unactive</option>
            </select>
            
          </div>
          <div class="col-12">
            <input type="submit" value="Edit Student" id="editstudent" class=" btn btn-primary" data-del="<?php echo $_GET['student']?>">
          </div>
        </form>
      </div>
      <?php
    } else {echo "<div class='alert alert-danger text-center'>Not valid data</div>";} 
  } elseif(isset($_GET['family']) && $_GET['family'] != "") {
      $id = base64_decode($_GET['family']);
      $table = '`users`';
      $condition = "`uId` = '$id'";
      $adm = $admin->fetchCon($table,$condition);
      if ($adm->rowCount() >= 1) {
      $admin = $adm->fetch(PDO::FETCH_ASSOC);
      
      ?>
      <div class="add-student">
        <h4>Edit family</h4>
        <form action="" class="form-group row" >
          <div class="col-12 text-center my-4" id="result"></div>
          <div class="col-12 mb-4">
            <label for="type" >Type</label>
            <input type="text" class="form-control" id="type" value="Family" readonly>
          </div>
          <div class="col-6">
            <label for="fname" >Firstname</label>
            <input type="text" class="form-control" id="fname" value="<?php echo $admin['uFname']?>" placeholder="Firstname" >
          </div>
          <div class="col-6">
            <label for="lname" >Lastname</label>
            <input type="text" class="form-control" id="lname" value="<?php echo $admin['uLname']?>" placeholder="Lastname">
          </div>
          <div class="col-12 my-4">
            <label for="gender" >Gender</label>
              <select class="form-control" id="gender">
                <option value="male" <?php echo ($admin['uGender']=='Male' ? 'selected' : '')?>>Male</option>
                <option value="female" <?php echo ($admin['uGender']=='Female' ? 'selected' : '')?>>Female</option>
              </select>
          </div>
          <div class="col-12 ">
            <label for="email" >Email</label>
            <input type="text" class="form-control" id="email" value="<?php echo $admin['uEmail']?>" placeholder="Email">
          </div>
          <div class="col-12 my-4">
            <label for="phone" >Phone</label>
            <input type="text" class="form-control" id="phone" value="<?php echo $admin['uPhone']?>" placeholder="Phone">
          </div>
          <div class=" col-12">
            <label for="uzoom" >Zoom URL</label>
            <input type="text" class="form-control" id="uzoom" value="<?php echo $admin['uZoom']?>" placeholder="Zoom URL">
          </div>
          <div class="col-12 my-4">
            <label for="pUrl" >Page URL</label>
            <input type="text" class="form-control" id="pUrl" value="<?php echo $admin['uUrl']?>" placeholder="Page URL">
          </div>
          <div class="col-6">
            <label for="pass" >Password</label>
            <input type="text" class="form-control" id="pass" value="<?php echo base64_decode($admin['uPassword'])?>" placeholder="Password">
          </div>
          <div class="col-6">
            <label for="passc" >Confirm Password</label>
            <input type="text" class="form-control" id="passc" value="<?php echo base64_decode($admin['uPassword'])?>" placeholder="Confirm password">
          </div>
          <div class="col-12 my-4">
            <label for="status">Status</label>
            <select class="form-control" id="status">
              <option value="active" <?php echo ($admin['uStatus']=='1' ? 'selected' : '')?>>Active</option>
              <option value="unactive" <?php echo ($admin['uStatus']=='0' ? 'selected' : '')?>>Unactive</option>
            </select>
            
          </div>
          <div class="col-12">
            <input type="submit" value="Edit Family" id="editfamily" class=" btn btn-primary" data-del="<?php echo $_GET['family']?>">
          </div>
        </form>
      </div>
      <?php
    } else {echo "<div class='alert alert-danger text-center'>Not valid data</div>";}  
  } elseif(isset($_GET['group']) && $_GET['group'] != "") {
      $id = base64_decode($_GET['group']);
      $table = '`groups`';
      $condition = "`gId` = '$id'";
      $adm = $admin->fetchCon($table,$condition);
      $super = $admin->fetchCon('`users`',"`uType` = 'supr'");
      if ($adm->rowCount() >= 1) {
      $admin = $adm->fetch(PDO::FETCH_ASSOC);
      
      ?>
      <div class="add-student">
        <h4>Edit Group</h4>
        <form action="" class="form-group row" >
          <div class="col-12 text-center my-4" id="result"></div>
          <div class="col-12 mb-4">
            <label for="type" >Type</label>
            <input type="text" class="form-control" id="type" value="Group" readonly>
          </div>
          <div class="col-12">
            <label for="fname" >Name of group</label>
            <input type="text" class="form-control" id="nameGroup" value="<?php echo $admin['gName']?>" placeholder="Firstname" >
          </div>
          <div class="col-12 my-4">
            <label for="lname" >Teacher</label>
            <input type="text" class="form-control" value="<?php echo $admin['gSubname']?>" placeholder="Lastname" readonly>
          </div>
          
          <div class="col-12 ">
            <label for="email" >Student</label>
            <input type="text" class="form-control"  value="<?php echo str_replace("`s Group","",$admin['gName'])?>" readonly>
          </div>
          
          <div class="col-12 my-4">
            <label for="status">Status</label>
            <select class="form-control" id="status">
              <option value="active" <?php echo ($admin['status']=='1' ? 'selected' : '')?>>Active</option>
                <option value="unactive" <?php echo ($admin['status']=='0' ? 'selected' : '')?>>Unactive</option>
            </select>
          </div>

          <div class="col-12">
            <label for="super">Add supervisor to group</label>
            <select id="selectSuper" class="form-control" multiple >
              <?php
                while ($supname = $super->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                  <option value="<?php echo $supname['uId']?>"><?php echo $supname['uFname'] . " " . $supname['uLname'];?></option>
                  <?php
                }
              ?>
            </select>
          </div>

          <div class="col-12 my-4">
            <input type="submit" value="Edit Group" id="editgroup" class=" btn btn-primary" data-del="<?php echo $_GET['group']?>">
          </div>
        </form>
      </div>
      <?php
    } else {echo "<div class='alert alert-danger text-center'>Not valid data</div>";}
  } else {
    echo "<div class='alert alert-danger text-center'>you not have permission to access this page</div>";

  }
  ?>
    
<?php
  include "../include/endside.php";
  include "../include/footer.php";
?>