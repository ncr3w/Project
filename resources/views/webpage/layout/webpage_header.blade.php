<!-- top navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
			<a class="navbar-brand" href="/">
				<img title="nama perusahaan" alt="nama perusahaan" src="{{asset('storage/images/webpage/navbar-logo.png')}}" class="image_full">
				<img title="nama perusahaan" alt="nama perusahaan" src="{{asset('storage/images/webpage/navbar-logo-small.png')}}"  class="image_mobile">
			</a>
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav navbar-right" style="margin-right:20px;">
			@if (Auth::check())
			<li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}<span class="glyphicon glyphicon-user"></span><span class="caret"><span></span></a>
				<ul id="login-dp" class="dropdown-menu">
					<li>
						 <div class="row">
							<div class="col-md-12">
								Profil
								{{ Auth::user()->name }}
								<p class="divider"></p>
								Ubah Profil
								<div class="bottom">
									<a id="logout" name="logout" href="{{ route('logout') }}"	onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <button class="btn btn-primary btn-block">Keluar</button>
									</a>
									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									{{ csrf_field() }}
									</form>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</li>
			@else
			<li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
				<ul id="login-dp" class="dropdown-menu">
					<li>
						 <div class="row">
								<div class="col-md-12">
									Login via
									<div class="social-buttons">
										<a href="{{ url('/auth/facebook') }}" class="btn btn-fb" style="display: block; width: 100%;"><i class="fa fa-facebook"></i> Facebook</a>
									</div>
									<p class="divider"></p>
									<p class="text-center">Atau</p>
									<form class="form" role="form" method="POST" action="{{ route('user.login') }}">
										{{ csrf_field() }}
											<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
												<label for="email" class="col-md-4 control-label">E-Mail</label>
												<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
												 @if ($errors->has('email'))
													<span class="help-block">
													<strong>{{ $errors->first('email') }}</strong>
													</span>
												@endif
											</div>
											<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
												 <label for="password" class="col-md-4 control-label">Password</label>
												 <input id="password" type="password" class="form-control" name="password" required>
												 @if ($errors->has('password'))
													<span class="help-block">
													<strong>{{ $errors->first('password') }}</strong>
													</span>
												@endif
												 <div class="help-block text-right"><a href="">Lupa password ?</a></div>
											</div>
											<div class="form-group">
												 <button type="submit" class="btn btn-primary btn-block">Masuk</button>
											</div>
											<div class="checkbox">
												 <label>
													<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Ingat saya
												 </label>
											</div>
									 </form>
								</div>
							<div class="bottom text-center">
								Belum punya akun? <a id="register" href="{{ route('home.register') }}"><b>Register</b></a>
							</div>
						</div>
					</li>
				</ul>
				@endif
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
<!-- /top navigation -->
