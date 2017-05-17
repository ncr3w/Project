@extends('staffview.templates.staffview_minimal')

@section('content')
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Edit Password</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<br />
					@if (!empty($success))
						<div class="alert alert-success alert-dismissible fade in" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
							</button><strong>{{$success}}</strong>
						</div>
					@endif

				<form method="post" action="{{ route('staffs.password_store', ['id' =>  $staffs->id ]) }}" data-parsley-validate class="form-horizontal form-label-left">    	

					<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="password"> Password  <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="password" value="" id="password" name="password" class="form-control col-md-7 col-xs-12">
							@if ($errors->has('password'))
							<span class="help-block">{{ $errors->first('password') }}</span>
							@endif
						</div>
					</div>	
					
					<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="password_confirmation"> Confirm Password  <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="password" value="" id="password_confirmation" name="password_confirmation" class="form-control col-md-7 col-xs-12">
							@if ($errors->has('password_confirmation'))
							<span class="help-block">{{ $errors->first('password_confirmation') }}</span>
							@endif
						</div>
					</div>	
										
					<div class="ln_solid"></div>

					<div class="form-group">
						<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
							<input type="hidden" name="_token" value="{{ Session::token() }}">
							<button type="submit" class="btn btn-success">Edit Password</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@stop