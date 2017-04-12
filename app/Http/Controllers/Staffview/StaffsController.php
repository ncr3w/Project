<?php

namespace App\Http\Controllers\Staffview;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Models\Address;
use App\Models\District;
use App\Models\Regency;
use App\Models\Province;
use App\Models\Country;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class StaffsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		// get all the items
        $temp = User::all();
		$staffs = array();
		
		foreach ($temp as $row) {
			if($row->hasRole(['superadmin','admin'])){
				array_push($staffs,$row);
			}
		}
		
        // load the view and pass the items        

        return view('staffview.staffs.list')
			->with('staffs', $staffs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function create() 
	{	
		$provinces = Province::all();
		$roles = Role::all();
		
		$params = [
            'provinces' => $provinces,
            'roles' => $roles,
		];

		return view('staffview.staffs.create')
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
			'name' => 'required|unique:staffs,name'
		]);

		$User = User::create([
			'name' =>  $request->input('name'),
		]);
	
        return redirect()->route('staffs.index')->with('success', "$User->name berhasil ditambahkan.");
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
            $staffs = User::findOrFail($id);		
		
			return view('staffview.staffs.delete')
				->with('staffs', $staffs);
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
            $staffs = User::findOrFail($id);		
		
			return view('staffview.staffs.edit')
				->with('staffs', $staffs);
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
				'name' => 'required|unique:staffs,name,'.$id,
			]);

            $staffs = User::findOrFail($id);	

			$staffs->name = $request->input('name');
            $staffs->save();
		
			return redirect()->route('staffs.index')->with('success', "$staffs->name berhasil diubah.");
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
            $staffs = User::findOrFail($id);	

			$staffs->delete();
		
			return redirect()->route('staffs.index')->with('success', "$staffs->name berhasil dihapus");
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
