<div class="col-md-3 left_col">
  <div class="left_col scroll-view">
	<div class="navbar nav_title" style="border: 0;">
	  <a href="index.html" class="site_title"><i class="fa fa-desktop"></i> <span>Solex Project</span></a>
	</div>

	<div class="clearfix"></div>

	<!-- menu profile quick info -->
	<div class="profile clearfix">
	  <div class="profile_pic">
		<img src="images/img.jpg" alt="..." class="img-circle profile_img">
	  </div>
	  <div class="profile_info">
		<span>Welcome,</span>
		<h2>{{ Auth::user()->name }}</h2>
		@role('superadmin')
			<h2>Muncul hanya untuk super admin</h2>
		@endrole
		@role('admin')
			<h2>Muncul hanya untuk admin</h2>
		@endrole
		@role('user')
			<h2>Muncul hanya untuk user</h2>
		@endrole
  </div>
	</div>
	<!-- /menu profile quick info -->

	<br />

	<!-- sidebar menu -->
	<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
	  <div class="menu_section">
		<h3>Produk</h3>
		<ul class="nav side-menu">
		

		<li><a><i class="fa fa-user"></i> Users <span class="fa fa-chevron-down"></span></a>
			<ul class="nav child_menu">			  
			  <li><a href="{{route('customers.index')}}">Customer</a></li>
			  <li><a href="{{route('customers.index')}}">Customer Graphs</a></li>
			</ul>
		  </li>
		
		  <li><a><i class="fa fa-product-hunt"></i> Products <span class="fa fa-chevron-down"></span></a>
			<ul class="nav child_menu">
			  <li><a href="{{route('products.index')}}">Product</a></li>
			  <li><a href="{{route('brands.index')}}">Brand</a></li>
			  <li><a href="{{route('divisions.index')}}">Division</a></li>
			</ul>
		  </li>
		  
		   <li><a><i class="fa fa-usd"></i> Transaction <span class="fa fa-chevron-down"></span></a>
			<ul class="nav child_menu">
			  <li><a href="{{route('invoices.index')}}">In-Progress</a></li>
			  <li><a href="{{route('invoices.index_success')}}">Success</a></li>
			  <li><a href="{{route('invoices.index_fail')}}">Fail</a></li>
			</ul>
		  </li>
		  
		   <li><a><i class="fa fa-shopping-cart"></i> Store <span class="fa fa-chevron-down"></span></a>
			<ul class="nav child_menu">
			  <li><a href="{{route('asks.index')}}">Asks</a></li>
			  <li><a href="{{route('bids.index')}}">Bids</a></li>
			  <li><a href="{{route('bids.index')}}">Sales Graph</a></li>
			</ul>
		  </li>	

		  <li><a><i class="fa fa-book"></i> Site Content <span class="fa fa-chevron-down"></span></a>
			<ul class="nav child_menu">
			  <li><a href="{{route('blogs.index')}}">Blog</a></li>
			  <li><a href="{{route('banners.index')}}">Banner</a></li>
			</ul>
		  </li>
		  
		<li><a><i class="fa fa-thumbs-down"></i> Complain <span class="fa fa-chevron-down"></span></a>
			<ul class="nav child_menu">
			  <li><a href="{{route('tickets.index')}}">In-Progress</a></li>
			  <li><a href="{{route('tickets.index_finished')}}">Finished</a></li>
			</ul>
		  </li>
		  
		  <li><a><i class="fa fa-lock"></i> Staffs & Permissions<span class="fa fa-chevron-down"></span></a>
			<ul class="nav child_menu">
			  <li><a href="{{route('staffs.index')}}">Staffs</a></li>	
			  <li><a href="{{route('roles.index')}}">Roles</a></li>
			  <li><a href="{{route('permissions.index')}}">Permissions</a></li>			  
			</ul>
		  </li>
		  
		  <li><a><i class="fa fa-balance-scale"></i> Balance <span class="fa fa-chevron-down"></span></a>
			<ul class="nav child_menu">
			  <li><a href="{{route('payments.index')}}">Payment</a></li>
			  <li><a href="{{route('debts.index')}}">Debt</a></li>
			  <li><a href="{{route('brands.index')}}">Balance Graph</a></li>
			</ul>
		  </li>
		  
		</ul>  
	  </div>
	</div>
	<!-- /sidebar menu -->

	<!-- /menu footer buttons -->
	<div class="sidebar-footer hidden-small">
	  <a data-toggle="tooltip" data-placement="top" title="Settings">
		<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
	  </a>
	  <a data-toggle="tooltip" data-placement="top" title="FullScreen">
		<span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
	  </a>
	  <a data-toggle="tooltip" data-placement="top" title="Lock">
		<span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
	  </a>
	  <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
		<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
	  </a>
	</div>
	<!-- /menu footer buttons -->
  </div>
</div>