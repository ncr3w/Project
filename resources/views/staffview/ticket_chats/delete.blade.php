@extends('staffview.templates.staffview_main')

@section('content')
<div class="right_col" role="main">
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Confirm Deletion <a href="{{ route('tickets.chat', ['id' =>  $ticket_chats->ticket->id ]) }}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Back </a></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p>Delete <strong>{{ $ticket_chats->comment }}</strong> ?</p>

                    <form method="POST" action="{{ route('ticket-chats.destroy', ['id' => $ticket_chats->id]) }}">
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
