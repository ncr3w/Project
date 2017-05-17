<?php

namespace App\Http\Controllers\Staffview;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\InvoiceDetail;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class InvoicesDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		// get all the items
        $invoice_details = InvoiceDetail::all();

        // load the view and pass the items        

        return view('staffview.invoice_details.list')
			->with('invoice_details', $invoice_details);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('staffview.invoice_details.create');
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
			'brand_name' => 'required|unique:invoice_details,brand_name'
		]);

		$brand = InvoiceDetail::create([
			'brand_name' =>  $request->input('brand_name'),
		]);
	
        return redirect()->route('invoice_details.index')->with('success', "$brand->brand_name berhasil ditambahkan.");
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
            $invoice_details = InvoiceDetail::findOrFail($id);		
		
			return view('staffview.invoice_details.delete')
				->with('invoice_details', $invoice_details);
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
            $invoice_details = InvoiceDetail::findOrFail($id);		
		
			return view('staffview.invoice_details.edit')
				->with('invoice_details', $invoice_details);
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
				'brand_name' => 'required|unique:invoice_details,brand_name,'.$id,
			]);

            $invoice_details = InvoiceDetail::findOrFail($id);	

			$invoice_details->brand_name = $request->input('brand_name');
            $invoice_details->save();
		
			return redirect()->route('invoice_details.index')->with('success', "$invoice_details->brand_name berhasil diubah.");
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
            $invoice_details = InvoiceDetail::findOrFail($id);	

			$invoice_details->delete();
		
			return redirect()->route('invoice_details.index')->with('success', "$invoice_details->brand_name berhasil dihapus");
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
