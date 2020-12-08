<?php
include "session.php";
include "../oper/data.php";
include "../include/header.php";

/************************************************* 
  *get groups if user is support line 57         *
  *get groups if user is student                 *
  *get groups if user is                  *
  *get groups if user is support                 *
  *get groups if user is support                 *
  *get groups if user is support                 *
  *get groups if user is support                 *
  ************************************************
*/
?>
<h1 id="t"></h1>
<div class="user">
  <div class="container">
    <div class="chat">
      <div class="row">
        <div class="col-md-4 right-side border-right border-light">

          <!--information of user loged (image and menu)-->
          <header class="row info">
            <div class="col-6">
              <img src="<?php echo base_url ?>assets/img/upload/<?php echo str_replace("../assets/img/", "", $_SESSION['userChatImage']) ?>" class="" alt="">
            </div>
            <div class="col-6 text-right">
              <div class="dropdown">
                <span class="dropdown-toggle" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                </span>
                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                  <a target="_blank" href="<?php echo base_url ?>pages/edit"><button class="dropdown-item" type="button">Edit profile</button>
                  </a>
                  <a target="_blank" href="<?php echo base_url ?>pages/report"><button class="dropdown-item" type="button">Report a problem</button></a>
                  <div class="dropdown-divider"></div>
                  <a href="<?php echo base_url ?>pages/logout"><button class="dropdown-item" type="button">log out</button></a>
                </div>
              </div>
            </div>
          </header>
          <!--information of user loged (image and menu)-->

          <!--search section-->
          <section class="search-section row">
            <div class="col-12">
              <div class="form-group has-search">
                <img src="<?php echo base_url ?>assets/img/icons/search.svg" class="form-control-feedback" alt="">
                <input type="text" class="form-control" placeholder="Search">
              </div>
            </div>
          </section>
          <!--search section-->
          <section class="text-center">
            <div class="unread-message">
              <p><i class=" fas fa-circle"></i>There are unread messages</p>
            </div>
          </section>
          <!--user contact-->
          <section class="user-contact" id="user-online-get">
            <?php
            $user = new data();
            $id = $_SESSION['userChatId'];
            $tablemsg = '`msg`';

            // get groups if user is support
            if ($_SESSION['userChatType'] == "supr") {
              $table = '`gsuper`,`groups`';

              $condetion = "`gsuper`.`gId`=`groups`.`gId` AND `gsuper`.`idSupervisor`='$id'";
              $guest = $user->fetchCon($table, $condetion);
              if ($guest->rowCount() >= 1) {

                while ($one = $guest->fetch(PDO::FETCH_ASSOC)) {
                  $gId = $one['gId'];
                  $condetionmsg = "`msg`.`gId`='$gId' AND `msg`.`mSeenS` ='0'";
                  $numChat = $user->fetchCon($tablemsg, $condetionmsg);
                  $stutes = $one['status'];
            ?>
                  <div class="one-user" data-group="<?php echo base64_encode($one['gId']) ?>" data-go="<?php echo ($stutes == "1" ? "true" : "fales") ?>">
                    <div class="row">
                      <div class="col-3 text-center">
                        <div class="imgprofile">
                          <img src="<?php echo base_url ?>assets/img/upload/group.svg" style="width:55px" class="d-inline-block user-img" alt="">
                          <!-- <span class="online"><i class="fas fa-circle"></i></span> -->
                        </div>
                      </div>
                      <div class="col-7 border-bottom pb-3">
                        <div class="float-left">
                          <header class="nameUser"><?php echo $one['gName'] ?></header>
                          <p>Teacher: <?php echo $one['gSubname'] ?> </p>
                        </div>
                        <div class="float-right mt-3">
                          <div id="numOfMs"><?php echo $numChat->rowCount(); ?></div>
                        </div>
                      </div>
                      <div class="col-2  pb-3 text-right">
                        <span class="controls">
                          <!-- Today
                          <i class="fas fa-chevron-circle-down"></i> -->
                        </span>
                      </div>
                    </div>
                  </div>
                <?php

                }
              }

              // if user is teacher
            } else if ($_SESSION['userChatType'] == "Te") {
              $table = '`groups`';
              $condetion = "`groups`.`idTeacher` ='$id'";
              $guest = $user->fetchCon($table, $condetion);
              if ($guest->rowCount() >= 1) {
                $usercoulmn = '`uId`,`uFname`,`uLname`,`uImage`,`uActive`';
                
                while ($one = $guest->fetch(PDO::FETCH_ASSOC)) {
                  // check if student with this teacher is single student OR family
                  // if family will fetch name of child from family table "depending on" parent Id
                  if ($one['gType'] == '0') {
                    // if single student with teacher were loged
                    $studentId      = $one['idStudent'];
                    $userCondetion  = "`users`.`uId`='$studentId'";
                    $student        = $user->fetchclumn($usercoulmn, '`users`', $userCondetion)->fetch(PDO::FETCH_ASSOC);
                    $type           = '';
                  } else {
                    // if Family with teacher were loged
                    $studentId      = $one['gType'];
                    $userCondetion  = "`family`.`u_id`=`users`.`uId`";
                    $student        = $user->fetchCon('`users`,`family`', $userCondetion)->fetch(PDO::FETCH_ASSOC);
                    $type           = 'family';
                  }

                  $gId            = $one['gId'];
                  $stutes         = $one['status'];
                ?>
                  <div class="one-user" data-group="<?php echo base64_encode($one['gId']) ?>" data-go="<?php echo ($stutes == "1" ? "true" : "fales") ?>">
                    <div class="row">
                      <div class="col-3 text-center">
                        <div class="imgprofile">
                          <img src="<?php echo base_url ?>assets/img/upload/<?php echo str_replace("../assets/img/", "", $student['uImage']) ?>" class="d-inline-block user-img" alt="">
                          <span class="online"><i id="<?php echo $student['uId'] ?>" class="<?php echo ($student['uActive'] == "1" ? "fas" : "far") ?> fa-circle"></i></span>
                        </div>
                      </div>
                      <div class="col-7 border-bottom">
                        <div class="float-left">
                          <p class="mt-3 nameUser"><?php echo $student['uFname'] . " " . $student['uLname'] . " " .
                            $type??""
                          ?></p>
                        </div>
                        <div class="float-right mt-3">
                          <div id="numOfMs"><?php 
                            echo 
                            $user ->fetchCon("`msg`", "`msg`.`gId`='$gId' AND `msg`.`mSeenT` ='0'")
                                  ->rowCount();
                          ?></div>
                        </div>
                      </div>
                      <div class="col-2 mt-3 text-right">
                        <span class="controls">
                          <!-- Today
                          <i class="fas fa-chevron-circle-down"></i> -->
                        </span>
                      </div>
                    </div>
                  </div>
                <?php
                }
              }

              // if user is Family ('par' means parent) 
              // على حسب اليوزر بيجيب اطفاله اللى متخزنين فى جدول العائلة
            } elseif ($_SESSION['userChatType'] == "par") {
              $table = '`groups`';
              $condetion = "`groups`.`gType` ='$id'";
              $guest = $user->fetchCon($table, $condetion);
              if ($guest->rowCount() >= 1) {
                $usercoulmn = '`uId`,`uFname`,`uLname`,`uImage`,`uActive`';
                
                while ($one = $guest->fetch(PDO::FETCH_ASSOC)) {
                  $studentId      = $one['idTeacher'];
                  $userCondetion  = "`users`.`uId`='$studentId'";
                  $student        = $user->fetchclumn($usercoulmn, '`users`', $userCondetion)->fetch(PDO::FETCH_ASSOC);
                  $gId            = $one['gId'];
                  $stutes         = $one['status'];
                ?>
                  <div class="one-user" data-group="<?php echo base64_encode($one['gId']) ?>" data-go="<?php echo ($stutes == "1" ? "true" : "fales") ?>">
                    <div class="row">
                      <div class="col-3 text-center">
                        <div class="imgprofile">
                          <img src="<?php echo base_url ?>assets/img/upload/<?php echo str_replace("../assets/img/", "", $student['uImage']) ?>" class="d-inline-block user-img" alt="">
                          <span class="online"><i id="<?php echo $student['uId'] ?>" class="<?php echo ($student['uActive'] == "1" ? "fas" : "far") ?> fa-circle"></i></span>
                        </div>
                      </div>
                      <div class="col-7 border-bottom">
                        <div class="float-left">
                          <p class="mt-3 nameUser"><?php echo $student['uFname'] . " " . $student['uLname'] ?></p>
                        </div>
                        <div class="float-right mt-3">
                          <div id="numOfMs"><?php 
                            echo 
                            $user ->fetchCon("`msg`", "`msg`.`gId`='$gId' AND `msg`.`mSeenT` ='0'")
                                  ->rowCount();
                          ?></div>
                        </div>
                      </div>
                      <div class="col-2 mt-3 text-right">
                        <span class="controls">
                          <!-- Today
                          <i class="fas fa-chevron-circle-down"></i> -->
                        </span>
                      </div>
                    </div>
                  </div>
                <?php
                }
              }
            } else {
              $table = '`groups`';
              $condetion = "`groups`.`idStudent` ='$id'";
              $guest = $user->fetchCon($table, $condetion);
              if ($guest->rowCount() >= 1) {
                $usercoulmn = '`uId`,`uFname`,`uLname`,`uImage`,`uActive`';
                $userTable = '`users`';
                while ($one = $guest->fetch(PDO::FETCH_ASSOC)) {
                  $gId = $one['gId'];
                  $condetionmsg = "`msg`.`gId`='$gId' AND `msg`.`mSeen` ='0'";
                  $numChat = $user->fetchCon($tablemsg, $condetionmsg);
                  $studentId = $one['idTeacher'];
                  $userCondetion = "`users`.`uId`='$studentId'";
                  $details = $user->fetchclumn($usercoulmn, $userTable, $userCondetion);
                  $student = $details->fetch(PDO::FETCH_ASSOC);
                  $stutes = $one['status'];
                ?>
                  <div class="one-user" data-group="<?php echo base64_encode($one['gId']) ?>" data-go="<?php echo ($stutes == "1" ? "true" : "fales") ?>">
                    <div class="row">
                      <div class="col-3 text-center">
                        <div class="imgprofile">
                          <img src="<?php echo base_url ?>assets/img/upload/<?php echo str_replace("../assets/img/", "", $student['uImage']) ?>" class="d-inline-block user-img" alt="">
                          <span class="online"><i id="<?php echo $student['uId'] ?>" class="<?php echo ($student['uActive'] == "1" ? "fas" : "far") ?> fa-circle"></i></span>
                        </div>
                      </div>
                      <div class="col-7 border-bottom">
                        <div class="float-left">
                          <p class="mt-3 nameUser"><?php echo $student['uFname'] . " " . $student['uLname'] ?></p>
                        </div>
                        <div class="float-right mt-3">
                          <div id="numOfMs"><?php echo $numChat->rowCount(); ?></div>
                        </div>
                      </div>
                      <div class="col-2 mt-3 text-right">
                        <span class="controls">
                          <!-- Today
                          <i class="fas fa-chevron-circle-down"></i> -->
                        </span>
                      </div>
                    </div>
                  </div>
            <?php
                }
              }
            }
            ?>
          </section>
          <!--user contact-->
        </div>
        <!--=================================Right side=================================-->
        <!--Chat messages-->
        <div class="col-md-8 chat-message" id="chat-Message-data">
          <div class="content-free">
            <div class="content-free-child">
              <div class="text-center">
                <img src="<?php echo base_url ?>assets/img/icons/download.jpg" class="mx-auto d-inline-block" width="100px" alt="">
              </div>
              <div class="mt-2">
                Click now to start conversation
                <?php
                if ($_SESSION['userChatType'] == "supr") {
                  echo "";
                } else if ($_SESSION['userChatType'] == "Te") {
                  echo " with your students";
                } else {
                  echo " with your teacher";
                }

                ?>
              </div>
            </div>
          </div>
          <div class="content-ful">
            <!--information of user loged (image and menu)-->
            <header class="row info">
              <div class="col-7">
                <img src="" alt="">
                <div class="d-inline-block user-status">
                  <p id="groupName"></p>
                  <p id="teacherName"></p>
                </div>
              </div>
              <div class="col-5 text-right">
                <div class="btn btn-primary upload-files-btn" data-toggle="tooltip" data-placement="bottom" title="upload files">
                  <form action="<?php echo base_url ?>oper/up-files.php" id="up-data-File" method="post" enctype="multipart/form-data">
                    <input type="file" class="file-up-data-load" name="fileUp">
                    <input type="hidden" name="gId" id="ggroup">
                  </form>
                  <span>
                    <i class="fas fa-upload"></i>
                  </span>
                  <span>
                    <i class="far fa-file-pdf"></i>
                  </span>
                  <span>
                    <i class="far fa-image"></i>
                  </span>

                </div>
              </div>
            </header>
            <!--information of user loged (image and menu)-->

            <!--Show message-->
            <div class="message-to-from" style="margin-bottom: 70px;">
              <div class="calls" id="message">

              </div>
            </div>
            <!--show mesaage-->

            <!--Send message-->
            <div class="send-message-form">
              <span class="con-vaild text-center d-block"></span>
              <form id="form-set" method="POST">
                <div class="row ml-3" id="send-message-control">

                  <div class="col-9 offset-1">
                    <input type="text" id="emo" class="rounded-pill" placeholder="Write your message...." autocomplete="off">
                  </div>
                  <div class="col-2">
                    <div class="send-button mt-1">
                      <!-- <input type="submit" id="send" value=""> -->
                      <i class="fas fa-location-arrow"></i>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <!--Send message-->
            <?php

            ?>

          </div>
          <!--content-ful-->

        </div>
        <!--Chat meassage-->
      </div>
    </div>
  </div>
</div>
<?php
include "../include/footer.php";
?>