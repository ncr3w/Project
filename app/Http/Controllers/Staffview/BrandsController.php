<?php

namespace App\Http\Controllers\Staffview;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		// get all the items
        $brands = Brand::all();

        // load the view and pass the items        

        return view('staffview.brands.list')
			->with('brands', $brands);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('staffview.brands.create');
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
			'brand_name' => 'required|unique:brands,brand_name',
			'image' => 'required|image|mimes:jpg,jpeg,bmp,png|max:2000',
		]);
		
		$temp1 = $request->image->store('public/images/brands');
		$file1 = explode("/",$temp1);

		$brand = Brand::create([
			'brand_name' =>  $request->input('brand_name'),
			'image' => $file1[3],
			'mod_user' =>  \Auth::User()->name(),
		]);
	
        return redirect()->route('brands.index')->with('success', "$brand->brand_name berhasil ditambahkan.");
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
            $brands = Brand::findOrFail($id);		
		
			return view('staffview.brands.delete')
				->with('brands', $brands);
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
            $brands = Brand::findOrFail($id);		
		
			return view('staffview.brands.edit')
				->with('brands', $brands);
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
				'brand_name' => 'required|unique:brands,brand_name,'.$id,
				'image' => 'image|mimes:jpg,jpeg,bmp,png|max:2000',
			]);

            $brands = Brand::findOrFail($id);
			
			$file="";

			if($request->hasFile('image')){
				$temp = $request->photo_1->store('public/images/brands');
				$file = explode("/",$temp);
			}

			$brands->brand_name = $request->input('brand_name');
			$brands->mod_user = \Auth::user()->name;	
			$brands->image = $file[3];
            $brands->save();
		
			return redirect()->route('brands.index')->with('success', "$brands->brand_name berhasil diubah.");
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
            $brands = Brand::findOrFail($id);	
			$brands->mod_user = \Auth::user()->name;	
			$brands->save();
			$brands->delete();
		
			return redirect()->route('brands.index')->with('success', "$brands->brand_name berhasil dihapus");
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
