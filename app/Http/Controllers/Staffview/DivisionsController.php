<?php

namespace App\Http\Controllers\Staffview;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Division;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DivisionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		// get all the items
        $divisions = Division::all();

        // load the view and pass the items        

        return view('staffview.divisions.list')
			->with('divisions', $divisions);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('staffview.divisions.create');
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
			'division_name' => 'required|unique:divisions,division_name',
			'image' => 'required|image|mimes:jpg,jpeg,bmp,png|max:2000',
		]);
		
		$temp1 = $request->image->store('public/images/divisions');
		$file1 = explode("/",$temp1);

		$division = Division::create([
			'division_name' =>  $request->input('division_name'),
			'image' => $file1[3],
			'mod_user' =>  \Auth::User()->name(),
		]);
	
        return redirect()->route('divisions.index')->with('success', "$division->division_name berhasil ditambahkan.");
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
            $divisions = Division::findOrFail($id);		
		
			return view('staffview.divisions.delete')
				->with('divisions', $divisions);
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
            $divisions = Division::findOrFail($id);		
		
			return view('staffview.divisions.edit')
				->with('divisions', $divisions);
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
				'division_name' => 'required|unique:divisions,division_name,'.$id,
				'image' => 'required|image|mimes:jpg,jpeg,bmp,png|max:2000',
			]);
			
			if($request->hasFile('image')){
				$temp = $request->photo_1->store('public/images/divisions');
				$file = explode("/",$temp);
			}
			
			$file="";

            $divisions = Division::findOrFail($id);	

			$divisions->division_name = $request->input('division_name');
			$divisions->mod_user = \Auth::user()->name;	
			$divisions->image = $file[3];
            $divisions->save();
		
			return redirect()->route('divisions.index')->with('success', "$divisions->division_name berhasil diubah.");
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
            $divisions = Division::findOrFail($id);	
			$divisions->mod_user = \Auth::user()->name;	
			$divisions->save();
			$divisions->delete();
		
			return redirect()->route('divisions.index')->with('success', "$divisions->division_name berhasil dihapus");
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
