<?php

namespace App\Http\Controllers\Staffview;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\Models\Address;
use App\Models\District;
use App\Models\Regency;
use App\Models\Province;
use App\Models\Country;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		// get all the items
        $temp = Address::all();
		$addresses = array();
		
		foreach ($temp as $row) {
			if($row->hasRole(['superadmin','admin'])){
				array_push($addresses,$row);
			}
		}
		
        // load the view and pass the items        

        return view('staffview.address.list')
			->with('addresses', $addresses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function create() 
	{	
		$provinces = Province::all();
		
		$params = [
            'provinces' => $provinces,
		];

		return view('staffview.address.create')
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
			'address' => 'required',
			'postal_code' => 'required|integer',
			'province_name' => 'required',
			'regency_name' => 'required',
			'district_name' => 'required',
		]);
		
		$address = Address::create([			
			'id_district' => $request->input('district_name'),
			'name' => $request->input('name'),
			'address' =>  $request->input('address'),
			'phone' => $request->input('phone_address'),
			'postal_code' => $request->input('postal_code'),
		]);
		
		$user->attachRole($request->input('role'));		
	
        return redirect()->route('addresses.index')->with('success', "$user->name berhasil ditambahkan.");
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
            $addresses = Address::findOrFail($id);		
		
			return view('staffview.address.delete')
				->with('addresses', $addresses);
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
            $address = Address::findOrFail($id);	
			$provinces = Province::all();			
			$districts = District::all();
			$regencies = Regency::all();
			$provid = $address->district->regency->province->id;
			$regid = $address->district->regency->id;
			$distid = $address->district->id;
		
			$params = [
				'provinces' => $provinces,
				'districts' => $districts,
				'regencies' => $regencies,
				'address' => $address,
				'provid' => $provid ,
				'regid' => $regid,
				'distid' => $distid,
			];
		
			return view('staffview.address.edit')
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
				'address' => 'required',
				'postal_code' => 'required|integer',
				'phone_address' => 'required',			
				'province_name' => 'required',
				'regency_name' => 'required',
				'district_name' => 'required',
			]);

            $address = Address::findOrFail($id);	

			$address->name = $request->input('name');
			$address->id_district = $request->input('district_name');
			$address->address =  $request->input('address');
			$address->phone_address =  $request->input('phone_address');
			$address->postal_code = $request->input('postal_code');
			$adddres -> save();
		
			return redirect()->route('address.show', ['id' =>  $id ])->with('success', "$addresses->name berhasil diubah.");
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
            $addresses = Address::findOrFail($id);
				
			$addresses->delete();
		
			return redirect()->route('address.show', ['id' =>  $id ])->with('success', "$addresses->address berhasil dihapus");
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
