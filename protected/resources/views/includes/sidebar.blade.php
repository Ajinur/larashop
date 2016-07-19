<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
      {!! Html::image('assets/backend/dist/img/user2-160x160.jpg', '', ['class' => 'img-circle']) !!}
      </div>
      <div class="pull-left info">
        <p>{{ Sentinel::getUser()->first_name .' '. Sentinel::getUser()->last_name }}</p>
        <!-- Status -->
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <li class="header"></li>
      <!-- Optionally, you can add icons to the links -->
      <li class="active"><a href="{{ url('admin/home') }}"><i class="fa fa-link"></i> <span>Dashboard</span></a></li>
      <li class="treeview">
        <a href="#"><i class="fa fa-link"></i> <span>Data Master</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="{{ route('categories') }}">Categories</a></li>
          <li><a href="{{ route('products') }}">Products</a></li>
          <li><a href="{{ route('tags') }}">Tags</a></li>
          <li><a href="{{ route('review') }}">Reviews</a></li>
          <li><a href="{{ route('information') }}">Information</a></li>
        </ul>
      </li>

      <li><a href="{{ route('orders') }}"><i class="fa fa-link"></i> <span>Orders</span></a></li>
      <!--li class="treeview">
        <a href="#"><i class="fa fa-link"></i> <span>Customers</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="{{ route('customers') }}">Customers</a></li>
          <li><a href="{{ route('customergroups') }}">Customer Groups</a></li>
        </ul>
      </li-->
      <li class="treeview">
        <a href="#"><i class="fa fa-link"></i> <span>System</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="{{ route('system.settings') }}">Settings</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#"><i class="fa fa-link"></i> <span>Tools</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="{{ route('backup') }}">Backup Database</a></li>
        </ul>
      </li>
      
    </ul><!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>