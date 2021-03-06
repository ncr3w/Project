@extends('staffview.templates.staffview_main')

@section('content')
<div class="right_col" role="main">
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Confirm Deletion <a href="{{route('roles.index')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Back </a></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p>Delete <strong>{{ $roles->display_name }}</strong> ?</p>

                    <form method="POST" action="{{ route('roles.destroy', ['id' => $roles->id]) }}">
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                        <input name="_method" type="hidden" value="DELETE">
                        <button type="submit" class="btn btn-danger">Ya, Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
