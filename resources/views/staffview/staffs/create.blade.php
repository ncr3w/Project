@extends('staffview.templates.staffview_main')

@section('content')
<div class="right_col" role="main">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Add Staff <a href="{{route('staffs.index')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Back </a></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form method="post" action="{{ route('staffs.store') }}" data-parsley-validate class="form-horizontal form-label-left">                     

						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Nama  <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" value="{{ Request::old('name') ?: '' }}" id="name" name="name" class="form-control col-md-7 col-xs-12">
								@if ($errors->has('name'))
								<span class="help-block">{{ $errors->first('name') }}</span>
								@endif
							</div>
						</div>
						
						<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone"> Telepon  <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" value="{{ Request::old('phone') ?: '' }}" id="phone" name="phone" class="form-control col-md-7 col-xs-12">
								@if ($errors->has('phone'))
								<span class="help-block">{{ $errors->first('phone') }}</span>
								@endif
							</div>
						</div>
						
						<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="email"> Email  <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" value="{{ Request::old('email') ?: '' }}" id="email" name="email" class="form-control col-md-7 col-xs-12">
								@if ($errors->has('email'))
								<span class="help-block">{{ $errors->first('email') }}</span>
								@endif
							</div>
						</div>	

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
					
						<div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="gender">Gender <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<label class="radio-inline"><input type="radio" name="gender" class="flat" @if(Request::old('gender')) == '0')  checked @endif value="0"> Male</label>
								<label class="radio-inline"><input type="radio" name="gender" class="flat" @if(Request::old('gender')) == '1')  checked @endif value="1"> Female</label>
								@if ($errors->has('gender'))
								<span class="help-block">{{ $errors->first('gender') }}</span>
								@endif
							</div>
						</div>
						
						<div class="form-group{{ $errors->has('date_of_birth') ? ' has-error' : '' }}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="date_of_birth">Tanggal Lahir <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" value="{{ Request::old('date_of_birth') ?: '' }}" id="date_of_birth" name="date_of_birth" class="form-control col-md-7 col-xs-12"  data-inputmask="'mask': '9999-99-99'">
								@if ($errors->has('date_of_birth'))
								<span class="help-block">{{ $errors->first('date_of_birth') }}</span>
								@endif
							</div>
						</div>
						
						<div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="role">Role <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
							  <select id="role" name="role" class="form-control col-md-7 col-xs-12">
							  <option value="" selected disabled >--Select Role--</option>
									@foreach($roles as $row)
										@if($row->id == 1 || $row->id ==2)
											@if(Request::old('role') == $row->id )
												<option value="{{ $row->id }}" selected >{{ $row->display_name }}</option>
											@else
												<option value="{{ $row->id }}">{{ $row->display_name }}</option>
											@endif
										@endif	
									@endforeach
							  </select>
								@if ($errors->has('role'))
									<span class="help-block">{{ $errors->first('role') }}</span>
								@endif
							</div>
						</div>	
						
						<div>
							<label class="control-label col-md-12 col-sm-12 col-xs-12"><h3 class="text-center col-md-6 col-sm-6 col-xs-12">Address</h3></label>
						</div>
						
						<div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="address"> Address  <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="textbox" value="{{ Request::old('address') ?: '' }}" id="address" name="address" class="form-control col-md-7 col-xs-12">
								@if ($errors->has('address'))
								<span class="help-block">{{ $errors->first('address') }}</span>
								@endif
							</div>
						</div>	
						
						<div class="form-group{{ $errors->has('phone_address') ? ' has-error' : '' }}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="address"> Phone Address <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="textbox" value="{{ Request::old('phone_address') ?: '' }}" id="phone_address" name="phone_address" class="form-control col-md-7 col-xs-12">
								@if ($errors->has('phone_address'))
								<span class="help-block">{{ $errors->first('phone_address') }}</span>
								@endif
							</div>
						</div>	
						
						<div class="form-group{{ $errors->has('postal_code') ? ' has-error' : '' }}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="postal_code"> Postal Code  <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="textbox" value="{{ Request::old('postal_code') ?: '' }}" id="postal_code" name="postal_code" class="form-control col-md-7 col-xs-12">
								@if ($errors->has('postal_code'))
								<span class="help-block">{{ $errors->first('postal_code') }}</span>
								@endif
							</div>
						</div>	

						<div class="form-group{{ $errors->has('province_name') ? ' has-error' : '' }}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="province_name">Province <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
							  <select id="province_name" name="province_name" class="form-control col-md-7 col-xs-12">
							  <option value="" selected disabled >--Select Province--</option>
									@foreach($provinces as $row)
										<option value="{{ $row->id }}">{{ $row->province_name }}</option>
									@endforeach
							  </select>
								@if ($errors->has('province_name'))
									<span class="help-block">{{ $errors->first('province_name') }}</span>
								@endif
							</div>
						</div>	
						
						<div class="form-group{{ $errors->has('regency_name') ? ' has-error' : '' }}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="regency_name">Regency <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
							  <p id="regency_placehoder">select province first</p>		
							  <select id="regency_name" name="regency_name" class="form-control col-md-7 col-xs-12">
							  <option value="" selected disabled >--Select Regency--</option>									
							  </select>
								@if ($errors->has('regency_name'))
									<span class="help-block">{{ $errors->first('regency_name') }}</span>
								@endif
							</div>
						</div>
						
						<div class="form-group{{ $errors->has('district_name') ? ' has-error' : '' }}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="district_name">Distrcit <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
							  <select id="district_name" name="district_name" class="form-control col-md-7 col-xs-12">
							  <p id="district_placehoder">select regency first</p>	
							  <option value="" selected disabled >--Select District--</option>									
							  </select>
								@if ($errors->has('district_name'))
									<span class="help-block">{{ $errors->first('district_name') }}</span>
								@endif
							</div>
						</div>
											
                        <div class="ln_solid"></div>

                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <input type="hidden" name="_token" value="{{ Session::token() }}">
                                <button type="submit" class="btn btn-success">Add Staff</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop