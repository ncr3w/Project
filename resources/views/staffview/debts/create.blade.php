@extends('staffview.templates.staffview_main')

@section('content')
<div class="right_col" role="main">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Add Payment <a href="{{route('payments.index')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Back </a></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form method="post" action="{{ route('payments.store') }}" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">                     

                        <div class="form-group{{ $errors->has('id_invoice') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_invoice"> No Invoice <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" value="{{ Request::old('id_invoice') ?: '' }}" id="id_invoice" name="id_invoice" class="form-control col-md-7 col-xs-12">
                                @if ($errors->has('id_invoice'))
                                <span class="help-block">{{ $errors->first('id_invoice') }}</span>
                                @endif
                            </div>
                        </div>
						
						<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email"> Email Customer <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" value="{{ Request::old('email') ?: '' }}" id="email" name="email" class="form-control col-md-7 col-xs-12">
                                @if ($errors->has('email'))
                                <span class="help-block">{{ $errors->first('email') }}</span>
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
						
						<div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="status"> Status <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								Warning: Tidak merubah status di invoice!
							  <select id="status" name="status" class="form-control col-md-7 col-xs-12">
									 <option value="" selected disabled >--Select Status--</option>	
									<option value="Wating for Payment"  @if( Request::old('division_name') == "Wating for Payment" ) selected @endif >Wating for Payment</option>
									<option value="Waiting for Verification" @if( Request::old('division_name') == "Waiting for Verification" ) selected @endif>Waiting for Verification</option>
									<option value="Accepted" @if( Request::old('division_name') == "Accepted" ) selected @endif>Accepted</option>
									<option value="Rejected" @if( Request::old('division_name') == "Rejected" ) selected @endif>Rejected</option>										
							  </select>
								@if ($errors->has('status'))
									<span class="help-block">{{ $errors->first('status') }}</span>
								@endif
							</div>
						</div>
						
						<div class="form-group{{ $errors->has('receipt') ? ' has-error' : '' }}">							
							<div class="col-md-9 col-sm-9 col-xs-12">
								<label class="control-label" for="receipt">Edit  </label>
								<input type="file" name="receipt" id="receipt" class="file"> 
								@if ($errors->has('receipt'))
								<span class="help-block">{{ $errors->first('receipt') }}</span>
								@endif
							</div>
						</div>

                        <div class="ln_solid"></div>

                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <input type="hidden" name="_token" value="{{ Session::token() }}">
                                <button type="submit" class="btn btn-success">Add Brand</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop