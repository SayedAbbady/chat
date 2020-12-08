<?php
include "session.php";
include "../oper/data.php";
include "../include/header.php";
$user = new data();
$userId = $_SESSION['userChatId'];

$id = $_GET['u'];
$gid = base64_decode($_GET['g']);

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
            <a target="_blank" href="<?php echo base_url ?>assets/img/<?php echo str_replace("../assets/img/", "", $dtat['uImage']) ?>"><img src="<?php echo base_url ?>assets/img/<?php echo str_replace("../assets/img/", "", $dtat['uImage']) ?>" class="mx-auto d-block rounded-circle" style="width:200px;height:200px;object-fit:cover;" alt=""></a>

            <p class="mt-3"> <b>Name :</b> <?php echo $name; ?></p>
            <p class="mt-3"><b>Status :</b>
              <?php
              if ($dtat['uActive'] == "1") {
              ?>
                <span class="online"><i class="fas fa-circle text-success"></i></span> online</p>
          <?php } else {
                echo '<span class="online"><i class="far fa-circle text-success"></i></span> offline</p>';
              }
          ?>
          </div>
        </div>
        <!--=================================Right side=================================-->
        <!--Chat messages-->
        <div class="col-md-8 chat-message-repo ">
          <div class="message-to-from">
            <div class="calls" id="message">


              <div class=" px-5 py-5">
                <div class=" repo mx-auto">
                  <p class="mb-5">Media in this group</p>
                  <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                      <?php
                      if ($_SESSION['userChatType'] == "supr") {
                      ?>
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Info</a>
                      <?php
                      }
                      ?>
                      <a class="nav-item nav-link <?php echo ($_SESSION['userChatType'] != "supr" ? "active" : "") ?>" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Files</a>
                      <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Image</a>
                    </div>
                  </nav>
                  <div class="tab-content" id="nav-tabContent">
                    <?php
                    if ($_SESSION['userChatType'] == "supr") {
                    ?>
                      <!-- echo  -->
                      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <!--  -->
                        <div class="add-student">
                          <div class="row">
                            <div class="col-12 _info mt-4">
                              <div class="">
                                Name : <?php echo $dtat['uFname'] . " " . $dtat['uLname'] ?></div>
                            </div>
                            <div class="col-12 _info">
                              <div>Email : <?php echo $dtat['uEmail'] ?></div>
                            </div>

                            <div class="col-12 _info">
                              <div>Gender : <?php echo $dtat['uGender'] ?></div>
                            </div>
                            <div class="col-12 _info">
                              <div>Status :
                                <?php echo ($dtat['uStatus'] == '1' ? '<span class="bg-success text-white">Active</span>' : '<span class="bg-danger text-white">Unactive</span>') ?></div>
                            </div>
                            <div class="col-12 _info">
                              <div>Phone No. : <?php echo $dtat['uPhone'] ?></div>
                            </div>
                            <div class="col-12 _info">
                              <div>Website URL :
                                <div class="float-right">
                                  <button onclick="copfunc('#url')" class="bg-primary text-white px-2 rounded-pill">copy</button>
                                </div>
                                <div><a href="<?php echo $dtat['uUrl'] ?>" id="url"><?php echo $dtat['uUrl'] ?></a></div>
                              </div>
                            </div>
                            <div class="col-12 _info">
                              <div>Zoom URL :
                                <div class="float-right">
                                  <button onclick="copfunc('#zoom')" class="bg-primary text-white px-2 rounded-pill">copy</button>
                                </div>
                                <div><a href="<?php echo $dtat['uZoom'] ?>" id="zoom"><?php echo $dtat['uZoom'] ?></a></div>
                              </div>
                            </div>

                          </div>
                        </div>
                        <!--  -->
                      </div>
                    <?php
                    }
                    ?>
                    <div class="tab-pane fade <?php echo ($_SESSION['userChatType'] != "supr" ? "show active" : "") ?>" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                      <div class="collection-data">

                        <?php
                        $tablem = '`msg`';
                        $condtion = "`gId` = '$gid' AND `mType` = '3'";
                        $files = $user->fetchCon($tablem, $condtion);
                        if ($files->rowCount() >= 1) {
                          // var_dump($info);
                          while ($info = $files->fetch(PDO::FETCH_ASSOC)) {

                            $time = date("h:i a", strtotime($info['mDate']));

                            $mms = str_replace("../assets/img/files/", "", $info['mText']);
                            $text = '<a href="' . $info['mText'] . '" target="_blank"><i class="far fa-arrow-alt-circle-up"></i> ' . $mms . '</a>';

                        ?>
                            <div class="_info <?php echo ($info['mSender'] == $userId ? "usersend" : "userrecieve") ?>">
                              <span>
                                <p class="reciveP">(<?php echo ($info['mSender'] == $userId ? "ME" : $info['mName']) ?>) sent</p>
                                <div class="mosage"><?php echo $text ?></div>
                                <!-- <p class="text-right" style="font-siz:10px"><?php echo $time ?></p> -->
                              </span>
                            </div>
                        <?php
                          }
                        } else {
                          echo "<div class='alert alert-danger'>no files</div>";
                        }
                        ?>
                      </div>

                    </div>
                    <div class="tab-pane fade " id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                      <div class="row collection-data">

                        <?php
                        $tablem = '`msg`';
                        $condtion = "`gId` = '$gid' AND `mType` = '2'";
                        $images = $user->fetchCon($tablem, $condtion);
                        if ($images->rowCount() >= 1) {

                          // var_dump($info);
                          while ($image = $images->fetch(PDO::FETCH_ASSOC)) {

                            $time = date("h:i a", strtotime($image['mDate']));
                            $text = '<a href="' . $image['mText'] . '" target="_blank"><img width="100%" src="' . $image['mText'] . '"></a>';

                        ?>
                            <div class="col-3 <?php echo ($image['mSender'] == $userId ? "usersend" : "userrecieve") ?>">
                              <span>
                                <p class="reciveP text-success">(<?php echo ($image['mSender'] == $userId ? "ME" : $image['mName']) ?>) sent</p>
                                <div class="mosage"><?php echo $text ?></div>
                                <!-- <p class="text-right" style="font-siz:10px"><?php echo $time ?></p> -->
                              </span>
                            </div>
                        <?php
                          }
                        } else {
                          echo "<div class='alert alert-danger'>no files</div>";
                        }
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
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