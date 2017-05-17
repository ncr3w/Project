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
			'name' => 'required',
			'email' => 'required|unique:users,email',
			'date_of_birth' => 'required|date',
			'gender' => 'required|boolean',
			'phone' => 'required|integer',			
			'address' => 'required',
			'postal_code' => 'required|integer',
			'role' => 'required|integer',
			'province_name' => 'required',
			'regency_name' => 'required',
			'district_name' => 'required',
			'password' => 'required|confirmed',
		]);

		$user = User::create([
			'name' =>  $request->input('name'),
			'email' => $request->input('email'),
			'date_of_birth' => $request->input('date_of_birth'),
			'gender' => $request->input('gender'),
			'phone' => $request->input('phone'),			
			'password' => bcrypt($request->input('password')),
			'mod_user' =>  \Auth::User()->name,
		]);
		
		$address = Address::create([			
			'id_district' => $request->input('district_name'),
			'id_user' => $user->id,
			'address' =>  $request->input('address'),
			'phone' => $request->input('phone_address'),
			'postal_code' => $request->input('postal_code'),
			'mod_user' =>  \Auth::User()->name,
		]);
		
		$user->attachRole($request->input('role'));		
	
        return redirect()->route('staffs.index')->with('success', "$user->name berhasil ditambahkan.");
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
			$provinces = Province::all();
			$districts = District::all();
			$regencies = Regency::all();
			$roles = Role::all();
			$address = $staffs->address;
			$provid = $address[0]->district->regency->province->id;
			$regid = $address[0]->district->regency->id;
			$distid = $address[0]->district->id;
		
			$params = [
				'staffs' => $staffs,
				'provinces' => $provinces,
				'districts' => $districts,
				'regencies' => $regencies,
				'roles' => $roles,
				'address' => $address[0],
				'provid' => $provid ,
				'regid' => $regid,
				'distid' => $distid,
			];
		
			return view('staffview.staffs.edit')
				->with($params);
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
			'name' => 'required',
			'role' => 'required|integer',
			'email' => 'required|unique:users,email',
			'date_of_birth' => 'required|date',
			'gender' => 'required|boolean',
			'phone' => 'required|integer',			
			'address' => 'required',
			'postal_code' => 'required|integer',
			'phone_address' => 'required',			
			'province_name' => 'required',
			'regency_name' => 'required',
			'district_name' => 'required',
		]);

            $staffs = User::findOrFail($id);
			$address = $staff->address;

			$staffs->name = $request->input('name');
			$staffs->email = $request->input('email');
			$staffs->date_of_birth = $request->input('date_of_birth');
			$staffs->gender =  $request->input('gender');
			$staffs->phone = $request->input('phone');	
			$staff->mod_user = \Auth::User()->name;
			$staffs -> save();		
		
			$address[0]->id_district = $request->input('district_name');
			$address[0]->id_user = $staffs->id;
			$address[0]->address =  $request->input('address');
			$address[0]->phone_address =  $request->input('phone_address');
			$address[0]->postal_code = $request->input('postal_code');
			$address[0]->mod_user = \Auth::User()->name;
			$adddres[0] -> save();
		
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
			
			$staffs->detachRoles($staffs->roles);
			$staffs->detachPermissions($staffs->permissions);
			
			$address = $staffs->address;
		
			foreach($address as $row){
				$row->delete();
			}
			
			$staffs->mod_user = \Auth::User()->name;
			$staffs->save();
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
	
	 /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function password($id)
    {
		try{
			$staffs = User::findOrFail($id);
			return view('staffview.staffs.password')
				->with('staffs',$staffs);
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function password_store($id)
    {
		try{
			$staffs = User::findOrFail($id);
			
			$this->validate($request, [
				'password' => 'required|confirmed',
			]);
			
			$staff->password = bcrypt($request->input('password'));
			$staff->mod_user = \Auth::User()->name;
			$staff->save();
			
			return redirect()->route('staffs.password',[ id => $id])->with('success', "password berhasil diubah.");
			
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
