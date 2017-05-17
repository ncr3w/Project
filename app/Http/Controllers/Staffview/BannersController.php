<?php

namespace App\Http\Controllers\Staffview;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BannersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		// get all the items
        $banners = Banner::all();

        // load the view and pass the items        

        return view('staffview.banners.list')
			->with('banners', $banners);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('staffview.banners.create');
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
			'banner' => 'required|image|mimes:jpg,jpeg,bmp,png|max:2000',
		]);
		
		$temp1 = $request->banner->store('public/images/banners');
		$filename = explode("/",$temp1);

		$banner = Banner::create([
			'used' => 1,
			'banner' => $filename[3],
		]);
	
        return redirect()->route('banners.index')->with('success', "$banner->brand_name berhasil ditambahkan.");
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
            $banners = Banner::findOrFail($id);		
		
			return view('staffview.banners.delete')
				->with('banners', $banners);
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
            $banners = Banner::findOrFail($id);		
		
			return view('staffview.banners.edit')
				->with('banners', $banners);
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

			$this->validate($request,[
				'used' => 'required|boolean',
				'banner' => 'image|mimes:jpg,jpeg,bmp,png|max:2000',				
			]);

            $banners = Banner::findOrFail($id);	
			
			if($request->hasFile('banner')){
				$temp = $request->banner->store('public/images/banners');
				$filename = explode("/",$temp);
				$banners->banner = $filename[3];
			}

			$banners->used = $request->input('used');
            $banners->save();
		
			return redirect()->route('banners.index')->with('success', "$banners->brand_name berhasil diubah.");
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
            $banners = Banner::findOrFail($id);	

			$banners->delete();
		
			return redirect()->route('banners.index')->with('success', "$banners->brand_name berhasil dihapus");
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
