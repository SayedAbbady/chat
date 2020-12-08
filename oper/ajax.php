<?php
session_start();

include_once "../config.php";
include "data.php";
$data = new data();

$type = $_SESSION['userChatType'];

if ($type == 'Te') {
  $typeI = '`mSeenT`';
} else if ($type == 'stu') {
  $typeI = '`mSeen`';
} else {
  $typeI = '`mSeenS`';
}
//------------------------------------------------------------

if (!isset($_GET['key'])) {
    echo 'no';
    return;
}

switch (strtolower($_GET['key']) ){
    case 'getchat':
        getChat($data);
        break;

	case'send':
		send($data);
		break;

    case'editprofile':
	    editProfile($data);
        break;

    case 'deletemsg':
	    $msgId = $_POST['MsgId'];
	    $groupId = $_POST['groupId'];
	    $data->deleteMsgUser($msgId);
        break;

    case 'makeseen':
	    $id = $_POST['groupId'];
	    $data->makeSeen($typeI,$id);
        break;

    case'problem':
	    date_default_timezone_set("Africa/Cairo");

	    $uId = $_SESSION['userChatId'];
	    $date = date("Y-m-d H:i",time());

        $text = $_POST['text'];
        $type = $_POST['level'];
        if ($type == "1") {
            $type = "user";
        } elseif ($type == "2") {
            $type = "support";
        } elseif ($type == "3") {
            $type = "technical";
        }
        $table = "`problem`";
        $value = array(
            "$uId",
            "$text",
            "$date",
            "$type"
        );
        $problem = $user->insert($table,$value);
        break;

}

exit();
// show users online





//-- FUNCTIONS --------------------------------------------------------------

function getChat(Data $data){
	$ggropEncrypt = $_POST['group'];
	$group = base64_decode($_POST['group']);
	$id = $_SESSION['userChatId'];
	$type = $_SESSION['userChatType'];

	if ($type == 'Te') {
		$typeI = '`mSeenT`';
	} else if ($type == 'stu') {
		$typeI = '`mSeen`';
	} else {
		$typeI = '`mSeenS`';
	}

	$table = '`msg`';
	$condetion = "`msg`.`gId`='$group'";

	$chat = $data->fetchMessage($condetion, $group, $typeI);

	if ($chat->rowCount() >= 1) {
		while ($chats = $chat->fetch(PDO::FETCH_ASSOC)) {
			$msgIdi =

			$time = date("h:i a", strtotime($chats['mDate']));

			if ($chats['mType'] == "1") {
				$text = $chats['mText'];
			} else if ($chats['mType'] == "2") {
				$text = '<a href="' . $chats['mText'] . '" target="_blank"><img src="' . $chats['mText'] . '"></a>';
			} else if ($chats['mType'] == "3") {
				$mms = str_replace("../assets/img/files/", "", $chats['mText']);
				$text = '<a href="' . $chats['mText'] . '" target="_blank"><i class="far fa-arrow-alt-circle-up"></i> ' . $mms . '</a>';
			} else {
				$text = '<i>' . $chats["mText"] . '</i>';
			}
			?>
            <div class="<?php echo ($chats['mSender'] == $id ? "usersend" : "userrecieve") ?>" id="mGD_<?php echo $chats['mId'] ?>">
				<?php
				if ($chats['mSender'] == $id and $chats['mType'] != "4") {

					?>
                    <span class="dropdown">
            <span class="controo dropdown-toggle" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                <span class="dropdown-item deletemessag">Delete</span>
                <span class="copymessage dropdown-item" onclick="copfunc('#mGD_<?php echo $chats['mId'] ?>S')">Copy</span>
              </div>
            </span>
          </span>
					<?php
				} else {
					$time = "";
				}
				?>
                <span class="span">
          <p class="reciveP">
            <a href="profile?u=<?php echo $chats['mSender'] ?>&g=<?php echo base64_encode($chats['gId']) ?> " target="_blank"><?php echo ($chats['mSender'] == $id ? "" : $chats['mName']) ?></a>
          </p>
          <div class="mosage" id="mGD_<?php echo $chats['mId'] ?>S"><?php echo $text ?></div>
          <p class="text-right" style="font-siz:10px"><?php echo $time ?></p>
        </span>
            </div>
			<?php
		}
		?>
        <script>
            $(function() {
                $(".controo").on("click", "i", function() {
                    $(this).next().toggle();
                });
                $(".deletemessag").click(function() {
                    var parent = $(this).parent().parent().parent().parent();
                    var idmms = parent[0].id;
                    var newId = idmms.replace("mGD_", "");

                    var group = $("#chat-Message-data").attr('data-active');

                    $.ajax({

                        url: '<?= base_url?>/oper/ajax.php?key=deletemsg',
                        type: "POST",
                        data: {
                            MsgId: parseInt(newId),
                            groupId: group
                        },
                        dataType: 'JSON',
                        success: function(date) {
                            if (date.done == "1") {

                                var ocket = {
                                    msgid: newId,
                                    groupId: group,
                                    client: "browser",
                                };

                                conn.emit('delete message', JSON.stringify(ocket));
                            }
                        },
                    });
                })

            });
        </script>
		<?php
	} else {
	}
}

