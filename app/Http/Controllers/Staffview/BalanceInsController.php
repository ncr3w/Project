<?php

namespace App\Http\Controllers\Staffview;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BalanceIn;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BalanceInsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		// get all the items
        $balance_ins = BalanceIn::all();

        // load the view and pass the items        

        return view('staffview.balance_ins.list')
			->with('balance_ins', $balance_ins);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('staffview.balance_ins.create');
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
			'brand_name' => 'required|unique:balance_ins,brand_name'
		]);

		$brand = BalanceIn::create([
			'brand_name' =>  $request->input('brand_name'),
		]);
	
        return redirect()->route('balance_ins.index')->with('success', "$brand->brand_name berhasil ditambahkan.");
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
            $balance_ins = BalanceIn::findOrFail($id);		
		
			return view('staffview.balance_ins.delete')
				->with('balance_ins', $balance_ins);
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
            $balance_ins = BalanceIn::findOrFail($id);		
		
			return view('staffview.balance_ins.edit')
				->with('balance_ins', $balance_ins);
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
				'brand_name' => 'required|unique:balance_ins,brand_name,'.$id,
			]);

            $balance_ins = BalanceIn::findOrFail($id);	

			$balance_ins->brand_name = $request->input('brand_name');
            $balance_ins->save();
		
			return redirect()->route('balance_ins.index')->with('success', "$balance_ins->brand_name berhasil diubah.");
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
            $balance_ins = BalanceIn::findOrFail($id);	

			$balance_ins->delete();
		
			return redirect()->route('balance_ins.index')->with('success', "$balance_ins->brand_name berhasil dihapus");
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
