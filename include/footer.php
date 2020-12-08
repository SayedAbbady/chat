
<script src="<?php echo base_url ?>assets/vendor/js/jquery-confirm.js"></script>
<script src="<?php echo base_url ?>assets/vendor/js/popper.js"></script>
<script src="<?php echo base_url ?>assets/vendor/js/bootstrap.js"></script>
<script src="<?php echo base_url ?>assets/vendor/js/emo.js"></script>
<script>
    var id = <?php echo $_SESSION['userChatId'] ?>;
    var userName = "<?php echo $_SESSION['userChatFname'] . " " . $_SESSION['userChatLname'] ?>";
    var base_url = "<?php echo base_url ?>";
</script>

<script src="<?php echo base_url ?>assets/js/index.js"></script>
<script src="<?php echo base_url ?>assets/js/ajax.js"></script>
<script src="<?php echo base_url ?>assets/js/socket.js"></script>
<script>
    
</script>
</body>

</html>