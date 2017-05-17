@extends('staffview.templates.staffview_main')

@section('content')
<div class="right_col" role="main">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Add Bid <a href="{{route('bids.index')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Back </a></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form method="post" action="{{ route('bids.store') }}" data-parsley-validate class="form-horizontal form-label-left">                     

						<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email"> Email User <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" value="{{ Request::old('email') ?: '' }}" id="email_js" name="email" class="form-control col-md-7 col-xs-12">
                                @if ($errors->has('email'))
                                <span class="help-block">{{ $errors->first('email') }}</span>
                                @endif
								<p id="user_found">User Found</p>
                            </div>
							<button type="button" class="btn btn-success btn-info" id="button_user_check"><i id="i_user_check" class="fa fa-search" title="Confirm"></i> Check</a></button>							
                        </div>	
						
		
						<div class="form-group{{ $errors->has('product') ? ' has-error' : '' }}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="product">Product<span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
							  <select id="product" name="product" class="form-control col-md-7 col-xs-12">
							  <option value="" selected disabled >--Select Product--</option>
									@foreach($products as $row)
										<option value="{{ $row->id }}">{{ $row->product_name }} {{ $row->article }}</option>
									@endforeach
							  </select>
								@if ($errors->has('product'))
									<span class="help-block">{{ $errors->first('product') }}</span>
								@endif
							</div>
						</div>	
						
						<div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amount"> Amount <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" value="{{ Request::old('amount') ?: '' }}" id="amount" name="amount" class="form-control col-md-7 col-xs-12">
                                @if ($errors->has('amount'))
                                <span class="help-block">{{ $errors->first('amount') }}</span>
                                @endif
                            </div>
                        </div>
						
						<div class="form-group{{ $errors->has('size') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="size"> Size <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" value="{{ Request::old('size') ?: '' }}" id="size" name="size" class="form-control col-md-7 col-xs-12">
                                @if ($errors->has('size'))
                                <span class="help-block">{{ $errors->first('size') }}</span>
                                @endif
                            </div>
                        </div>						
						
						<div class="form-group{{ $errors->has('expired') ? ' has-error' : '' }}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="expired">Expired <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
							  <select id="expired" name="expired" class="form-control col-md-7 col-xs-12">
							  <option value="" selected disabled >--Select Length--</option>
							  <option value="3">3 Days</option>
							  <option value="7">7 Days</option>
							  <option value="14">15 Days</option>
							  <option value="30">30 Days</option>
							  <option value="365000">Forever</option>
							  </select>
								@if ($errors->has('expired'))
									<span class="help-block">{{ $errors->first('expired') }}</span>
								@endif
							</div>
						</div>							
						
						<div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Address <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
							  <p id="address_placehoder">select user first</p>	
							  <select id="address_js" name="address" class="form-control col-md-7 col-xs-12">							  	
							  <option value="" selected disabled >--Select address--</option>
							  </select>
								@if ($errors->has('address'))
									<span class="help-block">{{ $errors->first('address') }}</span>
								@endif
							</div>
						</div>
						
						<div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">Status <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
							  <select id="status" name="status" class="form-control col-md-7 col-xs-12">
							  <option value="" selected disabled >--Select Status--</option>
							  <option value="Active">Active</option>
							  <option value="Waiting for DP">Waiting for DP</option>
							  <option value="Waiting for Verification">Waiting for Verification</option>
							  <option value="In Cart">In Cart</option>
							  <option value="In Progress">In Progress</option>
							  <option value="Finished">Finished</option>
							  </select>
								@if ($errors->has('status'))
									<span class="help-block">{{ $errors->first('status') }}</span>
								@endif
							</div>
						</div>	
						
						<div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="type">Type <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
							  <select id="type" name="type" class="form-control col-md-7 col-xs-12">
							  <option value="" selected disabled >--Select Type--</option>
							  <option value="Bid">Bid </option>
							  <option value="Buy_Now">Buy Now</option>
							  </select>
								@if ($errors->has('type'))
									<span class="help-block">{{ $errors->first('type') }}</span>
								@endif
							</div>
						</div>	
						
						<input type="hidden" id="user_js" name="user" value="">

                        <div class="ln_solid"></div>

                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <input type="hidden" name="_token" value="{{ Session::token() }}">								
                                <button type="submit" class="btn btn-success">Add Bid</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop