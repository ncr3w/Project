<?php

namespace App\Http\Controllers\Staffview;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ask;
use App\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AsksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		// get all the items
        $asks = Ask::all();

        // load the view and pass the items        

        return view('staffview.asks.list')
			->with('asks', $asks);;
    }
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$products = Product::All();
		
		$params = [
			'products' => $products,
		];
		return view('staffview.asks.create')
			->with($params);		
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
			'address' => 'required',		
			'product' => 'required',
			'amount' => 'required|integer',		
			'type' => 'required',
			'status' => 'required',
			'size' => 'required|numeric',
			'expired' => 'required',
			'user' => 'required',
			'weight' => 'required|numeric',
		]);
		
		$date =  date("Y/m/d");
		$date2 =  date('Y-m-d', strtotime($date. " + " .$request->input('expired'). "days"));

		$ask = Ask::create([
			'id_address' => $request->input('address'),	
			'id_product' => $request->input('product'),
			'ask_amount' => $request->input('amount'),			
			'weight' => $request->input('weight'),
			'type' => $request->input('type'),
			'status' => $request->input('status'),
			'size' => $request->input('size'),
			'id_user' => $request->input('user'),
			'ask_date' => $date,
			'expired_date' => $date2,
			'mod_user' =>  \Auth::User()->name(),
		]);
	
        return redirect()->route('asks.index')->with('success', "$ask->id berhasil ditambahkan.");
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
            $asks = Ask::findOrFail($id);		
		
			return view('staffview.asks.delete')
				->with('asks', $asks);
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
            $asks = Ask::findOrFail($id);		
		
			return view('staffview.asks.edit')
				->with('asks', $asks);
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
				'brand_name' => 'required|unique:asks,brand_name,'.$id,
			]);

            $asks = Ask::findOrFail($id);	

			$asks->brand_name = $request->input('brand_name');
            $asks->save();
		
			return redirect()->route('asks.index')->with('success', "$asks->id berhasil diubah.");
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
            $asks = Ask::findOrFail($id);	

			$asks->delete();
		
			return redirect()->route('asks.index')->with('success', "$asks->id berhasil dihapus");
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
