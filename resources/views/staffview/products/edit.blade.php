@extends('staffview.templates.staffview_main')

@section('content')
<div class="right_col" role="main">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Edit Product <a href="{{route('products.index')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Back </a></h2>
                    <div class="clearfix"></div>
                </div>
     <div class="x_content">
                    <br />
                    <form method="post" action="{{ route('products.update', ['id' => $products->id]) }}" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">                     

                        <div class="form-group{{ $errors->has('product_name') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="product_name"> Nama Produk <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" value={{ $products->product_name }} id="product_name" name="product_name" class="form-control col-md-7 col-xs-12">
                                @if ($errors->has('product_name'))
                                <span class="help-block">{{ $errors->first('product_name') }}</span>
                                @endif
                            </div>
                        </div>
						
						<div class="form-group{{ $errors->has('brand_name') ? ' has-error' : '' }}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="brand_name">Brand <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
							  <select id="brand_name" name="brand_name" class="form-control col-md-7 col-xs-12">
									@foreach($brands as $row)
										@if( $products->brand->id == $row->id )
											<option value="{{ $row->id }}" selected >{{ $row->brand_name }}</option>
										@else
											<option value="{{ $row->id }}">{{ $row->brand_name }}</option>
										@endif
									@endforeach
							  </select>
								@if ($errors->has('brand_name'))
									<span class="help-block">{{ $errors->first('brand_name') }}</span>
								@endif
							</div>
						</div>
						
						<div class="form-group{{ $errors->has('division_name') ? ' has-error' : '' }}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="division_name">Divisi <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
							  <select id="division_name" name="division_name" class="form-control col-md-7 col-xs-12">
									@foreach($divisions as $row)
										@if($products->division->id == $row->id  )
											<option value="{{ $row->id }}" selected >{{ $row->division_name }}</option>
										@else
											<option value="{{ $row->id }}">{{ $row->division_name }}</option>
										@endif
									@endforeach
							  </select>
								@if ($errors->has('division_name'))
									<span class="help-block">{{ $errors->first('division_name') }}</span>
								@endif
							</div>
						</div>
						
						<div class="form-group{{ $errors->has('article') ? ' has-error' : '' }}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="article">Artikel <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" value={{ $products->article }} id="article" name="article" class="form-control col-md-7 col-xs-12">
								@if ($errors->has('article'))
								<span class="help-block">{{ $errors->first('article') }}</span>
								@endif
							</div>
						</div>
						
						<div class="form-group{{ $errors->has('color') ? ' has-error' : '' }}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="color">Warna <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" value={{ $products->color }} id="color" name="color" class="form-control col-md-7 col-xs-12">
								@if ($errors->has('color'))
								<span class="help-block">{{ $errors->first('color') }}</span>
								@endif
							</div>
						</div>
						
						<div class="form-group{{ $errors->has('alias') ? ' has-error' : '' }}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="alias">Alias <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" value={{ $products->alias }} id="alias" name="alias" class="form-control col-md-7 col-xs-12">
								@if ($errors->has('alias'))
								<span class="help-block">{{ $errors->first('alias') }}</span>
								@endif
							</div>
						</div>
						
						<div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="gender">Gender <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<label class="radio-inline"><input type="radio" name="gender" @if( $products->gender == '0') checked @endif value="0">Male</label>
								<label class="radio-inline"><input type="radio" name="gender" @if( $products->gender == '1') checked @endif value="1">Female</label>
								@if ($errors->has('retail_price'))
								<span class="help-block">{{ $errors->first('gender') }}</span>
								@endif
							</div>
						</div>
						
						<div class="form-group{{ $errors->has('retail_price') ? ' has-error' : '' }}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="retail_price">Harga Retail <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" value={{ $products->retail_price }} id="retail_price" name="retail_price" class="form-control col-md-7 col-xs-12">
								@if ($errors->has('retail_price'))
								<span class="help-block">{{ $errors->first('retail_price') }}</span>
								@endif
							</div>
						</div>
						
						
						<div class="col-md-3 col-sm-3 col-xs-6">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="photo_1">Foto 1 </label>
							<img src="{{asset('storage/images/products/'.$products->photo->photo_1.'')}}" width="150" height="75">
						</div>							
						
						<div class="form-group{{ $errors->has('photo_1') ? ' has-error' : '' }}">
							<label class="control-label" for="photo_1">Edit  </label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<input type="file" name="photo_1" id="photo_1" class="file"> 
								@if ($errors->has('photo_1'))
								<span class="help-block">{{ $errors->first('photo_1') }}</span>
								@endif
							</div>
						</div>
						
						<div class="col-md-3 col-sm-3 col-xs-6">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="photo_1">Foto 2 </label>
							<img src="{{asset('storage/images/products/'.$products->photo->photo_2.'')}}" width="150" height="75">
						</div>
						
						<div class="form-group{{ $errors->has('photo_2') ? ' has-error' : '' }}">
							<label class="control-label" for="photo_2">Edit </label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<input type="file" name="photo_2" id="photo_2" class="file"> 
								@if ($errors->has('photo_2'))
								<span class="help-block">{{ $errors->first('photo_2') }}</span>
								@endif
							</div>
						</div>
						
						<div class="col-md-3 col-sm-3 col-xs-6">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="photo_1">Foto 3 </label>
							<img src="{{asset('storage/images/products/'.$products->photo->photo_3.'')}}" width="150" height="75">
						</div>
						
						<div class="form-group{{ $errors->has('photo_3') ? ' has-error' : '' }}">
							
							<div class="col-md-9 col-sm-9 col-xs-12">
								<label class="control-label" for="photo_3">Edit  </label>
								<input type="file" name="photo_3" id="photo_3" class="file"> 
								@if ($errors->has('photo_3'))
								<span class="help-block">{{ $errors->first('photo_3') }}</span>
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