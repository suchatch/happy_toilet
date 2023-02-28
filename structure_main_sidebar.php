<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="dist/img/nopic-128x128.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Administrator</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->

        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <!--<li><a href="ProductMaster.php"><i class="fa fa-circle-o"></i> Product Master</a></li>-->
                    <li><a href="index.php"><i class="fa fa-circle-o"></i> Dashboard</a></li>
                    <!--<li><a href="DiffReport.php"><i class="fa fa-circle-o"></i> Diff Report</a></li>-->
                </ul>
            </li>
        </ul>

        <ul class="sidebar-menu" data-widget="tree">

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>Data Table</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="manage_department.php"><i class="fa fa-circle-o"></i> Manage Department</a></li>
                    <li><a href="manage_staff.php"><i class="fa fa-circle-o"></i> Manage Staff</a></li>
                    <li><a href="manage_room.php"><i class="fa fa-circle-o"></i> Manage Room</a></li>
                    <li><a href="manage_vote.php"><i class="fa fa-circle-o"></i> Manage Vote</a></li>
                </ul>
            </li>
        </ul>


        <ul class="sidebar-menu" data-widget="tree">
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>Report</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="graphReport.php"><i class="fa fa-circle-o"></i> Chart Summary</a></li>
                    <li><a href="TableSummaryVoteIssue.php"><i class="fa fa-circle-o"></i> Table Summary</a></li>


                    <!--<li><a href="report_diff.php"><i class="fa fa-circle-o"></i> Table Report</a></li>-->
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>