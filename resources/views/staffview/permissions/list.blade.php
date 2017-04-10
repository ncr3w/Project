@extends('staffview.templates.staffview_main')
@extends('staffview.templates.datatable_template')

@section('content')
<div class="right_col" role="main">

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Permission <a href="{{route('permissions.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Tambahkan Permission </a></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
					
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                        <thead>
                            <tr>	
								<th>Id</th>
                                <th>Nama Permission</th>
								<th>Deskripsi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
								<th>Id</th>
                                <th>Nama Permission</th>
								<th>Deskripsi</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @if (count($permissions))
							@foreach($permissions as $row)
                            <tr>	
								<td>{{ $row->id }}</td>
                                <td>{{ $row->display_name }}</td>
								<td>{{ $row->description }}</td>
                                <td>
                                    <a href="{{ route('permissions.edit', ['id' =>  $row->id ]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Ubah"></i> Ubah</a>
                                    <a href="{{ route('permissions.show', ['id' =>  $row->id  ]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Hapus"></i> Hapus</a>
                                </td>
                            </tr>  
							@endforeach
							@endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop