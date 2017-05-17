<?php

namespace App\Http\Controllers\Staffview;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\Address;
use App\Model\District;
use App\Model\Regency;
use App\Model\Province;
use App\Model\Country;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		// get all the items
        $temp = User::All();
		$customers = array();
		
		foreach ($temp as $row) {
			if($row->hasRole('user')){
				array_push($customers,$row);
			}
		}
        // load the view and pass the items        

        return view('staffview.customers.list')
			->with('customers', $customers);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('staffview.customers.create');
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
			'password' => 'required|confirmed',			
		]);

		$user = User::create([
			'name' =>  $request->input('name'),
			'email' => $request->input('email'),
			'date_of_birth' => $request->input('date_of_birth'),
			'gender' => $request->input('gender'),
			'phone' => $request->input('phone'),			
			'password' => bcrypt('password'),
		]);
	
        return redirect()->route('customers.index')->with('success', "$User->name berhasil ditambahkan.");
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
            $customers = User::findOrFail($id);		
		
			return view('staffview.customers.delete')
				->with('customers', $customers);
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
            $customers = User::findOrFail($id);		
		
			return view('staffview.customers.edit')
				->with('customers', $customers);
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
				'email' => 'required|unique:users,email,'.$id,
				'date_of_birth' => 'required|date',
				'gender' => 'required|boolean',
				'phone' => 'required|integer',	
			]);

            $customers = User::findOrFail($id);	

			$customers->name = $request->input('name');
			$customers->email  = $request->input('email');
			$customers->date_of_birth  = $request->input('date_of_birth');
			$customers->gender  = $request->input('gender');
			$customers->phone  = $request->input('phone');	
            $customers->save();
		
			return redirect()->route('customers.index')->with('success', "$customers->name berhasil diubah.");
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
            $customers = User::findOrFail($id);	

			$customers->delete();
		
			return redirect()->route('customers.index')->with('success', "$customers->name berhasil dihapus");
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
     * Display a listing of the balance for a user.
     *
     * @return \Illuminate\Http\Response
     */
    public function balance($id)
    {
		// get all the items
		 try{
            $customers = User::findOrFail($id);	
			$balance = array();
			$total = 0.0;
			
			foreach($customers->balance_in as $row){
				$temp = [
					$row,
					'in',
				];
				$total = $total + $row->amount;
				array_push($balance,$temp);
			}
			
			foreach($customers->balance_out as $row){
				$temp = [
					$row,
					'out',
				];
				$total = $total - $row->amount;
				array_push($balance,$temp);
			}
			
			$params = [
				'balances' => $balance,
				'total' => $total,
			];
			
		// load the view and pass the items 
        return view('staffview.customers.balance')
			->with($params);;
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
