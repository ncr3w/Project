<?php

namespace App\Http\Controllers\Staffview;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductDetail;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		// get all the items
        $product_details = ProductDetail::all();

        // load the view and pass the items        

        return view('staffview.product_details.list')
			->with('product_details', $product_details);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('staffview.product_details.create');
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
			'brand_name' => 'required|unique:product_details,brand_name'
		]);

		$brand = ProductDetail::create([
			'brand_name' =>  $request->input('brand_name'),
		]);
	
        return redirect()->route('product_details.index')->with('success', "$brand->brand_name berhasil ditambahkan.");
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
            $product_details = ProductDetail::findOrFail($id);		
		
			return view('staffview.product_details.delete')
				->with('product_details', $product_details);
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
            $product_details = ProductDetail::findOrFail($id);		
		
			return view('staffview.product_details.edit')
				->with('product_details', $product_details);
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
				'brand_name' => 'required|unique:product_details,brand_name,'.$id,
			]);

            $product_details = ProductDetail::findOrFail($id);	

			$product_details->brand_name = $request->input('brand_name');
            $product_details->save();
		
			return redirect()->route('product_details.index')->with('success', "$product_details->brand_name berhasil diubah.");
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
            $product_details = ProductDetail::findOrFail($id);	

			$product_details->delete();
		
			return redirect()->route('product_details.index')->with('success', "$product_details->brand_name berhasil dihapus");
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
