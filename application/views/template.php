<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SIAKAD SMAN 14 Tebo | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">

  <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">

      <!-- Logo -->
      <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>SIAKAD</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>SIAKAD</b> SMAN 14</span>
      </a>

      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigasi</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?php echo base_url(); ?>assets/dist/img/aaa.png" class="user-image" alt="User Image">
                <span class="hidden-xs"><?php echo $this->session->userdata('nama_lengkap'); ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="<?php echo base_url(); ?>assets/dist/img/aaa.png" class="img-circle" alt="User Image">

                  <p>
                    <?php echo $this->session->userdata('nama_lengkap'); ?>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <!--<div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div> -->
                  <div class="text-center">

                    <?php
                    echo anchor('auth/logout', '<button class="btn btn-danger btn-flat">Keluar</button>');
                    ?>

                  </div>
                </li>
              </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
            <li>
              <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
            </li>

          </ul>
        </div>

      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="<?php echo base_url(); ?>assets/dist/img/aaa.png" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p><?php echo $this->session->userdata('nama_lengkap'); ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
          <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                <i class="fa fa-search"></i>
              </button>
            </span>
          </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">Menu</li>

          <!-- menu dinamis -->

          <?php
          $id_level_user = $this->session->userdata('id_level_user');

          $sql_menu = "SELECT * FROM `tabel_menu` WHERE id IN(SELECT id_menu FROM tbl_user_rule WHERE id_level_user = $id_level_user) AND is_main_menu = 0";

          $main_menu  = $this->db->query($sql_menu)->result();

          foreach ($main_menu as $main) {
            // check apakah memiliki submenu?
            $submenu  = $this->db->get_where('tabel_menu', array('is_main_menu' => $main->id));

            if ($submenu->num_rows() > 0) {
              //submenu true
              echo "<li class='treeview'>" . anchor($main->link, "<i class='" . $main->icon . "'></i>" .
                "<span>" . $main->nama_menu . "</span>" .
                '<span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                   </span>');

              //submenunya disini
              echo "<ul class='treeview-menu'>";

              foreach ($submenu->result() as $sub) {
                echo "<li>" . anchor($sub->link, "<i class='" . $sub->icon . "'></i>" . "<span>" . $sub->nama_menu . "</span>") . "</li>";
              }

              echo "</ul></li>";
            } else {
              //submenu false dan main menu true
              echo "<li>" . anchor($main->link, "<i class='" . $main->icon . "'></i>" . "<span>" . $main->nama_menu . "</span>") . "</li>";
            }
          }

          // tanpa pembatasan hak akses menu
          // $main_menu  = $this->db->get_where('tabel_menu', array('is_main_menu' => 0))->result();

          // foreach ($main_menu as $main) {
          //     // check apakah memiliki submenu?
          //     $submenu  = $this->db->get_where('tabel_menu', array('is_main_menu' => $main->id));

          //     if ($submenu->num_rows()>0) {
          //       //submenu true
          //       echo "<li class='treeview'>".anchor($main->link,"<i class='".$main->icon."'></i>".
          //            "<span>".$main->nama_menu."</span>".
          //            '<span class="pull-right-container">
          //               <i class="fa fa-angle-left pull-right"></i>
          //            </span>');

          //       //submenunya disini
          //       echo "<ul class='treeview-menu'>";

          //       foreach ($submenu->result() as $sub) {
          //         echo "<li>" .anchor($sub->link,"<i class='".$sub->icon."'></i>"."<span>".$sub->nama_menu."</span>"). "</li>";
          //       }

          //       echo "</ul></li>";
          //     } else {
          //       //submenu false dan main menu true
          //       echo "<li>" .anchor($main->link,"<i class='".$main->icon."'></i>"."<span>".$main->nama_menu."</span>"). "</li>";
          //     }  
          // }

          ?>
          <!-- end menu dinamis -->

        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Dashboard
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
          <li class="active">Dashboard</li>
        </ol>
      </section>

      <!-- Main content -->
      <?php echo $contents; ?>
      <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Versi</b> 1.1.0
      </div>
      <strong>Copyright &copy; Recka 2024</a>.</strong> All rights
      reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Create the tabs -->
      <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"></a></li>
      </ul>
      <!-- Tab panes -->
      <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane" id="control-sidebar-home-tab">
          <h3 class="control-sidebar-heading">Recent Activity</h3>
          <ul class="control-sidebar-menu">
          </ul>
        </div>
        <!-- /.tab-pane -->

        <!-- Settings tab content -->
        <!-- /.tab-pane -->
      </div>
    </aside>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>

  </div>
  <!-- ./wrapper -->

  <!-- jQuery 3 -->
  <!-- <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script> -->
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url(); ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
  <!-- Sparkline -->
  <script src="<?php echo base_url(); ?>assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
  <!-- jvectormap  -->
  <script src="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <!-- SlimScroll -->
  <script src="<?php echo base_url(); ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- ChartJS -->
  <script src="<?php echo base_url(); ?>assets/bower_components/Chart.js/Chart.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="<?php echo base_url(); ?>assets/dist/js/pages/dashboard2.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>

</body>

</html>