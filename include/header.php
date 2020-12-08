<!DOCTYPE html>
<html lang="en">
<?php
header('Access-Control-Allow-Origin: *');
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Eaalim chat </title>
  <link rel="icon" type="image/png" href="<?php echo base_url; ?>assets/img/icons/favicon.ico" />

  <link rel="stylesheet" href="<?php echo base_url ?>assets/vendor/css/font.css">
  <link rel="stylesheet" href="<?php echo base_url ?>assets/vendor/css/font2.css">
  <link rel="stylesheet" href="<?php echo base_url ?>assets/vendor/css/bootstrap.css">
  <link rel="stylesheet" href="<?php echo base_url ?>assets/vendor/css/font-awesome-all.css">
  <link rel="stylesheet" href="<?php echo base_url ?>assets/vendor/css/twitter-bootstrap.css">
  <link rel="stylesheet" href="<?php echo base_url ?>assets/vendor/css/jquery-confirm.css">

  <!-- <link rel="stylesheet" href="<?php echo base_url ?>assets/css/util.css"> -->
  <link rel="stylesheet" href="<?php echo base_url ?>assets/css/main.css">
  <!-- <link rel="stylesheet" href="<?php echo base_url ?>assets/css/emojyplugin.css"> -->
  <link rel="stylesheet" href="<?php echo base_url ?>assets/css/index.css">

  <link rel="stylesheet" href="<?php echo base_url ?>assets/vendor/emoji/css/jquery.emojipicker.css">

  <script src="<?php echo base_url ?>assets/vendor/js/jquery.js"></script>

  <script src="<?php echo base_url ?>assets/vendor/emoji/js/jquery.emojipicker.js"></script>
  <script src="<?php echo base_url ?>assets/vendor/emoji/js/jquery.emojis.js"></script>
  <link rel="stylesheet" href="<?php echo base_url ?>assets/vendor/emoji/css/jquery.emojipicker.a.css">


  <script src="<?php echo base_url ?>assets/vendor/js/sockets.js"></script>

  <script>
    var userId = <?php echo $_SESSION['userChatId'] ?>;
    var conn = io.connect('<?php echo socket_url?>', {
      query: 'userId=' + userId
    });
  </script>
</head>

<body>
  <audio id="1">
    <source src="<?php echo base_url ?>assets/sounds/1.ogg" type="audio/ogg">
    <source src="<?php echo base_url ?>assets/sounds/1.mp3" type="audio/ogg">
    Your browser does not support the audio element.
  </audio>
  <?php
  $ip = '197.53.254.147'; 
  //$ip = $_SERVER['REMOTE_ADDR']; 
  //"197.53.254.147"; //$_SERVER['REMOTE_ADDR'];
  $ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
  $ipInfo = json_decode($ipInfo);
  // var_dump($ipInfo);
  $timezone = $ipInfo->timezone;
  date_default_timezone_set($timezone);

  ?>