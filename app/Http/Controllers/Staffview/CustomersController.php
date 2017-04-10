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
        $users = User::all();

        // load the view and pass the items        

        return view('staffview.users.list')
			->with('users', $users);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('staffview.users.create');
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
			'name' => 'required|unique:users,name'
		]);

		$User = User::create([
			'name' =>  $request->input('name'),
		]);
	
        return redirect()->route('users.index')->with('success', "$User->name berhasil ditambahkan.");
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
            $users = User::findOrFail($id);		
		
			return view('staffview.users.delete')
				->with('users', $users);
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
            $users = User::findOrFail($id);		
		
			return view('staffview.users.edit')
				->with('users', $users);
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
				'name' => 'required|unique:users,name,'.$id,
			]);

            $users = User::findOrFail($id);	

			$users->name = $request->input('name');
            $users->save();
		
			return redirect()->route('users.index')->with('success', "$users->name berhasil diubah.");
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
            $users = User::findOrFail($id);	

			$users->delete();
		
			return redirect()->route('users.index')->with('success', "$users->name berhasil dihapus");
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
