<?php

namespace App\Http\Controllers\Staffview;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TicketComment;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TicketChatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		// get all the items
        $ticket_chats = TicketComment::all();

        // load the view and pass the items        

        return view('staffview.ticket.chat')
			->with('ticket_chats', $ticket_chats);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('staffview.ticket_chats.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$this->validate($request, [
			'message' => 'required'
		]);
		
		$user = auth()->user()->id;

		$ticket_chats = TicketComment::create([
			'comment' =>  $request->input('message'),
			'id_user' => $user,
			'id_ticket' =>$request->input('ticket'),
		]);
	
        return redirect()->route('tickets.chat', ['id' =>  $ticket_chats->ticket->id ])->with('success', "$ticket_chats->comment berhasil ditambahkan.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $ticket_chats = TicketComment::findOrFail($id);		
		
			return view('staffview.ticket_chats.delete')
				->with('ticket_chats', $ticket_chats);
		}
		catch (ModelNotFoundException $ex) 
        {
            if ($ex instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		 try{
            $ticket_chats = TicketComment::findOrFail($id);		
		
			return view('staffview.ticket_chats.edit')
				->with('ticket_chats', $ticket_chats);
		}
		catch (ModelNotFoundException $ex) 
        {
            if ($ex instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		try{
			$this->validate($request, [
				'message' => 'required'
			]);

            $ticket_chats = TicketComment::findOrFail($id);	

			$ticket_chats->comment = $request->input('message');
            $ticket_chats->save();
		
			return redirect()->route('tickets.chat', ['id' =>  $ticket_chats->ticket->id ])->with('success', "$$ticket_chats->comment berhasil diubah.");
		}
		catch (ModelNotFoundException $ex) 
        {
            if ($ex instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }
        
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		 try{
            $ticket_chats = TicketComment::findOrFail($id);	

			$ticket_chats->delete();
		
			return redirect()->route('tickets.chat', ['id' =>  $ticket_chats->ticket->id ])->with('success', "$ticket_chats->comment berhasil dihapus");
		}
		catch (ModelNotFoundException $ex) 
        {
            if ($ex instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }
}
