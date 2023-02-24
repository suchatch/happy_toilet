<?php
include_once './db_connect.php';
include_once './functions.php';
sec_session_start();
if (login_check() == true) {
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
            <meta http-equiv=Content-Type content="text/html; charset=utf-8">
            <!-- Bootstrap 3.3.7 -->
            <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
            <!-- Font Awesome -->
            <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
            <!-- Ionicons -->
            <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
            <!-- daterange picker -->
            <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
            <!-- bootstrap datepicker -->
            <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
            <!-- iCheck for checkboxes and radio inputs -->
            <link rel="stylesheet" href="plugins/iCheck/all.css">
            <!-- Bootstrap Color Picker -->
            <link rel="stylesheet" href="bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
            <!-- Bootstrap time Picker -->
            <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
            <!-- Select2 -->
            <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
            <!-- Theme style -->
            <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
            <!-- AdminLTE Skins. Choose a skin from the css/skins
                 folder instead of downloading all of them to reduce the load. -->
            <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
            <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
            <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->

            <!-- Google Font -->
            <link rel="stylesheet"
                  href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        </head>
        <?php
//    include_once './structure_head.php';
        ?>



        <body class="hold-transition skin-blue sidebar-mini" onload="showDataRoomVote1()">
            <div class="wrapper">

                <?php
                include_once './structure_main_header.php';
                include_once './structure_main_sidebar.php';
                ?>


                <!-- END CSS for this page -->
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <section class="content-header">
                        <h1>
                            Report
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
                        <div class="container-fluid">
                            <form id="confirm" name = "confirm" method="get" action = "graphReport.php" autocomplete="off">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- Room -->
                                        <div class="box box-danger">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">รายงานแบบระบุช่วงวันที่</h3>

                                                <div class="box-tools pull-right">
                                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                            <div class="box-body">
                                                <!--Select Location Room-->
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>เพศ:</label>
                                                            <select id="selectRM_RoomSex" name="RM_RoomSex" class="form-control select2" onchange="getRoom(this.value)" style="width: 100%;">
                                                                <option value="" selected>โปรดเลือกประเภท ช/ญ</option>
                                                                <option value="M" >ชาย</option>
                                                                <option value="W" >หญิง</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>ห้อง:</label>
                                                            <div id="selectRoomDiv">
                                                                <?php
                                                                if ($stmt = $mysqli_asset->prepare("SELECT `RM_RoomID`,`RM_RoomName`,`RM_RoomSex` FROM tb_room ")) {
                                                          
                                                                $stmt->execute();
                                                                $stmt->bind_result($RM_RoomID,$RM_RoomName,$RM_RoomSex);
                                                                ?>

                                                                <select name="RM_RoomID" class="form-control select2" style="width: 100%;">
                                                                    <option value="">All</option>
                                                                    <?php
                                                                    while ($stmt->fetch()) {
                                                                        ?>
                                                                        <option value="<?= $RM_RoomID; ?>"><?= $RM_RoomName . " (" . $RM_RoomSex . ")"; ?></option>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                                <?php
                                                                $stmt->close();
                                                                }
                                                                ?>
                                                                </div>

                                                                </div>
                                                                </div>

                                                                <!--<div class = "col-md-2">
                                                                <div class = "form-group">
                                                                <label>ห้อง:</label>
                                                                <select name = "RM_RoomID" class = "form-control select2" style = "width: 100%;">
                                                                <option value = "" selected>ทุกพื้นที่</option>
                                                                <?php
                                                                $sqlCR = "Select RM_RoomID,RM_RoomName from `tb_room` where RM_RoomName <> '-'";
                                                                $rsCR = $mysqli_asset->query($sqlCR);
                                                                while ($rowCR = $rsCR->fetch_array()) {
                                                                    ?>
                                                                    <option <?= iif($_GET['RM_RoomID'] == $rowCR['RM_RoomID'], "Selected", ""); ?> value="<?= $rowCR['RM_RoomID']; ?>"><?= $rowCR['RM_RoomName']; ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                                </select>
                                                            </div>
                                                        </div>-->

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
                                                    ?>

                                                    <!-- /.form group -->
                                                    <!--</div>-->
                                                </div>
                                                <!-- /.box-body -->
                                            </div>
                                            <!-- /.box -->
                                        </div>
                                    </div>
                            </form>

                            <?php
                            if ($dtStartStr != '01 January 1970') {
                                $dtStart = date('Y-m-d', strtotime($_GET['dtStart']));
                                $dtEnd = date('Y-m-d', strtotime($_GET['dtEnd']));
                                if ($_GET['RM_RoomID']) {
                                    $sqlR = "Select RM_RoomID,RM_RoomName from `tb_room` where  RM_RoomName <> '-' and RM_RoomID = " . $_GET['RM_RoomID'];
                                } else if ($_GET['RM_RoomID'] == '') {
                                    $sqlR = "Select RM_RoomID,RM_RoomName from `tb_room` where  RM_RoomName <> '-' ";
                                }



                                $rsR = $mysqli_asset->query($sqlR);
                                while ($rowR = $rsR->fetch_array()) {
                                    //// Vote ////
                                    $Vote1 = 0;
                                    $Vote2 = 0;
                                    $Vote3 = 0;
                                    $Vote4 = 0;
                                    $sqlV = "SELECT `tb_volt`.`VD_VoltID`,`tb_volt`.`VD_VoltName`,count(*) as Vote FROM `tb_vote_result` LEFT JOIN `tb_volt` ON `tb_vote_result`.`VD_VoltID` = `tb_volt`.`VD_VoltID` WHERE `tb_vote_result`.`RM_RoomID` = " . $rowR['RM_RoomID'] . " AND `tb_vote_result`.`VR_CreateDate` BETWEEN '$dtStart 00:00:00' AND '$dtEnd 23:59:59'   Group By `tb_volt`.`VD_VoltID`";

                                    $rsV = $mysqli_asset->query($sqlV);
                                    while ($rowV = $rsV->fetch_array()) {
                                        switch ($rowV['VD_VoltID']) {
                                            case 1:
//                                    $VoteName1 = $row['VD_VoltName'];
                                                $Vote1 = $rowV['Vote'];
                                                break;
                                            case 2:
//                                    $VoteName2 = $row['VD_VoltName'];
                                                $Vote2 = $rowV['Vote'];
                                                break;
                                            case 3:
//                                    $VoteName3 = $row['VD_VoltName'];
                                                $Vote3 = $rowV['Vote'];
                                                break;
                                            case 4:
//                                    $VoteName4 = $row['VD_VoltName'];
                                                $Vote4 = $rowV['Vote'];
                                                break;
                                            default:
                                                echo "NO--";
                                        }
                                    }

                                    $VoteTotal = $Vote1 + $Vote2 + $Vote3 + $Vote4;
                                    $Vote1 = $Vote1 / $VoteTotal;
                                    $Vote2 = $Vote2 / $VoteTotal;
                                    $Vote3 = $Vote3 / $VoteTotal;
                                    $Vote4 = $Vote4 / $VoteTotal;

                                    //// Issue ////
                                    $Issue1 = 0;
                                    $Issue2 = 0;
                                    $Issue3 = 0;
                                    $Issue4 = 0;
                                    $Issue5 = 0;
                                    $Issue6 = 0;
                                    $sqlS = "SELECT `tb_issue`.`IS_IssueID`,`tb_issue`.`IS_IssueName`,count(*) as Issue FROM `tb_issue` LEFT JOIN `tb_issue_result` ON `tb_issue`.`IS_IssueID` = `tb_issue_result`.`IS_IssueID` Where `tb_issue_result`.`RM_RoomID` = " . $rowR['RM_RoomID'] . " AND `tb_issue_result`.`SR_CreateDate` BETWEEN '$dtStart 00:00:00' AND '$dtEnd 23:59:59'  group By `tb_issue`.`IS_IssueID`";
                                    $rsS = $mysqli_asset->query($sqlS);
                                    while ($rowS = $rsS->fetch_array()) {
                                        switch ($rowS['IS_IssueID']) {
                                            case 1:
//                                    $VoteName1 = $row['IS_IssueName'];
                                                $Issue1 = $rowS['Issue'];
                                                break;
                                            case 2:
//                                    $VoteName2 = $row['IS_IssueName'];
                                                $Issue2 = $rowS['Issue'];
                                                break;
                                            case 3:
//                                    $VoteName3 = $row['IS_IssueName'];
                                                $Issue3 = $rowS['Issue'];
                                                break;
                                            case 4:
//                                    $VoteName4 = $row['IS_IssueName'];
                                                $Issue4 = $rowS['Issue'];
                                                break;
                                            case 5:
//                                    $VoteName4 = $row['IS_IssueName'];
                                                $Issue5 = $rowS['Issue'];
                                                break;
                                            case 6:
//                                    $VoteName4 = $row['IS_IssueName'];
                                                $Issue6 = $rowS['Issue'];
                                                break;
                                            default:
                                                echo "NO--";
                                        }
                                    }

                                    $IssueTotal = $Issue1 + $Issue2 + $Issue3 + $Issue4 + $Issue5 + $Issue6;
                                    $Issue1 = $Issue1 / $IssueTotal;
                                    $Issue2 = $Issue2 / $IssueTotal;
                                    $Issue3 = $Issue3 / $IssueTotal;
                                    $Issue4 = $Issue4 / $IssueTotal;
                                    $Issue5 = $Issue5 / $IssueTotal;
                                    $Issue6 = $Issue6 / $IssueTotal;
                                    ?>

                                    <div hidden  id="Vote1Room<?= $rowR['RM_RoomID']; ?>"><?= number_format($Vote1 * 100, 0); ?></div>
                                    <div hidden  id="Vote2Room<?= $rowR['RM_RoomID']; ?>"><?= number_format($Vote2 * 100, 0); ?></div>
                                    <div hidden  id="Vote3Room<?= $rowR['RM_RoomID']; ?>"><?= number_format($Vote3 * 100, 0); ?></div>
                                    <div hidden  id="Vote4Room<?= $rowR['RM_RoomID']; ?>"><?= number_format($Vote4 * 100, 0); ?></div>

                                    <div hidden  id="Issue1Room<?= $rowR['RM_RoomID']; ?>"><?= number_format($Issue1 * 100, 0); ?></div>
                                    <div hidden  id="Issue2Room<?= $rowR['RM_RoomID']; ?>"><?= number_format($Issue2 * 100, 0); ?></div>
                                    <div hidden  id="Issue3Room<?= $rowR['RM_RoomID']; ?>"><?= number_format($Issue3 * 100, 0); ?></div>
                                    <div hidden  id="Issue4Room<?= $rowR['RM_RoomID']; ?>"><?= number_format($Issue4 * 100, 0); ?></div>
                                    <div hidden  id="Issue5Room<?= $rowR['RM_RoomID']; ?>"><?= number_format($Issue5 * 100, 0); ?></div>
                                    <div hidden  id="Issue6Room<?= $rowR['RM_RoomID']; ?>"><?= number_format($Issue6 * 100, 0); ?></div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- Room -->
                                            <div class="box box-danger">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title">คะแนนพื้นที่ <?= $rowR['RM_RoomName']; ?></h3>

                                                    <div class="box-tools pull-right">
                                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                                    </div>
                                                </div>
                                                <div class="box-body">
                                                    <!--<div class="chart">-->
                                                    <canvas id="ChartVoteRoom<?= $rowR['RM_RoomID']; ?>" style="height:3px"></canvas>
                                                    <!--</div>-->
                                                </div>
                                                <!-- /.box-body -->
                                            </div>
                                            <!-- /.box -->
                                        </div>
                                        <div class="col-md-6">
                                            <!-- ISSUE -->
                                            <div class="box box-success">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title">สาเหตุที่ไม่พึงพอใจ <?= $rowR['RM_RoomName']; ?></h3>

                                                    <div class="box-tools pull-right">
                                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                                    </div>
                                                </div>
                                                <div class="box-body">
                                                    <!--                                            <div class="chart">-->
                                                    <canvas id="ChartIssueRoom<?= $rowR['RM_RoomID']; ?>" style="height:3px"></canvas>
                                                    <!--</div>-->
                                                </div>
                                                <!-- /.box-body -->
                                            </div>
                                            <!-- /.box -->
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="row">
                                    <div class="box box-danger">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">คะแนนความพึงพอใจทุกพื้นที่</h3>

                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                                </button>
                                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <!--<div class="chart">-->
                                            <canvas id="barChartSummaryVote"></canvas>
                                            <!--</div>-->
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="box box-danger">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">สาเหตุที่ไม่พึงพอใจทุกพื้นที่</h3>

                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                                </button>
                                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <!--<div class="chart">-->
                                            <canvas id="barChartSummaryIssue"></canvas>
                                            <!--</div>-->
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                </div>
                                <?php
                            }
                            ?>










                        </div>

                        <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->
        </div>

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> 
        <link type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/south-street/jquery-ui.css" rel="stylesheet"> 
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

        <script>


                                                                function getXMLHTTP() { //fuction to return the xml http object
                                                                    var xmlhttp = false;
                                                                    try {
                                                                        xmlhttp = new XMLHttpRequest();
                                                                    } catch (e) {
                                                                        try {
                                                                            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                                                                        } catch (e) {
                                                                            try {
                                                                                xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                                                                            } catch (e1) {
                                                                                xmlhttp = false;
                                                                            }
                                                                        }
                                                                    }

                                                                    return xmlhttp;
                                                                }

                                                                function getRoom(RM_RoomSex) {

                                                                    var strURL = "findRoom.php?RM_RoomSex=" + RM_RoomSex;
                                                                    var req = getXMLHTTP();

                                                                    if (req) {
                                                                        document.getElementById("selectRoomDiv").innerHTML = "Loading...";
                                                                        req.onreadystatechange = function () {
                                                                            if (req.readyState == 4) {
                                                                                // only if "OK"
                                                                                if (req.status == 200) {
                                                                                    document.getElementById('selectRoomDiv').innerHTML = req.responseText;
                                                                                } else {
                                                                                    alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                                                                                }
                                                                            }
                                                                        };
                                                                        req.open("GET", strURL, true);
                                                                        req.send(null);
                                                                    }
                                                                }

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

                                                                function showDataRoom(RoomVote1, RoomVote2, RoomVote3, RoomVote4) {
                                                                    var myObj;
                                                                    var strURL = "JSON_Room.php";
                                                                    var req = getXMLHTTP();
                                                                    if (req) {
                                                                        req.onreadystatechange = function () {
                                                                            if (req.readyState == 4) {
                                                                                // only if "OK"
                                                                                if (req.status == 200) {
                                                                                    myObj = JSON.parse(this.responseText);
                                                                                } else {
                                                                                    alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                                                                                }

                                                                                showChartSummaryVote(myObj, RoomVote1, RoomVote2, RoomVote3, RoomVote4);
                                                                            }
                                                                        };

                                                                        req.open("GET", strURL, true);
                                                                        req.send(null);
                                                                    }
                                                                }

                                                                function showDataRoomVote1() {
                                                                    var myObj;
                                                                    var dataPoints = [];
                                                                    var strURL = "JSON_RoomVote1.php?dtStart=" + document.getElementById("dtStart").value + "&dtEnd=" + document.getElementById("dtEnd").value;
                                                                    //                                                                var strURL = "JSON_RoomVote1.php";
                                                                    var req = getXMLHTTP();
                                                                    if (req) {
                                                                        req.onreadystatechange = function () {
                                                                            if (req.readyState == 4) {
                                                                                // only if "OK"
                                                                                if (req.status == 200) {
                                                                                    myObj = JSON.parse(this.responseText);
                                                                                    for (var i = 0; i <= myObj.length - 1; i++) {
                                                                                        //  var series = new Array(dataPoints.push(myObj[i].Vote));
                                                                                        dataPoints.push(myObj[i].Vote);
                                                                                    }
                                                                                    myObj = dataPoints;
                                                                                } else {
                                                                                    alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                                                                                }
                                                                                Link1(myObj);
                                                                            }
                                                                        };

                                                                        req.open("GET", strURL, true);
                                                                        req.send(null);
                                                                    }

                                                                }

                                                                function showDataRoomVote2(RoomVote1) {
                                                                    var myObj;
                                                                    var dataPoints = [];
                                                                    var strURL = "JSON_RoomVote2.php?dtStart=" + document.getElementById("dtStart").value + "&dtEnd=" + document.getElementById("dtEnd").value;
                                                                    //                                                                var strURL = "JSON_RoomVote1.php";
                                                                    var req = getXMLHTTP();
                                                                    if (req) {
                                                                        req.onreadystatechange = function () {
                                                                            if (req.readyState == 4) {
                                                                                // only if "OK"
                                                                                if (req.status == 200) {
                                                                                    myObj = JSON.parse(this.responseText);
                                                                                    for (var i = 0; i <= myObj.length - 1; i++) {
                                                                                        //  var series = new Array(dataPoints.push(myObj[i].Vote));
                                                                                        dataPoints.push(myObj[i].Vote);
                                                                                    }
                                                                                    myObj = dataPoints;
                                                                                } else {
                                                                                    alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                                                                                }
                                                                                Link2(RoomVote1, myObj);
                                                                            }
                                                                        };

                                                                        req.open("GET", strURL, true);
                                                                        req.send(null);
                                                                    }

                                                                }

                                                                function showDataRoomVote3(RoomVote1, RoomVote2) {
                                                                    var myObj;
                                                                    var dataPoints = [];
                                                                    var strURL = "JSON_RoomVote3.php?dtStart=" + document.getElementById("dtStart").value + "&dtEnd=" + document.getElementById("dtEnd").value;
                                                                    //                                                                var strURL = "JSON_RoomVote1.php";
                                                                    var req = getXMLHTTP();
                                                                    if (req) {
                                                                        req.onreadystatechange = function () {
                                                                            if (req.readyState == 4) {
                                                                                // only if "OK"
                                                                                if (req.status == 200) {
                                                                                    myObj = JSON.parse(this.responseText);
                                                                                    for (var i = 0; i <= myObj.length - 1; i++) {
                                                                                        //  var series = new Array(dataPoints.push(myObj[i].Vote));
                                                                                        dataPoints.push(myObj[i].Vote);
                                                                                    }
                                                                                    myObj = dataPoints;
                                                                                } else {
                                                                                    alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                                                                                }
                                                                                Link3(RoomVote1, RoomVote2, myObj);
                                                                            }
                                                                        };

                                                                        req.open("GET", strURL, true);
                                                                        req.send(null);
                                                                    }

                                                                }

                                                                function showDataRoomVote4(RoomVote1, RoomVote2, RoomVote3) {
                                                                    var myObj;
                                                                    var dataPoints = [];
                                                                    var strURL = "JSON_RoomVote4.php?dtStart=" + document.getElementById("dtStart").value + "&dtEnd=" + document.getElementById("dtEnd").value;
                                                                    //                                                                var strURL = "JSON_RoomVote1.php";
                                                                    var req = getXMLHTTP();
                                                                    if (req) {
                                                                        req.onreadystatechange = function () {
                                                                            if (req.readyState == 4) {
                                                                                // only if "OK"
                                                                                if (req.status == 200) {
                                                                                    myObj = JSON.parse(this.responseText);
                                                                                    for (var i = 0; i <= myObj.length - 1; i++) {
                                                                                        //  var series = new Array(dataPoints.push(myObj[i].Vote));
                                                                                        dataPoints.push(myObj[i].Vote);
                                                                                    }
                                                                                    myObj = dataPoints;
                                                                                } else {
                                                                                    alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                                                                                }
                                                                                Link4(RoomVote1, RoomVote2, RoomVote3, myObj);
                                                                            }
                                                                        };

                                                                        req.open("GET", strURL, true);
                                                                        req.send(null);
                                                                    }

                                                                }

                                                                function Link1(RoomVote1) {
                                                                    showDataRoomVote2(RoomVote1);
                                                                }
                                                                function Link2(RoomVote1, RoomVote2) {
                                                                    showDataRoomVote3(RoomVote1, RoomVote2);
                                                                }
                                                                function Link3(RoomVote1, RoomVote2, RoomVote3) {
                                                                    showDataRoomVote4(RoomVote1, RoomVote2, RoomVote3);
                                                                }
                                                                function Link4(RoomVote1, RoomVote2, RoomVote3, RoomVote4) {
                                                                    showDataRoom(RoomVote1, RoomVote2, RoomVote3, RoomVote4);
                                                                    showDataRoomIssue1();
                                                                }

                                                                function showDataRoomIssue(RoomIssue1, RoomIssue2, RoomIssue3, RoomIssue4, RoomIssue5, RoomIssue6) {
                                                                    var myObj;
                                                                    var strURL = "JSON_Room.php";
                                                                    var req = getXMLHTTP();
                                                                    if (req) {
                                                                        req.onreadystatechange = function () {
                                                                            if (req.readyState == 4) {
                                                                                // only if "OK"
                                                                                if (req.status == 200) {
                                                                                    myObj = JSON.parse(this.responseText);
                                                                                } else {
                                                                                    alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                                                                                }

                                                                                showChartSummaryIssue(myObj, RoomIssue1, RoomIssue2, RoomIssue3, RoomIssue4, RoomIssue5, RoomIssue6);
                                                                            }
                                                                        };

                                                                        req.open("GET", strURL, true);
                                                                        req.send(null);
                                                                    }
                                                                }

                                                                function showDataRoomIssue1() {
                                                                    var myObj;
                                                                    var dataPoints = [];
                                                                    var strURL = "JSON_RoomIssue1.php?dtStart=" + document.getElementById("dtStart").value + "&dtEnd=" + document.getElementById("dtEnd").value;
                                                                    //                                                                var strURL = "JSON_RoomVote1.php";
                                                                    var req = getXMLHTTP();
                                                                    if (req) {
                                                                        req.onreadystatechange = function () {
                                                                            if (req.readyState == 4) {
                                                                                // only if "OK"
                                                                                if (req.status == 200) {
                                                                                    myObj = JSON.parse(this.responseText);
                                                                                    for (var i = 0; i <= myObj.length - 1; i++) {
                                                                                        //  var series = new Array(dataPoints.push(myObj[i].Vote));
                                                                                        dataPoints.push(myObj[i].Issue);
                                                                                    }
                                                                                    myObj = dataPoints;
                                                                                } else {
                                                                                    alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                                                                                }
                                                                                LinkIssue1(myObj);
                                                                            }
                                                                        };

                                                                        req.open("GET", strURL, true);
                                                                        req.send(null);
                                                                    }

                                                                }

                                                                function showDataRoomIssue2(RoomIssue1) {
                                                                    var myObj;
                                                                    var dataPoints = [];
                                                                    var strURL = "JSON_RoomIssue2.php?dtStart=" + document.getElementById("dtStart").value + "&dtEnd=" + document.getElementById("dtEnd").value;
                                                                    //                                                                var strURL = "JSON_RoomVote1.php";
                                                                    var req = getXMLHTTP();
                                                                    if (req) {
                                                                        req.onreadystatechange = function () {
                                                                            if (req.readyState == 4) {
                                                                                // only if "OK"
                                                                                if (req.status == 200) {
                                                                                    myObj = JSON.parse(this.responseText);
                                                                                    for (var i = 0; i <= myObj.length - 1; i++) {
                                                                                        //  var series = new Array(dataPoints.push(myObj[i].Vote));
                                                                                        dataPoints.push(myObj[i].Issue);
                                                                                    }
                                                                                    myObj = dataPoints;
                                                                                } else {
                                                                                    alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                                                                                }
                                                                                LinkIssue2(RoomIssue1, myObj);
                                                                            }
                                                                        };

                                                                        req.open("GET", strURL, true);
                                                                        req.send(null);
                                                                    }

                                                                }

                                                                function showDataRoomIssue3(RoomIssue1, RoomIssue2) {
                                                                    var myObj;
                                                                    var dataPoints = [];
                                                                    var strURL = "JSON_RoomIssue3.php?dtStart=" + document.getElementById("dtStart").value + "&dtEnd=" + document.getElementById("dtEnd").value;
                                                                    //                                                                var strURL = "JSON_RoomVote1.php";
                                                                    var req = getXMLHTTP();
                                                                    if (req) {
                                                                        req.onreadystatechange = function () {
                                                                            if (req.readyState == 4) {
                                                                                // only if "OK"
                                                                                if (req.status == 200) {
                                                                                    myObj = JSON.parse(this.responseText);
                                                                                    for (var i = 0; i <= myObj.length - 1; i++) {
                                                                                        //  var series = new Array(dataPoints.push(myObj[i].Vote));
                                                                                        dataPoints.push(myObj[i].Issue);
                                                                                    }
                                                                                    myObj = dataPoints;
                                                                                } else {
                                                                                    alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                                                                                }
                                                                                LinkIssue3(RoomIssue1, RoomIssue2, myObj);
                                                                            }
                                                                        };

                                                                        req.open("GET", strURL, true);
                                                                        req.send(null);
                                                                    }

                                                                }

                                                                function showDataRoomIssue4(RoomIssue1, RoomIssue2, RoomIssue3) {
                                                                    var myObj;
                                                                    var dataPoints = [];
                                                                    var strURL = "JSON_RoomIssue4.php?dtStart=" + document.getElementById("dtStart").value + "&dtEnd=" + document.getElementById("dtEnd").value;
                                                                    //                                                                var strURL = "JSON_RoomVote1.php";
                                                                    var req = getXMLHTTP();
                                                                    if (req) {
                                                                        req.onreadystatechange = function () {
                                                                            if (req.readyState == 4) {
                                                                                // only if "OK"
                                                                                if (req.status == 200) {
                                                                                    myObj = JSON.parse(this.responseText);
                                                                                    for (var i = 0; i <= myObj.length - 1; i++) {
                                                                                        //  var series = new Array(dataPoints.push(myObj[i].Vote));
                                                                                        dataPoints.push(myObj[i].Issue);
                                                                                    }
                                                                                    myObj = dataPoints;
                                                                                } else {
                                                                                    alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                                                                                }
                                                                                LinkIssue4(RoomIssue1, RoomIssue2, RoomIssue3, myObj);
                                                                            }
                                                                        };

                                                                        req.open("GET", strURL, true);
                                                                        req.send(null);
                                                                    }

                                                                }

                                                                function showDataRoomIssue5(RoomIssue1, RoomIssue2, RoomIssue3, RoomIssue4) {
                                                                    var myObj;
                                                                    var dataPoints = [];
                                                                    var strURL = "JSON_RoomIssue5.php?dtStart=" + document.getElementById("dtStart").value + "&dtEnd=" + document.getElementById("dtEnd").value;
                                                                    //                                                                var strURL = "JSON_RoomVote1.php";
                                                                    var req = getXMLHTTP();
                                                                    if (req) {
                                                                        req.onreadystatechange = function () {
                                                                            if (req.readyState == 4) {
                                                                                // only if "OK"
                                                                                if (req.status == 200) {
                                                                                    myObj = JSON.parse(this.responseText);
                                                                                    for (var i = 0; i <= myObj.length - 1; i++) {
                                                                                        //  var series = new Array(dataPoints.push(myObj[i].Vote));
                                                                                        dataPoints.push(myObj[i].Issue);
                                                                                    }
                                                                                    myObj = dataPoints;
                                                                                } else {
                                                                                    alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                                                                                }
                                                                                LinkIssue5(RoomIssue1, RoomIssue2, RoomIssue3, RoomIssue4, myObj);
                                                                            }
                                                                        };

                                                                        req.open("GET", strURL, true);
                                                                        req.send(null);
                                                                    }

                                                                }

                                                                function showDataRoomIssue6(RoomIssue1, RoomIssue2, RoomIssue3, RoomIssue4, RoomIssue5) {
                                                                    var myObj;
                                                                    var dataPoints = [];
                                                                    var strURL = "JSON_RoomIssue6.php?dtStart=" + document.getElementById("dtStart").value + "&dtEnd=" + document.getElementById("dtEnd").value;
                                                                    //                                                                var strURL = "JSON_RoomVote1.php";
                                                                    var req = getXMLHTTP();
                                                                    if (req) {
                                                                        req.onreadystatechange = function () {
                                                                            if (req.readyState == 4) {
                                                                                // only if "OK"
                                                                                if (req.status == 200) {
                                                                                    myObj = JSON.parse(this.responseText);
                                                                                    for (var i = 0; i <= myObj.length - 1; i++) {
                                                                                        //  var series = new Array(dataPoints.push(myObj[i].Vote));
                                                                                        dataPoints.push(myObj[i].Issue);
                                                                                    }
                                                                                    myObj = dataPoints;
                                                                                } else {
                                                                                    alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                                                                                }
                                                                                LinkIssue6(RoomIssue1, RoomIssue2, RoomIssue3, RoomIssue4, RoomIssue5, myObj);
                                                                            }
                                                                        };

                                                                        req.open("GET", strURL, true);
                                                                        req.send(null);
                                                                    }

                                                                }

                                                                function LinkIssue1(RoomIssue1) {
                                                                    showDataRoomIssue2(RoomIssue1);
                                                                }
                                                                function LinkIssue2(RoomIssue1, RoomIssue2) {
                                                                    showDataRoomIssue3(RoomIssue1, RoomIssue2);
                                                                }
                                                                function LinkIssue3(RoomIssue1, RoomIssue2, RoomIssue3) {
                                                                    showDataRoomIssue4(RoomIssue1, RoomIssue2, RoomIssue3);
                                                                }
                                                                function LinkIssue4(RoomIssue1, RoomIssue2, RoomIssue3, RoomIssue4) {
                                                                    showDataRoomIssue5(RoomIssue1, RoomIssue2, RoomIssue3, RoomIssue4);
                                                                }
                                                                function LinkIssue5(RoomIssue1, RoomIssue2, RoomIssue3, RoomIssue4, RoomIssue5) {
                                                                    showDataRoomIssue6(RoomIssue1, RoomIssue2, RoomIssue3, RoomIssue4, RoomIssue5);
                                                                }
                                                                function LinkIssue6(RoomIssue1, RoomIssue2, RoomIssue3, RoomIssue4, RoomIssue5, RoomIssue6) {
                                                                    showDataRoomIssue(RoomIssue1, RoomIssue2, RoomIssue3, RoomIssue4, RoomIssue5, RoomIssue6);
                                                                }

        </script>
        <!-- BEGIN Java Script for this page -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

        <script>
                                                                // Summary Vote
                                                                function showChartSummaryVote(RoomAll, RoomVote1, RoomVote2, RoomVote3, RoomVote4) {

                                                                    var ctx = document.getElementById("barChartSummaryVote").getContext('2d');
                                                                    var barChart = new Chart(ctx, {
                                                                        type: 'bar',
                                                                        data: {
                                                                            labels: RoomAll,
                                                                            datasets: [{
                                                                                    type: 'bar',
                                                                                    label: 'ดีมาก',
                                                                                    backgroundColor: 'rgba(75, 192, 192, 1)',
                                                                                    data: RoomVote1,
                                                                                    borderColor: 'white',
                                                                                    borderWidth: 0
                                                                                }, {
                                                                                    type: 'bar',
                                                                                    label: 'ดี',
                                                                                    backgroundColor: 'rgba(7,31,158,0.76)',
                                                                                    data: RoomVote2,
                                                                                },
                                                                                {
                                                                                    type: 'bar',
                                                                                    label: 'พอใช้',
                                                                                    backgroundColor: 'rgba(250,165,0,0.51)',
                                                                                    data: RoomVote3,
                                                                                }, {
                                                                                    type: 'bar',
                                                                                    label: 'ควรปรับปรุง',
                                                                                    backgroundColor: 'rgba(199,1,37,0.84)',
                                                                                    data: RoomVote4,
                                                                                }],
                                                                            borderWidth: 1
                                                                        },
                                                                        options: {
                                                                            tooltips: {
                                                                                enabled: true
                                                                            },
                                                                            scales: {
                                                                                yAxes: [{
                                                                                        ticks: {
                                                                                            beginAtZero: true
                                                                                        }
                                                                                    }]
                                                                            }
                                                                        }
                                                                    });
                                                                }
                                                                // Summary Issue
                                                                function showChartSummaryIssue(RoomAll, RoomIssue1, RoomIssue2, RoomIssue3, RoomIssue4, RoomIssue5, RoomIssue6) {

                                                                    var ctx = document.getElementById("barChartSummaryIssue").getContext('2d');
                                                                    var barChart = new Chart(ctx, {
                                                                        type: 'bar',
                                                                        data: {
                                                                            labels: RoomAll,
                                                                            datasets: [{
                                                                                    type: 'bar',
                                                                                    label: 'ถุงขยะเต็ม',
                                                                                    backgroundColor: 'rgba(255,4,245,0.51)',
                                                                                    data: RoomIssue1,
                                                                                    borderColor: 'white',
                                                                                    borderWidth: 0
                                                                                }, {
                                                                                    type: 'bar',
                                                                                    label: 'การบริการ',
                                                                                    backgroundColor: 'rgba(255,4,4,0.51)',
                                                                                    data: RoomIssue2,
                                                                                }, {
                                                                                    type: 'bar',
                                                                                    label: 'สบู่หมด',
                                                                                    backgroundColor: 'rgba(129,4,255,0.51)',
                                                                                    data: RoomIssue3,
                                                                                }, {
                                                                                    type: 'bar',
                                                                                    label: 'ห้องน้ำมีกลิ่น',
                                                                                    backgroundColor: 'rgba(4,240,255,0.51)',
                                                                                    data: RoomIssue4,
                                                                                }, {
                                                                                    type: 'bar',
                                                                                    label: 'ห้องน้ำไม่สะอาด',
                                                                                    backgroundColor: 'rgba(54,255,4,0.51)',
                                                                                    data: RoomIssue5,
                                                                                }, {
                                                                                    type: 'bar',
                                                                                    label: 'อุปกรณ์ชำรุด',
                                                                                    backgroundColor: 'rgba(250,105,0,0.51)',
                                                                                    data: RoomIssue6,
                                                                                }],
                                                                            borderWidth: 1
                                                                        },
                                                                        options: {
                                                                            tooltips: {
                                                                                enabled: true
                                                                            },
                                                                            scales: {
                                                                                yAxes: [{
                                                                                        ticks: {
                                                                                            beginAtZero: true
                                                                                        }
                                                                                    }]
                                                                            }
                                                                        }
                                                                    });
                                                                }

    <?php
    if ($_GET['RM_RoomID']) {
        $sqlCR = "Select RM_RoomID,RM_RoomName from `tb_room` where  RM_RoomName <> '-' and RM_RoomID = " . $_GET['RM_RoomID'];
    } else {
        $sqlCR = "Select RM_RoomID,RM_RoomName from `tb_room` where RM_RoomName <> '-'";
    }

    $rsCR = $mysqli_asset->query($sqlCR);
    while ($rowCR = $rsCR->fetch_array()) {
        ?>
                                                                    // Vote Room 
                                                                    var ctx = document.getElementById("ChartVoteRoom<?= $rowCR['RM_RoomID']; ?>").getContext('2d');
                                                                    var doughnutChart = new Chart(ctx, {
                                                                        type: 'doughnut',
                                                                        //            type: 'pie',
                                                                        data: {
                                                                            datasets: [{
                                                                                    data: [
                                                                                        document.getElementById("Vote1Room<?= $rowCR['RM_RoomID']; ?>").innerHTML,
                                                                                        document.getElementById("Vote2Room<?= $rowCR['RM_RoomID']; ?>").innerHTML,
                                                                                        document.getElementById("Vote3Room<?= $rowCR['RM_RoomID']; ?>").innerHTML,
                                                                                        document.getElementById("Vote4Room<?= $rowCR['RM_RoomID']; ?>").innerHTML
                                                                                    ],
                                                                                    backgroundColor: [
                                                                                        'rgba(75, 192, 192, 1)',
                                                                                        'rgba(7,31,158,0.76)',
                                                                                        'rgba(250,165,0,0.51)',
                                                                                        'rgba(199,1,37,0.84)'
                                                                                    ],
                                                                                    label: 'คะแนนพื้นที่ห้องน้ำชาย ชั้น 1'
                                                                                }],
                                                                            labels: [
                                                                                "ดีมาก",
                                                                                "ดี",
                                                                                "พอใช้",
                                                                                "ควรปรับปรุง"
                                                                            ]
                                                                        },
                                                                        options: {
                                                                            // In options, just use the following line to show all the tooltips
                                                                            showAllTooltips: true,
                                                                            legend: {
                                                                                position: 'right'
                                                                            }
                                                                        }
                                                                    });

                                                                    // Issue Room 
                                                                    var ctx = document.getElementById("ChartIssueRoom<?= $rowCR['RM_RoomID']; ?>").getContext('2d');
                                                                    var doughnutChart = new Chart(ctx, {
                                                                        type: 'doughnut',
                                                                        //            type: 'pie',
                                                                        data: {
                                                                            datasets: [{
                                                                                    data: [
                                                                                        document.getElementById("Issue1Room<?= $rowCR['RM_RoomID']; ?>").innerHTML,
                                                                                        document.getElementById("Issue2Room<?= $rowCR['RM_RoomID']; ?>").innerHTML,
                                                                                        document.getElementById("Issue3Room<?= $rowCR['RM_RoomID']; ?>").innerHTML,
                                                                                        document.getElementById("Issue4Room<?= $rowCR['RM_RoomID']; ?>").innerHTML,
                                                                                        document.getElementById("Issue5Room<?= $rowCR['RM_RoomID']; ?>").innerHTML,
                                                                                        document.getElementById("Issue6Room<?= $rowCR['RM_RoomID']; ?>").innerHTML
                                                                                    ],
                                                                                    backgroundColor: [
                                                                                        'rgba(255,4,245,0.51)',
                                                                                        'rgba(255,4,4,0.51)',
                                                                                        'rgba(129,4,255,0.51)',
                                                                                        'rgba(4,240,255,0.51)',
                                                                                        'rgba(54,255,4,0.51)',
                                                                                        'rgba(250,105,0,0.51)'
                                                                                    ]
                                                                                }],
                                                                            labels: [
                                                                                "ถุงขยะเต็ม",
                                                                                "การบริการ",
                                                                                "สบู่หมด ",
                                                                                "ห้องน้ำมีกลิ่น",
                                                                                "ห้องน้ำไม่สะอาด",
                                                                                "อุปกรณ์ชำรุด "
                                                                            ]
                                                                        },
                                                                        options: {
                                                                            // In options, just use the following line to show all the tooltips
                                                                            showAllTooltips: true,
                                                                            legend: {
                                                                                position: 'right'
                                                                            }
                                                                        }
                                                                    });
        <?php
    }
    ?>







                                                                //                                                            Chart.pluginService.register({
                                                                //                                                                beforeRender: function (chart) {
                                                                //                                                                    if (chart.config.options.showAllTooltips) {
                                                                //                                                                        // create an array of tooltips
                                                                //                                                                        // we can't use the chart tooltip because there is only one tooltip per chart
                                                                //                                                                        chart.pluginTooltips = [];
                                                                //                                                                        chart.config.data.datasets.forEach(function (dataset, i) {
                                                                //                                                                            chart.getDatasetMeta(i).data.forEach(function (sector, j) {
                                                                //                                                                                chart.pluginTooltips.push(new Chart.Tooltip({
                                                                //                                                                                    _chart: chart.chart,
                                                                //                                                                                    _chartInstance: chart,
                                                                //                                                                                    _data: chart.data,
                                                                //                                                                                    _options: chart.options.tooltips,
                                                                //                                                                                    _active: [sector]
                                                                //                                                                                }, chart));
                                                                //                                                                            });
                                                                //                                                                        });
                                                                //
                                                                //                                                                        // turn off normal tooltips
                                                                //                                                                        chart.options.tooltips.enabled = false;
                                                                //                                                                    }
                                                                //                                                                },
                                                                //                                                                afterDraw: function (chart, easing) {
                                                                //                                                                    if (chart.config.options.showAllTooltips) {
                                                                //                                                                        // we don't want the permanent tooltips to animate, so don't do anything till the animation runs atleast once
                                                                //                                                                        if (!chart.allTooltipsOnce) {
                                                                //                                                                            if (easing !== 1)
                                                                //                                                                                return;
                                                                //                                                                            chart.allTooltipsOnce = true;
                                                                //                                                                        }
                                                                //
                                                                //                                                                        // turn on tooltips
                                                                //                                                                        chart.options.tooltips.enabled = true;
                                                                //                                                                        Chart.helpers.each(chart.pluginTooltips, function (tooltip) {
                                                                //                                                                            tooltip.initialize();
                                                                //                                                                            tooltip.update();
                                                                //                                                                            // we don't actually need this since we are not animating tooltips
                                                                //                                                                            tooltip.pivot();
                                                                //                                                                            tooltip.transition(easing).draw();
                                                                //                                                                        });
                                                                //                                                                        chart.options.tooltips.enabled = false;
                                                                //                                                                    }
                                                                //                                                                }
                                                                //                                                            });

                                                                //                                                             Show tooltips always even the stats are zero

                                                                Chart.plugins.register({
                                                                    afterDatasetsDraw: function (chartInstance, easing) {
                                                                        // To only draw at the end of animation, check for easing === 1
                                                                        var ctx = chartInstance.chart.ctx;

                                                                        chartInstance.data.datasets.forEach(function (dataset, i) {
                                                                            var meta = chartInstance.getDatasetMeta(i);
                                                                            if (!meta.hidden) {
                                                                                meta.data.forEach(function (element, index) {
                                                                                    // Draw the text in black, with the specified font
                                                                                    ctx.fillStyle = '#ffffff';

                                                                                    var fontSize = 20;
                                                                                    var fontStyle = 'normal';
                                                                                    var fontFamily = 'Helvetica Neue';
                                                                                    ctx.font = Chart.helpers.fontString(fontSize, fontStyle, fontFamily);

                                                                                    // Just naively convert to string for now
                                                                                    var dataString = "";
                                                                                    if (dataset.data[index] != 0) {
                                                                                        dataString = dataset.data[index].toString() + "%";
                                                                                    }


                                                                                    // Make sure alignment settings are correct
                                                                                    ctx.textAlign = 'center';
                                                                                    ctx.textBaseline = 'middle';

                                                                                    var padding = 0;
                                                                                    var position = element.tooltipPosition();
                                                                                    ctx.fillText(dataString, position.x, position.y - (fontSize / 2) - padding);
                                                                                });
                                                                            }
                                                                        });
                                                                    }
                                                                });



        </script>

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
//include_once './structure_scriptJS.php';
    ?>
    <!-- jQuery 3 -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
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
    <!-- Page script -->

    <script>
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
} else {
    ?>
    <script>window.location.href = 'login.php';</script>
    <?php
}
?>