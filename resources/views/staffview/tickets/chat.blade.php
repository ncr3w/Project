@extends('staffview.templates.staffview_main')
@extends('staffview.templates.datatable_template')

@section('content')
<div class="right_col" role="main">

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Chat</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
				
					<h4>No Ticket: {{ $tickets->id }}</h4>
					<h4>Ticket Detail: {{ $tickets->ticket_detail->detail }}</h4>
					<h4>Ticket Solution: {{ $tickets->ticket_solution->solution }}</h4>
				
					<ul class="messages">
						@if (count($tickets->comments))
						@foreach($tickets->comments as $row)
							<li>
								<div class="message_date">
									<h4 class="date text-error">{{ $row->created_at->format('j') }}</h4>
									<p class="day">{{ $row->created_at->format('F') }}</p>
									<p class="month">{{ $row->created_at->format('G i') }}</p>
								</div>
							<div class="message_wrapper">
								<h4 class="heading">{{ $row->user->name }}</h4>
								<blockquote class="message">{{ $row->comment }}</blockquote>
								<br />
								<p class="url">
                                    <a href="{{ route('ticket-chats.edit', ['id' =>  $row->id ]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i> Edit</a>
                                    <a href="{{ route('ticket-chats.show', ['id' =>  $row->id  ]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i> Delete</a>
								</p>
							</div>
						  </li>
						@endforeach
						@endif
					</ul>   
					
					<form method="post" action="{{ route('ticket-chats.store') }}" data-parsley-validate class="form-horizontal form-label-left">
					
					    <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="message"> New Chat <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                               <textarea id="message" required="required" class="form-control" name="message"></textarea>
                                @if ($errors->has('message'))
                                <span class="help-block">{{ $errors->first('message') }}</span>
                                @endif
                            </div>
                        </div>
					
					    <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <input type="hidden" name="_token" value="{{ Session::token() }}">
								<input type="hidden" name="ticket" value="{{ $tickets->id }}">
                                <button type="submit" class="btn btn-success">Post</button>
                            </div>
                        </div>
					</form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop