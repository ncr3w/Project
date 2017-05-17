@extends('staffview.templates.staffview_main')

@section('content')
<div class="right_col" role="main">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Edit Division <a href="{{route('divisions.index')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Back </a></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form method="post" action="{{ route('divisions.update', ['id' => $divisions->id]) }}" data-parsley-validate class="form-horizontal form-label-left">

                        <div class="form-group{{ $errors->has('division_name') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="division_name"> Nama <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" value="{{ $divisions->division_name }}" id="division_name" name="division_name" class="form-control col-md-7 col-xs-12">
                                @if ($errors->has('division_name'))
                                <span class="help-block">{{ $errors->first('division_name') }}</span>
                                @endif
                            </div>
                        </div>
						
						<div class="col-md-3 col-sm-3 col-xs-6">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="image">Image </label>
							<img src="{{asset('storage/images/divisions/'.$brands->image.'')}}" width="150" height="75">
						</div>							
						
						<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
							<label class="control-label" for="image">Edit  </label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<input type="file" name="image" id="image" class="file"> 
								@if ($errors->has('image'))
								<span class="help-block">{{ $errors->first('image') }}</span>
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