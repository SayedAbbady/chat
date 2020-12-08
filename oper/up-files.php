<?php

session_start();
include_once "../config.php";
include "data.php";
$userIdSession = $_SESSION['userChatId'];
$date = date("y-m-d H:i");
$meassage = new data();

$info=[];

$types = $_SESSION['userChatType'];

if ($types == 'Te') {
    $typeI = '`mSeenT`';
} else if ($types == 'stu') {
    $typeI = '`mSeen`';
}
else {
    $typeI = '`mSeenS`';
}

$target_dir = "../assets/img/files/";
$target_file = $target_dir.$_FILES["fileUp"]["name"];
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Allow certain file formats
//if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
//    && $imageFileType != "gif" && $imageFileType !="pdf" && $imageFileType != "xlsx" && $imageFileType != "docx")
//{
//
//    $uploadOk = 0;
//}
if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg"
    || $imageFileType == "gif" ) {
    
    $typef = "2";
}
if ($imageFileType == "pdf" || $imageFileType == "xlsx" || $imageFileType == "docx"){
    
    $typef="3";
}

// Check if $uploadOk is set to 0 by an error
if (empty($typef)) {
    $info['format'] = "1";
    echo json_decode($info);
} else {
    if (move_uploaded_file($_FILES["fileUp"]["tmp_name"], $target_file)) {

        $table = '`msg`';
        $name = $_SESSION['userChatFname'] . " " . $_SESSION['userChatLname'];
        $groupId = base64_decode($_POST['gId']);
        $message = $target_file;
        $value = array(
            "$message",
            "$groupId",
            "$userIdSession",
            "$date",
            "$typef",
            "$name"

        );
        $meassage->insertData($typeI,$table, $value);
        
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

?>