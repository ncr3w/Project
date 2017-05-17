@extends('staffview.templates.staffview_main')

@section('content')
<div class="right_col" role="main">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Edit Banner <a href="{{route('banners.index')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Back </a></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form method="post" action="{{ route('banners.update', ['id' => $banners->id]) }}" data-parsley-validate class="form-horizontal form-label-left"
					enctype="multipart/form-data">

						<div class="form-group{{ $errors->has('used') ? ' has-error' : '' }}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="used">Used <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<label class="radio-inline"><input type="radio" name="used" @if( $banners->used == '1') checked @endif value="1">Yes</label>
								<label class="radio-inline"><input type="radio" name="used" @if( $banners->used == '0') checked @endif value="0">No</label>
								@if ($errors->has('retail_price'))
								<span class="help-block">{{ $errors->first('used') }}</span>
								@endif
							</div>
						</div>
						
						<div class="col-md-3 col-sm-3 col-xs-6">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="banner">Banner </label>
							<img src="{{asset('storage/images/banners/'.$banners->banner.'')}}" width="150" height="75">
						</div>							
						
						<div class="form-group{{ $errors->has('banner') ? ' has-error' : '' }}">
							<label class="control-label" for="banner">Edit  </label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<input type="file" name="banner" id="banner" class="file"> 
								@if ($errors->has('banner'))
								<span class="help-block">{{ $errors->first('banner') }}</span>
								@endif
							</div>
						</div>

                        <div class="ln_solid"></div>

                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <input type="hidden" name="_token" value="{{ Session::token() }}">
                                <input name="_method" type="hidden" value="PUT">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop