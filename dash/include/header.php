<!DOCTYPE html>
<html lang="en">
<?php
$url =  (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST']
  . $_SERVER['REQUEST_URI'] . "";
$rr = parse_url($url, PHP_URL_PATH);
$rr = explode("/", $rr);
$rr = ucfirst(end($rr));
// $rr = end(explode("/", $rr));
$rr = str_replace('.php', '', $rr);

//define('base_url', 'http://localhost/chat/dash/');
//define('base_urld', 'http://localhost/chat/');



?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo ($rr == "" ? "Homepage" : $rr) ?></title>
  
  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css" integrity="sha256-FdatTf20PQr/rWg+cAKfl6j4/IY3oohFAJ7gVC3M34E=" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
  <link rel="stylesheet" href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css">



  <link rel="stylesheet" href="<?php echo base_url ?>dash/assets/vendor/css/font.css">
  <link rel="stylesheet" href="<?php echo base_url ?>dash/assets/vendor/css/font2.css">
  <link rel="stylesheet" href="<?php echo base_url ?>dash/assets/vendor/css/bootstrap.css">
  <link rel="stylesheet" href="<?php echo base_url ?>dash/assets/vendor/css/font-awesome-all.css">
  <link rel="stylesheet" href="<?php echo base_url ?>dash/assets/vendor/css/twitter-bootstrap.css">
  <link rel="stylesheet" href="<?php echo base_url ?>dash/assets/vendor/css/jquery-confirm.css">



  <link rel="stylesheet" href="<?php echo base_url ?>dash/assets/css/util.css">
  <link rel="stylesheet" href="<?php echo base_url ?>dash/assets/css/main.css">
  <link rel="stylesheet" href="<?php echo base_url ?>dash/assets/css/side.css">
  <link rel="stylesheet" href="<?php echo base_url ?>dash/assets/css/index.css">
  <link rel="stylesheet" href="<?php echo base_url ?>dash/assets/css/custom.css">
</head>

<body>