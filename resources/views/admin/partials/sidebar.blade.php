<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Admin</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Master</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{ URL::to('section') }}"><i class="fa fa-circle-o"></i> Section</a></li>
                    <li><a href="{{ URL::to('subject') }}"><i class="fa fa-circle-o"></i> Subject</a></li>
                    <li><a href="{{ URL::to('assignsubjects') }}"><i class="fa fa-circle-o"></i> Assing Subject</a></li>
                    <li><a href="{{ URL::to('assigntopics') }}"><i class="fa fa-circle-o"></i> Assing Topic</a></li>
                    <li><a href="{{ URL::to('assignsubtopic') }}"><i class="fa fa-circle-o"></i> Assing Sub Topic</a></li>
                    <li><a href="{{ URL::to('topic') }}"><i class="fa fa-circle-o"></i> Topic</a></li>
                    <li><a href="{{ URL::to('subtopic') }}"><i class="fa fa-circle-o"></i> Sub Topic</a></li>
                    <li><a href="{{ URL::to('question') }}"><i class="fa fa-circle-o"></i> Questions</a></li>
                </ul>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
