@extends('staffview.templates.staffview_main')

@section('content')
<div class="right_col" role="main">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Add Address <a href="{{route('customers.index')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Back </a></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form method="post" action="{{ route('address.store') }}" data-parsley-validate class="form-horizontal form-label-left">     

						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Name  <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="textbox" value="{{ Request::old('name') ?: '' }}" id="name" name="name" class="form-control col-md-7 col-xs-12">
								@if ($errors->has('name'))
								<span class="help-block">{{ $errors->first('name') }}</span>
								@endif
							</div>
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
                                <button type="submit" class="btn btn-success">Add Address</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop