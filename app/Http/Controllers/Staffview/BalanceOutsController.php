<?php

namespace App\Http\Controllers\Staffview;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BalanceOut;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BalanceOutsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		// get all the items
        $balance_outs = BalanceOut::all();

        // load the view and pass the items        

        return view('staffview.balance_outs.list')
			->with('balance_outs', $balance_outs);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('staffview.balance_outs.create');
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
			'brand_name' => 'required|unique:balance_outs,brand_name'
		]);

		$brand = BalanceOut::create([
			'brand_name' =>  $request->input('brand_name'),
		]);
	
        return redirect()->route('balance_outs.index')->with('success', "$brand->brand_name berhasil ditambahkan.");
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
            $balance_outs = BalanceOut::findOrFail($id);		
		
			return view('staffview.balance_outs.delete')
				->with('balance_outs', $balance_outs);
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
            $balance_outs = BalanceOut::findOrFail($id);		
		
			return view('staffview.balance_outs.edit')
				->with('balance_outs', $balance_outs);
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
				'brand_name' => 'required|unique:balance_outs,brand_name,'.$id,
			]);

            $balance_outs = BalanceOut::findOrFail($id);	

			$balance_outs->brand_name = $request->input('brand_name');
            $balance_outs->save();
		
			return redirect()->route('balance_outs.index')->with('success', "$balance_outs->brand_name berhasil diubah.");
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
            $balance_outs = BalanceOut::findOrFail($id);	

			$balance_outs->delete();
		
			return redirect()->route('balance_outs.index')->with('success', "$balance_outs->brand_name berhasil dihapus");
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
