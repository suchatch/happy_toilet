<?php
include_once './db_connect.php';
include_once './functions.php';
sec_session_start();
if (login_check() == true) {
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
                        <small>summary</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Tables</a></li>
                        <li class="active">Report</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Table Summary </h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <form id="confirm" name = "confirm" method="get" action = "TableSummaryVoteIssue.php" autocomplete="off">
                                        <div class="row">

                                            <div class="col-md-3">
                                                <!-- Date -->
                                                <div class="form-group">
                                                    <label>ช่วงวันที่:</label>

                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" class="form-control pull-right" name="dtStart" data-date-format='dd-mm-yyyy' id="dtStart" value="<?= iif($_GET['dtStart'], $_GET['dtStart'], date('d-m-Y')); ?>">
                                                    </div>
                                                    <!-- /.input group -->

                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <!-- Date -->
                                                <div class="form-group">
                                                    <label>ถึงวันที่:</label>

                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" class="form-control pull-right" name="dtEnd" data-date-format='dd-mm-yyyy' id="dtEnd" value="<?= iif($_GET['dtEnd'], $_GET['dtEnd'], date('d-m-Y')); ?>">
                                                    </div>
                                                    <!-- /.input group -->

                                                </div>
                                            </div>


                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>ค้นหา:</label>
                                                    <button type="button" class="btn btn-block btn-success"  onclick="checkData()">ค้นหา</button>
                                                </div>

                                            </div>


                                        </div>
                                    </form>

                                    <?php
                                    $dtStartStr = date('d F Y', strtotime($_GET['dtStart']));
                                    $dtEndStr = date('d F Y', strtotime($_GET['dtEnd']));
                                    if ($_GET['dtStart']) {
                                        if ($_GET['dtStart'] == $_GET['dtEnd']) {
                                            echo "<h3 class=box-title>รายงานวันที่ " . $dtStartStr . "</h3>";
                                        } else {
                                            echo "<h3 class=box-title>รายงานวันที่ " . $dtStartStr . " - " . $dtEndStr . "</h3>";
                                        }
                                    }
                                    
                                    if($dtStartStr!= '01 January 1970'){
                                    ?>
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>พื้นที่</th>
                                                <th>ดีมาก</th>
                                                <th>ดี</th>
                                                <th>พอใช้</th>
                                                <th>ควรปรับปรุง</th>
                                                <th>ถุงขยะเต็ม</th>
                                                <th>การบริการของพนักงานแม่บ้าน</th>
                                                <th>สบู่หมด กระดาษชำระหมด</th>
                                                <th>ห้องน้ำมีกลิ่น</th>
                                                <th>ห้องน้ำไม่สะอาด พื้น อ่างล้างมือ โถซักโครก</th>
                                                <th>อุปกรณ์ชำรุด สายฉีดชำระ โถซักโครก โถฉี่ หัวก็อก</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $dtStart = date('Y-m-d', strtotime($_GET['dtStart']));
                                            $dtEnd = date('Y-m-d', strtotime($_GET['dtEnd']));
                                            $sql = "SELECT RM_RoomID,RM_RoomName," .
                                                    "(select count(*) from tb_vote_result Where tb_vote_result.RM_RoomID = tb_room.RM_RoomID and `tb_vote_result`.`VD_VoteID` = 1 and `tb_vote_result`.`VR_CreateDate` BETWEEN '$dtStart 00:00:00' AND '$dtEnd 23:59:59') AS Vote1," .
                                                    "(select count(*) from tb_vote_result Where tb_vote_result.RM_RoomID = tb_room.RM_RoomID and `tb_vote_result`.`VD_VoteID` = 2 and `tb_vote_result`.`VR_CreateDate` BETWEEN '$dtStart 00:00:00' AND '$dtEnd 23:59:59') AS Vote2," .
                                                    "(select count(*) from tb_vote_result Where tb_vote_result.RM_RoomID = tb_room.RM_RoomID and `tb_vote_result`.`VD_VoteID` = 3 and `tb_vote_result`.`VR_CreateDate` BETWEEN '$dtStart 00:00:00' AND '$dtEnd 23:59:59') AS Vote3," .
                                                    "(select count(*) from tb_vote_result Where tb_vote_result.RM_RoomID = tb_room.RM_RoomID and `tb_vote_result`.`VD_VoteID` = 4 and `tb_vote_result`.`VR_CreateDate` BETWEEN '$dtStart 00:00:00' AND '$dtEnd 23:59:59') AS Vote4," .
                                                    "(select count(*) from tb_issue_result Where tb_issue_result.RM_RoomID = tb_room.RM_RoomID and `tb_issue_result`.`IS_IssueID` = 1 and `tb_issue_result`.`SR_CreateDate` BETWEEN '$dtStart 00:00:00' AND '$dtEnd 23:59:59') AS Issue1," .
                                                    "(select count(*) from tb_issue_result Where tb_issue_result.RM_RoomID = tb_room.RM_RoomID and `tb_issue_result`.`IS_IssueID` = 2 and `tb_issue_result`.`SR_CreateDate` BETWEEN '$dtStart 00:00:00' AND '$dtEnd 23:59:59') AS Issue2," .
                                                    "(select count(*) from tb_issue_result Where tb_issue_result.RM_RoomID = tb_room.RM_RoomID and `tb_issue_result`.`IS_IssueID` = 3 and `tb_issue_result`.`SR_CreateDate` BETWEEN '$dtStart 00:00:00' AND '$dtEnd 23:59:59') AS Issue3," .
                                                    "(select count(*) from tb_issue_result Where tb_issue_result.RM_RoomID = tb_room.RM_RoomID and `tb_issue_result`.`IS_IssueID` = 4 and `tb_issue_result`.`SR_CreateDate` BETWEEN '$dtStart 00:00:00' AND '$dtEnd 23:59:59') AS Issue4," .
                                                    "(select count(*) from tb_issue_result Where tb_issue_result.RM_RoomID = tb_room.RM_RoomID and `tb_issue_result`.`IS_IssueID` = 5 and `tb_issue_result`.`SR_CreateDate` BETWEEN '$dtStart 00:00:00' AND '$dtEnd 23:59:59') AS Issue5," .
                                                    "(select count(*) from tb_issue_result Where tb_issue_result.RM_RoomID = tb_room.RM_RoomID and `tb_issue_result`.`IS_IssueID` = 6 and `tb_issue_result`.`SR_CreateDate` BETWEEN '$dtStart 00:00:00' AND '$dtEnd 23:59:59') AS Issue6 " .
                                                    " From `tb_room` order by RM_RoomName;";
                                            if ($stmt = $mysqli_asset->prepare($sql)) {
                                                $stmt->execute();
                                                $stmt->bind_result($RM_RoomID, $RM_RoomName, $Vote1, $Vote2, $Vote3, $Vote4, $Issue1, $Issue2, $Issue3, $Issue4, $Issue5, $Issue6);
                                            }


                                            while ($stmt->fetch()) {
                                                ?>
                                                <tr>
                                                    <td><?= $RM_RoomName; ?></td>
                                                    <td><?= $Vote1; ?></td>
                                                    <td><?= $Vote2; ?></td>
                                                    <td><?= $Vote3; ?></td>
                                                    <td><?= $Vote4; ?></td>
                                                    <td><?= $Issue1; ?></td>
                                                    <td><?= $Issue2; ?></td>
                                                    <td><?= $Issue3; ?></td>
                                                    <td><?= $Issue4; ?></td>
                                                    <td><?= $Issue5; ?></td>
                                                    <td><?= $Issue6; ?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th width="10%">พื้นที่</th>
                                                <th>ดีมาก</th>
                                                <th>ดี</th>
                                                <th>พอใช้</th>
                                                <th>ควรปรับปรุง</th>
                                                <th>ถุงขยะเต็ม</th>
                                                <th>การบริการของพนักงานแม่บ้าน</th>
                                                <th>สบู่หมด กระดาษชำระหมด</th>
                                                <th>ห้องน้ำมีกลิ่น</th>
                                                <th>ห้องน้ำไม่สะอาด พื้น อ่างล้างมือ โถซักโครก</th>
                                                <th>อุปกรณ์ชำรุด สายฉีดชำระ โถซักโครก โถฉี่ หัวก็อก</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <?php
                                    }
                                    ?>
                                </div>
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
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 2.4.0
                </div>
                <strong>PCS Security and Facility Services</strong>
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Create the tabs -->
                <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                    <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
                    <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- Home tab content -->
                    <div class="tab-pane" id="control-sidebar-home-tab">
                        <h3 class="control-sidebar-heading">Recent Activity</h3>
                        <ul class="control-sidebar-menu">
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                                        <p>Will be 23 on April 24th</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon fa fa-user bg-yellow"></i>

                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                                        <p>New phone +1(800)555-1234</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                                        <p>nora@example.com</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon fa fa-file-code-o bg-green"></i>

                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                                        <p>Execution time 5 seconds</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <!-- /.control-sidebar-menu -->

                        <h3 class="control-sidebar-heading">Tasks Progress</h3>
                        <ul class="control-sidebar-menu">
                            <li>
                                <a href="javascript:void(0)">
                                    <h4 class="control-sidebar-subheading">
                                        Custom Template Design
                                        <span class="label label-danger pull-right">70%</span>
                                    </h4>

                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <h4 class="control-sidebar-subheading">
                                        Update Resume
                                        <span class="label label-success pull-right">95%</span>
                                    </h4>

                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <h4 class="control-sidebar-subheading">
                                        Laravel Integration
                                        <span class="label label-warning pull-right">50%</span>
                                    </h4>

                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <h4 class="control-sidebar-subheading">
                                        Back End Framework
                                        <span class="label label-primary pull-right">68%</span>
                                    </h4>

                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <!-- /.control-sidebar-menu -->

                    </div>
                    <!-- /.tab-pane -->
                    <!-- Stats tab content -->
                    <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
                    <!-- /.tab-pane -->
                    <!-- Settings tab content -->
                    <div class="tab-pane" id="control-sidebar-settings-tab">
                        <form method="post">
                            <h3 class="control-sidebar-heading">General Settings</h3>

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Report panel usage
                                    <input type="checkbox" class="pull-right" checked>
                                </label>

                                <p>
                                    Some information about this general settings option
                                </p>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Allow mail redirect
                                    <input type="checkbox" class="pull-right" checked>
                                </label>

                                <p>
                                    Other sets of options are available
                                </p>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Expose author name in posts
                                    <input type="checkbox" class="pull-right" checked>
                                </label>

                                <p>
                                    Allow the user to show his name in blog posts
                                </p>
                            </div>
                            <!-- /.form-group -->

                            <h3 class="control-sidebar-heading">Chat Settings</h3>

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Show me as online
                                    <input type="checkbox" class="pull-right" checked>
                                </label>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Turn off notifications
                                    <input type="checkbox" class="pull-right">
                                </label>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Delete chat history
                                    <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                                </label>
                            </div>
                            <!-- /.form-group -->
                        </form>
                    </div>
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
        <script src="bower_components/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- DataTables -->
        <script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <!-- SlimScroll -->
        <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="bower_components/fastclick/lib/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="dist/js/demo.js"></script>
        <!-- page script -->


        <!-- Select2 -->
        <script src="bower_components/select2/dist/js/select2.full.min.js"></script>
        <!-- InputMask -->
        <script src="plugins/input-mask/jquery.inputmask.js"></script>
        <script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
        <script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
        <!-- date-range-picker -->
        <script src="bower_components/moment/min/moment.min.js"></script>
        <script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
        <!-- bootstrap datepicker -->
        <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        <!-- bootstrap color picker -->
        <script src="bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
        <!-- bootstrap time picker -->
        <script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
        <!-- SlimScroll -->
        <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <!-- iCheck 1.0.1 -->
        <script src="plugins/iCheck/icheck.min.js"></script>
        <!-- FastClick -->
        <script src="bower_components/fastclick/lib/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="dist/js/demo.js"></script>
        <script>
                                                        function checkData() {
                                                            result = "DataOk";
                                                            if (document.getElementById("dtStart").value == "") {
                                                                alert("กรุณาใส่ วันที่เริ่ม");
                                                                result = "NotOK";
                                                            }

                                                            if (document.getElementById("dtEnd").value == "") {
                                                                alert("กรุณาใส่ วันที่สิ้นสุด");
                                                                result = "NotOK";
                                                            }

                                                            if (result == "DataOk") {
                                                                document.getElementById("confirm").submit();
                                                            }


                                                        }
                                                        $(function () {
                                                            $('#example1').DataTable()
                                                            $('#example2').DataTable({
                                                                'paging': true,
                                                                'lengthChange': false,
                                                                'searching': false,
                                                                'ordering': true,
                                                                'info': true,
                                                                'autoWidth': false
                                                            })
                                                        })

                                                        $(function () {
                                                            //Initialize Select2 Elements
                                                            $('.select2').select2()

                                                            //Datemask dd/mm/yyyy
                                                            $('#datemask').inputmask('dd/mm/yyyy', {'placeholder': 'dd/mm/yyyy'})
                                                            //Datemask2 mm/dd/yyyy
                                                            $('#datemask2').inputmask('mm/dd/yyyy', {'placeholder': 'mm/dd/yyyy'})
                                                            //Money Euro
                                                            $('[data-mask]').inputmask()

                                                            //Date range picker
                                                            $('#reservation').daterangepicker()


                                                            //Date range picker with time picker
                                                            $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'})
                                                            //Date range as a button
                                                            $('#daterange-btn').daterangepicker(
                                                                    {
                                                                        ranges: {
                                                                            'Today': [moment(), moment()],
                                                                            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                                                                            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                                                                            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                                                                            'This Month': [moment().startOf('month'), moment().endOf('month')],
                                                                            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                                                                        },
                                                                        startDate: moment().subtract(29, 'days'),
                                                                        endDate: moment()
                                                                    },
                                                                    function (start, end) {
                                                                        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
                                                                    }
                                                            )

                                                            //Date picker
                                                            $('#dtStart').datepicker({
                                                                autoclose: true
                                                            })
                                                            $('#dtEnd').datepicker({
                                                                autoclose: true
                                                            })


                                                            //iCheck for checkbox and radio inputs
                                                            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                                                                checkboxClass: 'icheckbox_minimal-blue',
                                                                radioClass: 'iradio_minimal-blue'
                                                            })
                                                            //Red color scheme for iCheck
                                                            $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                                                                checkboxClass: 'icheckbox_minimal-red',
                                                                radioClass: 'iradio_minimal-red'
                                                            })
                                                            //Flat red color scheme for iCheck
                                                            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                                                                checkboxClass: 'icheckbox_flat-green',
                                                                radioClass: 'iradio_flat-green'
                                                            })

                                                            //Colorpicker
                                                            $('.my-colorpicker1').colorpicker()
                                                            //color picker with addon
                                                            $('.my-colorpicker2').colorpicker()

                                                            //Timepicker
                                                            $('.timepicker').timepicker({
                                                                showInputs: false
                                                            })
                                                        })
        </script>
    </body>
</html>
<?php 
}else {
    ?>
    <script>window.location.href = 'login.php';</script>
    <?php
}
?>