function send(Data $data){
	$userIdSession = $_SESSION['userChatId'];
	$date = date("y-m-d H:i:s");

	$info =[];
	if(isset($_POST['IP']) && $_POST['IP']== "recordMessage"){
		$groupId= base64_decode($_POST['groupId']);
		$message= $_POST['message'];
		$userId= $_POST['userId'];

		if ($userId == $userIdSession) {
			$type = $_SESSION['userChatType'];

			if ($type == 'Te') {
				$typeI = '`mSeenT`';
			} else if ($type == 'stu') {
				$typeI = '`mSeen`';
			} else {
				$typeI = '`mSeenS`';
			}

			$table = '`msg`';
			$name = $_SESSION['userChatFname'] ." ". $_SESSION['userChatLname'];

			$value = array(
				"$message",
				"$groupId",
				"$userId",
				"$date",
				"1",
				"$name"

			);
			$data->insertData($typeI,$table, $value);
		} else {
			$info['valid'] = "<span class='text-white bg-danger'>user was changed</span>";
			echo json_encode($info);
		}
	}
}

function editProfile(Data $data){
	$id = $_SESSION['userChatId'];

	$info = [];

	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	$passc = $_POST['passc'];

	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		if ($pass == $passc) {
			$pass = base64_encode($pass);
			$table = '`users`';
			// upload image
			$uploadOk = 0;
			if (!file_exists($_FILES['image']['tmp_name']) || !is_uploaded_file($_FILES['image']['tmp_name'])) {
				$fields = "`uFname`='$fname',`uLname`='$lname',`uPassword`='$pass',`uEmail`='$email' WHERE `users`.`uId`='$id'";
				$data->edit($table, $fields);
			} else {
				$target_dir = "../assets/img/upload/";
				$target_file = $target_dir . $_FILES["image"]["name"];
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
				// Allow certain file formats
				if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
					$uploadOk = 0;
				}
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
					$info = "<span class='bg-danger text-white'>invalid format</span>";
					echo $info;
				} else {
					if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
						$fields = "`uFname`='$fname',`uLname`='$lname',`uPassword`='$pass',`uEmail`='$email',`uImage`='$target_file' WHERE `users`.`uId`='$id'";
						$data->edit($table, $fields);
						$_SESSION['userChatImage'] = $target_file;
					} else {echo "something is wrong in uploading";}
				}
			}
		} else {
			$info = "<span class='text-white bg-danger'>password doesn't match</span>";
			echo $info;
		}
	} else {
		$info = "<span class='text-white bg-danger'>not valid email</span>";
		echo $info;
	}
}
?>