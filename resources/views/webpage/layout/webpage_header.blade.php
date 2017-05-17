<!-- top navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><img title="nama perusahaan" alt="nama perusahaan" src="{{asset('storage/images/webpage/navbar-logo.png')}}" height="130%"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<p class="navbar-text navbar-left">
			Selamat datang,
			@if (Auth::check())
			  {{ Auth::user()->name }}
			@else
				Guest
			@endif
		</p>
		<ul class="nav navbar-nav navbar-right">		  
		  <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
		  <li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span><span class="badge">4</span> Cart</a></li>
		</ul>
		<form class="navbar-form navbar-left">
			<div class="input-group" id="navbar-search">
			<input type="text" class="form-control" placeholder="Cari...">
				<div class="input-group-btn">
					<button class="btn btn-default" type="submit">
						<i class="glyphicon glyphicon-search"></i>
					</button>
				</div>
			</div>
		</form>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<nav class="navbar navbar-default navbar-static-top">
  <div class="container-fluid">
  
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2" style="margin-top:50px; margin-bottom:-50px;">
		<ul class="nav navbar-nav navbar-left">
			<li><a href="#">Baru</a></li>
			<li><a href="#">Bekas</a></li>
			<li><a href="#">Men</a></li>
			<li><a href="#">Women</a></li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Brand <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="#">Action</a></li>
					<li><a href="#">Another action</a></li>
					<li><a href="#">Something else here</a></li>
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Kategori <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="#">Action</a></li>
					<li><a href="#">Another action</a></li>
					<li><a href="#">Something else here</a></li>
				</ul>
			</li>
		</ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!-- /top navigation -->