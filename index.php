<!DOCTYPE html>
<?php
include_once './db_connect.php';
include_once './functions.php';
sec_session_start();
if (login_check() == true) {
?>
<html>
    <?php
    include_once './structure_head.php';
    ?>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <?php
            include_once './structure_main_header.php';
            include_once './structure_main_sidebar.php';
            ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                      
                    </div>
                    <!-- /.row -->
                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->

                        <!-- /.Left col -->
                        <!-- right col (We are only adding the ID to make the widgets sortable)-->

                        <!-- right col -->
                    </div>


                    <!-- /.row (main row) -->

                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <?php
            include_once './structure_footer.php';
            ?>

            <!-- Control Sidebar -->
            <?php
            include_once './structure_ControlSidebar.php';
            ?>
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->
        <?php
        include_once './structure_scriptJS.php';
        ?>

    </body>
</html>
<?php 
}else {
    ?>
    <script>window.location.href = 'login.php';</script>
    <?php
}
?>