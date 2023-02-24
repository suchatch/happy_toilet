<?php
include_once './db_connect.php';
include_once './functions.php';
sec_session_start();
?>
<!DOCTYPE html>
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
                        Data Tables
                        <small>advanced tables</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Tables</a></li>
                        <li class="active">Data tables</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Product Detail</h3>
                                </div>
<!--                                 /.box-header 
                                <div class="box-body">
                                   
                                </div>-->
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
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
