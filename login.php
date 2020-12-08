<?php
session_start();
ob_start();
if (isset($_SESSION['chatUserLogin']) && $_SESSION['chatUserLogin'] === true) {
  header("location: pages/");
}
include_once "config.php";

require 'include/header.php';
?>

<div class="limiter">
  <div class="container-login100">
    <div class="wrap-login100">
      <div class="login100-pic js-tilt" data-tilt>
        <img src="assets/img/img-01.png" alt="IMG">
      </div>
      <form class="login100-form validate-form" method="post">
        <span class="login100-form-title">
          Member Login
        </span>

        <?php
        if (isset($_POST['login'])) {
	      include "oper/data.php";
          $data = new Data();
	        $u = $data->login($_POST['email'], $_POST['pass']);
	        if (!empty($u)) {
		        if ($u['uStatus'] != 1) {
			        echo '<div class="alert alert-danger rounded-pill">Sorry, your account not active <b>call Admin</b></div>';
		        } else {
			        $_SESSION['userChatId']       = $u['uId'];
			        $_SESSION['userChatFname']    = $u['uFname'];
			        $_SESSION['userChatLname']    = $u['uLname'];
			        $_SESSION['userChatGender']   = $u['uGender'];
			        $_SESSION['userChatType']     = $u['uType'];
			        $_SESSION['userChatPhone']    = $u['uPhone'];
			        $_SESSION['userChatUrl']      = $u['uUrl'];
			        $_SESSION['userChatZoom']     = $u['uZoom'];
			        $_SESSION['userChatTid']      = $u['tId'];
			        $_SESSION['userChatImage']    = $u['uImage'];
			        $_SESSION['userChatActive']   = $u['uActive'];
			        $_SESSION['userChatStatus']   = $u['uStatus'];
			        $_SESSION['userChatEmail']    = $u['uEmail'];
			        $_SESSION['userChatPassword'] = $u['uPassword'];
			        $_SESSION['chatUserLogin']    = true;
			        header("Refresh:1; url=pages");
			        echo '<div class="alert alert-success rounded-pill">login successfully</div>';
		        }
	        } else {
		        echo '<div class="alert alert-danger rounded-pill">email or password incorrect</div>';
	        }

        }
        ?>
        <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
          <input class="input100" type="text" name="email" placeholder="Email">
          <span class="focus-input100"></span>
          <span class="symbol-input100">
            <i class="fa fa-envelope" aria-hidden="true"></i>
          </span>
        </div>

        <div class="wrap-input100 validate-input" data-validate="Password is required">
          <input class="input100" type="password" name="pass" placeholder="Password">
          <span class="focus-input100"></span>
          <span class="symbol-input100">

            <i class="fa fa-lock" aria-hidden="true"></i>
          </span>
        </div>

        <div class="container-login100-form-btn mb-5">
          <button type="submit" name="login" class="login100-form-btn">
            Login
          </button>
        </div>
      </form>
    </div>
  </div>
</div>







<script src="<?php echo base_url ?>assets/vendor/js/jquery.js"></script>
<script src="<?php echo base_url ?>assets/vendor/js/popper.js"></script>
<script src="<?php echo base_url ?>assets/vendor/js/bootstrap.js"></script>

<script src="assets/vendor/tilt/tilt.jquery.min.js"></script>

<script src="<?php echo base_url ?>assets/js/main.js"></script>
<script src="<?php echo base_url ?>assets/js/index.js"></script>

</body>

</html>