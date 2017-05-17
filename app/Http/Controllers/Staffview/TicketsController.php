<?php

namespace App\Http\Controllers\Staffview;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		// get all the items
        $tickets = Ticket::open()->get();

        // load the view and pass the items        

        return view('staffview.tickets.list')
			->with('tickets', $tickets);;
    }
	
	public function index_finished()
    {
		// get all the items
        $tickets = Ticket::closed()->get();

        // load the view and pass the items        

        return view('staffview.tickets.list')
			->with('tickets', $tickets);;
    }
	
	public function chat($id)
    {
		// get all the items
        $tickets = Ticket::findOrFail($id);	

        // load the view and pass the items        

        return view('staffview.tickets.chat')
			->with('tickets', $tickets);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('staffview.tickets.create');
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
			'brand_name' => 'required|unique:tickets,brand_name'
		]);

		$brand = Ticket::create([
			'brand_name' =>  $request->input('brand_name'),
		]);
	
        return redirect()->route('tickets.index')->with('success', "$brand->brand_name berhasil ditambahkan.");
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
            $tickets = Ticket::findOrFail($id);		
		
			return view('staffview.tickets.delete')
				->with('tickets', $tickets);
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
            $tickets = Ticket::findOrFail($id);		
		
			return view('staffview.tickets.edit')
				->with('tickets', $tickets);
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
				'brand_name' => 'required|unique:tickets,brand_name,'.$id,
			]);

            $tickets = Ticket::findOrFail($id);	

			$tickets->brand_name = $request->input('brand_name');
            $tickets->save();
		
			return redirect()->route('tickets.index')->with('success', "$tickets->brand_name berhasil diubah.");
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
            $tickets = Ticket::findOrFail($id);	

			$tickets->delete();
		
			return redirect()->route('tickets.index')->with('success', "$tickets->brand_name berhasil dihapus");
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
