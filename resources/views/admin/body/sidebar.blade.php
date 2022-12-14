  @php
    $prefix = Request::route()->getprefix();
    $route =  Route::current()->getName();
  @endphp





  <aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">	
		
        <div class="user-profile">
			<div class="ulogo">
				 <a href="index.html">
				  <!-- logo for regular state and mobile devices -->
					 <div class="d-flex align-items-center justify-content-center">					 	
						  <img src="{{asset('backend/images/logo-dark.png')}}" alt="">
						  <h3><b>Sunny</b> Admin</h3>
					 </div>
				</a>
			</div>
        </div>
      
      <!-- sidebar menu-->
      <ul class="sidebar-menu" data-widget="tree">  
		  
		<li class="{{($route == 'dashboard')?'active':''}}">
          <a href="index.html">
            <i data-feather="pie-chart"></i>
			<span>Dashboard</span>
          </a>
        </li>  
		
        <li class="treeview {{($prefix == '/user')?'active':''}}">
          <a href="#">
            <i data-feather="message-circle"></i>
            <span>Manage User</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('user.view')}}"><i class="ti-more"></i>View User</a></li>
          </ul>
        </li> 
		  
        <li class="treeview {{($prefix == '/profile')?'active':''}}">
          <a href="#">
            <i data-feather="mail"></i> <span>Manage Profile</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('profile.view')}}"><i class="ti-more"></i>My Profile</a></li>
            <li><a href="{{route('password.view')}}"><i class="ti-more"></i>Change Password</a></li>
          </ul>
        </li>	  

        <li class="treeview {{($prefix == '/supplier')?'active':''}}">
          <a href="#">
            <i data-feather="mail"></i> <span>Manage Suppliers</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('supplier.view')}}"><i class="ti-more"></i>View Suppliers</a></li>
          </ul>
        </li>	

        <li class="treeview {{($prefix == '/customer')?'active':''}}">
          <a href="#">
            <i data-feather="mail"></i> <span>Manage Customer</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('customer.view')}}"><i class="ti-more"></i>View Customer</a></li>
          </ul>
        </li>	

        <li class="treeview {{($prefix == '/unit')?'active':''}}">
          <a href="#">
            <i data-feather="mail"></i> <span>Manage Unit</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('unit.view')}}"><i class="ti-more"></i>View Unit</a></li>
          </ul>
        </li>	


         <li class="treeview {{($prefix == '/category')?'active':''}}">
          <a href="#">
            <i data-feather="mail"></i> <span>Manage Category</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('category.view')}}"><i class="ti-more"></i>View Category</a></li>
          </ul>
        </li>	


        <li class="treeview {{($prefix == '/product')?'active':''}}">
          <a href="#">
            <i data-feather="mail"></i> <span>Manage Product</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('product.view')}}"><i class="ti-more"></i>View Product</a></li>
          </ul>
        </li>	


         <li class="treeview {{($prefix == '/purchase')?'active':''}}">
          <a href="#">
            <i data-feather="mail"></i> <span>Manage Purchase</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('purchase.view')}}"><i class="ti-more"></i>View Purchase</a></li>
          </ul>
          <ul class="treeview-menu">
            <li><a href="{{route('purchase.pending.list')}}"><i class="ti-more"></i>Approval Purchase</a></li>
          </ul>
        </li>	


         <li class="treeview {{($prefix == '/invoice')?'active':''}}">
          <a href="#">
            <i data-feather="mail"></i> <span>Manage Invoice</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('invoice.view')}}"><i class="ti-more"></i>View Invoice</a></li>
          </ul>
          <ul class="treeview-menu">
            <li><a href="{{route('invoice.pending.list')}}"><i class="ti-more"></i>Approval Invoice</a></li>
          </ul>
          <ul class="treeview-menu">
            <li><a href="{{route('invoice.print.list')}}"><i class="ti-more"></i>Print Invoice</a></li>
          </ul>
        </li>

		
		 








        <li class="header nav-small-cap">User Interface</li>
		  
        <li class="treeview">
          <a href="#">
            <i data-feather="grid"></i>
            <span>Components</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="components_alerts.html"><i class="ti-more"></i>Alerts</a></li>
            <li><a href="components_badges.html"><i class="ti-more"></i>Badge</a></li>
          </ul>
        </li>
		  
		  
		  
         	
      </ul>
    </section>
  </aside>