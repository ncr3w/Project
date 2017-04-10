<?php

namespace App\Http\Controllers\Staffview;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use App\Permission;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		// get all the items
        $permissions = Permission::all();

        // load the view and pass the items        

        return view('staffview.permissions.list')
			->with('permissions', $permissions);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('staffview.permissions.create');
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
			'name' => 'required|unique:permissions,name',
			'display_name' => 'required|unique:permissions,display_name',
		]);

		$permission = Permission::create([			
			'name' =>  $request->input('name'),
			'display_name' =>  $request->input('display_name'),
			'description' =>  $request->input('description'),
		]);	
	
        return redirect()->route('permissions.index')->with('success', "$permission->display_name berhasil ditambahkan.");
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
            $permissions = Permission::findOrFail($id);		
		
			return view('staffview.permissions.delete')
				->with('permissions', $permissions);
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
            $permissions = Permission::findOrFail($id);		
		
			return view('staffview.permissions.edit')
				->with('permissions', $permissions);
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
			
			$permissions = Permission::findOrFail($id);	

			$this->validate($request, [
				'name' => 'required|unique:permissions,name,'.$id,
				'display_name' => 'required|unique:permissions,display_name,'.$id,
			]);   				
			
			$permissions->name = $request->input('name');
			$permissions->display_name = $request->input('display_name');
			$permissions->description = $request->input('description');
            $permissions->save();
		
			return redirect()->route('permissions.index')->with('success', "$permissions->display_name berhasil diubah.");
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
            $permissions = Permission::findOrFail($id);	

			$permissions->delete();
		
			return redirect()->route('permissions.index')->with('success', "$permissions->display_name berhasil dihapus");
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
