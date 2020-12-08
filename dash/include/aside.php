
<div class="page-wrapper chiller-theme toggled">
  <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
    <i class="fas fa-bars"></i>
  </a>
  <nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
      <div class="sidebar-brand">
        <a href="<?php echo base_url?>dash">CPanal</a>
        <div id="close-sidebar">
          <i class="fas fa-times"></i>
        </div>
      </div>
      <div class="sidebar-header">
        <div class="user-pic">
          <i class="fa fa-user-circle" aria-hidden="true"></i>
        </div>
        <div class="user-info">
          <span class="user-name">
            <?php echo$_SESSION['user']?>
          </span>
          <span class="user-role">Administrator</span>
          <span class="user-status">
            <i class="fa fa-circle"></i>
            <span>Online</span>
          </span>
        </div>
      </div>
      
      <div class="sidebar-menu">
        <ul>
          <li class="header-menu">
            <span>Quick links</span>
            
          </li>
          <li class="sidebar-dropdown">
            <a href="<?php echo base_url."dash/pages"?>">
              <i class="fa fa-tachometer-alt"></i>
              <span>Dashboard</span>
              <span class="badge badge-pill badge-warning">New</span>
            </a>
          </li>
          <li class="sidebar-dropdown">
            <a href="javascript:;">
          <i class="fa fa-user-circle" aria-hidden="true"></i>
              <span>Add User</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                <li>
                  <a href="<?php echo base_url."dash/pages/add?teacher";?>">Teacher</a>
                </li>
                <li>
                  <a href="<?php echo base_url."dash/pages/add?student";?>">Student</a>
                </li>
                <li>
                  <a href="<?php echo base_url."dash/pages/add?supervisor";?>">Supervisor</a>
                </li>
                
                
              </ul>
            </div>
          </li>
          <li class="sidebar-dropdown">
            <a href="<?php echo base_url."dash/pages/add?family";?>">
            <i class="fa fa-user" aria-hidden="true"></i>
            <span>Add Family</span>
            </a>
          </li>
          <li class="sidebar-dropdown">
            <a href="<?php echo base_url."dash/pages/add?admin";?>">
            <i class="fa fa-lock" aria-hidden="true"></i>
            <span>Add Admin</span>
            </a>
          </li>
          
          <li class="header-menu">
            <span>Extra</span>
          </li>
          <li>
            <a href="<?php echo base_url."dash/pages/student";?>">
              <i class="fa fa-book"></i>
              <span>Students / family</span>
            </a>
          </li>
          <li>
            <a href="<?php echo base_url."dash/pages/teacher";?>">
              <i class="fa fa-calendar"></i>
              <span>Teachers</span>
            </a>
          </li>
          <li>
            <a href="<?php echo base_url."dash/pages/supervisor";?>">
              <i class="fa fa-calendar"></i>
              <span>Supervisor</span>
            </a>
          </li>
          <li>
            <a href="<?php echo base_url."dash/pages/groups";?>">
              <i class="fa fa-folder"></i>
              <span>Groups</span>
            </a>
          </li>
          <li>
            <a href="<?php echo base_url."dash/pages/problems";?>">
              <i class="fa fa-folder"></i>
              <span>problems</span>
            </a>
          </li>
          <li>
          <?php 
            if ($_SESSION['idAdmin'] == 1){
          ?>
            <a href="<?php echo base_url."dash/pages/admin";?>">
              <i class="fa fa-folder"></i>
              <span>Admin</span>
            </a>
            <?php }?>
          </li>
        </ul>
      </div>
      <!-- sidebar-menu  -->
    </div>
    <!-- sidebar-content  -->
    <div class="sidebar-footer">
      <!-- <a href="#">
        <i class="fa fa-bell"></i>
        <span class="badge badge-pill badge-warning notification">3</span>
      </a>
      <a href="#">
        <i class="fa fa-envelope"></i>
        <span class="badge badge-pill badge-success notification">7</span>
      </a> -->
      <a href="<?php echo base_url.'dash/pages/logout'?>">
        <i class="fa fa-power-off"></i>
      </a>
    </div>
  </nav>
  <!-- sidebar-wrapper  -->
  
  
  <main class="page-content">
    
    <div class="container-fluid">
      
    

    