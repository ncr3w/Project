<?php

namespace App\Http\Controllers\Staffview;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bid;
use App\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BidsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		// get all the items
        $bids = Bid::all();

        // load the view and pass the items        

        return view('staffview.bids.list')
			->with('bids', $bids);;
    }
	
	 /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$products = Product::all();
		
		$params = [
            'products' => $products,
		];
        return view('staffview.bids.create')
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
		]);
		
		$date =  date("Y-m-d");
		$date2 =  date('Y-m-d', strtotime($date. " + " .$request->input('expired'). "days"));

		$bid = Bid::create([
			'id_address' => $request->input('address'),	
			'id_product' => $request->input('product'),
			'amount' => $request->input('amount'),
			'type' => $request->input('type'),
			'status' => $request->input('status'),
			'size' => $request->input('size'),
			'id_user' => $request->input('user'),
			'bid_date' => $date,
			'expired_date' => $date2,
			'mod_user' =>  \Auth::User()->name,
		]);
	
        return redirect()->route('bids.index')->with('success', "$bid->id berhasil ditambahkan.");
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
            $bids = Bid::findOrFail($id);		
		
			return view('staffview.bids.delete')
				->with('bids', $bids);
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
            $bids = Bid::findOrFail($id);		
		
			return view('staffview.bids.edit')
				->with('bids', $bids);
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
				'brand_name' => 'required|unique:bids,brand_name,'.$id,
			]);

            $bids = Bid::findOrFail($id);	

			$bids->brand_name = $request->input('brand_name');
            $bids->save();
		
			return redirect()->route('bids.index')->with('success', "$bids->brand_name berhasil diubah.");
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
            $bids = Bid::findOrFail($id);	

			$bids->delete();
		
			return redirect()->route('bids.index')->with('success', "$bids->id berhasil dihapus");
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
