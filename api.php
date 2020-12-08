<?php
ob_start();
$method = $_SERVER['REQUEST_METHOD'];
if ( $method != 'POST' ) {
	exit();
}
$request = explode( '/', trim( $_SERVER['PATH_INFO'], '/' ) );
//$input = json_decode(file_get_contents('php://input'),true);
//$input = file_get_contents('php://input');
if ( empty( $request[0] ) ) {
	exit();
}

//header('Content-type: application/json; charset=utf-8');
$input = json_decode( file_get_contents( 'php://input' ), true );
include_once "config.php";
include "oper/data.php";
$data = new data();

$response = array();
switch ( $request[0] ) {
	case 'login':
//		$data = $user->login($input['userMail'],$input['userMail']);
		$response = $data->login($input['mail'],$input['password']);

		if (!$response)
			$response['err_msg'] = "false";

		break;
	case 'getGroups':
		$u = $data->getuser($input['uid']);

		$id = $u['uId'];
		$table = '`groups`';

		if ($u['uType'] == "supr") {
			$table = '`gsuper`,`groups`';
			$condetion = "`gsuper`.`gId`=`groups`.`gId` AND `gsuper`.`idSupervisor`='$id'";
			$unread = "`msg`.`gId`='{group}' AND `msg`.`mSeenS` ='0'";
			$guid = "";
		}
		else if ($u['uType'] == "Te") {
			$condetion = "`groups`.`idTeacher` ='$id'";
			$unread = "`msg`.`gId`='{group}' AND `msg`.`mSeenT` ='0'";
			$guid = "idTeacher";
		}
		else {
			$condetion = "`groups`.`idStudent` ='$id'";
			$unread = "`msg`.`gId`='{group}' AND `msg`.`mSeen` ='0'";
			$guid = "idStudent";
		}
		$response = $data->fetchCon( $table, $condetion )->fetchAll( PDO::FETCH_ASSOC );

		if ($response == null){
			$response['err_msg'] = "false";
		}
		else{
			for ($g = 0; $g < count($response); $g++) {
				$unreadMsg = $data->fetchCon('msg', str_replace('{group}',$response[$g]['gId'],$unread) );
				$groupPhoto =$data->getuser($response[$g][$guid]);

				$response[$g]['unread'] = $unreadMsg->rowCount();
				$response[$g]['groupPhoto'] = $groupPhoto['uImage'];
			}
		}

		break;
	case 'getChat':
		//uid:16
		//groupId:4

		$u = $data->getuser($input['uid']);

		$type = $u['uType'];
		if ($type == 'Te') {
			$typeI = '`mSeenT`';
		} else if ($type == 'stu') {
			$typeI = '`mSeen`';
		} else {
			$typeI = '`mSeenS`';
		}

//		$group = base64_decode($input['group']);
		$groupId = $input['groupId'];
		$condetion = "`msg`.`gId`='$groupId'";

		$response = $data->fetchMessage($condetion, $groupId, $typeI)->fetchAll(PDO::FETCH_ASSOC);

		if ($response == null)
			$response['err_msg'] = "false";

		break;
	case 'insertMsg':
	//IP:recordMessage
	//uid: 16
	//groupId: 4
	//message:jkjkljlkjkl
		if(!isset($input['IP']) || $input['IP']!= "recordMessage"){
			exit();
		}

		$u = $data->getuser($input['uid']);

		$type = $u['uType'];
		if ($type == 'Te') {
			$typeI = '`mSeenT`';
		} else if ($type == 'stu') {
			$typeI = '`mSeen`';
		} else {
			$typeI = '`mSeenS`';
		}

		$date = date("y-m-d H:i:s");
		$groupId= $input['groupId'];
		$message= $input['message'];
		$userId= $u['uId'];

		$table = '`msg`';
		$name = $u['uFname'] ." ". $u['uLname'];

		$value = array(
			"$message",
			"$groupId",
			"$userId",
			"$date",
			"1",
			"$name"
		);

		$data->insertData($typeI,$table, $value);

		exit();
//		if (!empty($response['error']))
//			$response = array('err_msg'=>$response['error']);
		break;
	case 'insertAttachment':

		break;
	case 'deleteMsg':
		//msgId:95
		$response = $data->deleteMsgUser($input['msgId']);

		if (empty($response['done']))
			$response = array('err_msg'=>"false");
		break;
	case 'makeSeen':
		$u = $data->getuser($input['uid']);

		$type = $u['uType'];
		if ($type == 'Te') {
			$typeI = '`mSeenT`';
		} else if ($type == 'stu') {
			$typeI = '`mSeen`';
		} else {
			$typeI = '`mSeenS`';
		}

		$groupId = $input['groupId'];
		$response = $data->makeSeen($typeI,$groupId);
		break;

	case 'resetPassword':

		break;
	case 'getUserThumb':

		break;

	case 'saveProfile':

		break;
	case 'getProfile':

		break;

}

header('Content-Type: application/json');
print json_encode( $response );

////////////////////////////////////////////////////////////////////////////////////////////////////////

//todo
//***on server***
//////////////last sync date time in [device] table
//push notification
//reset sync on error
//
//***on device***
///////////////last update date time in every row
///////////////last sync date time in app cache
///////////////getNoneSyncData = last updated rows > last sync date time
//push notification
///////////////reset sync on error
//عند حفظ جلسة جديده: هل تريد تعديل تاريخ الجلسة القادمة لهذه القضيه؟
//عند تغيير تاريخ الجلسة القادمة: هل تريد إضافة جلسة جديدة؟

//header('Content-Length: ' . ob_get_length()); // send header
ob_end_flush();
?>