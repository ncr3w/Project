<?php

namespace App\Http\Controllers\Staffview;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Role;
use App\User;
use App\Permission;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RolesController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
		// get all the items
        $roles = Role::all();

        // load the view and pass the items        

        return view('staffview.roles.list')
			->with('roles', $roles);;
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
		$roles = Role::all();
        $permissions = Permission::all();
		
		$params = [
            'roles' => $roles,
            'permissions' => $permissions,
		];
		
        return view('staffview.roles.create')
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
			'name' => 'required|unique:roles,name',
			'display_name' => 'required|unique:roles,display_name',
		]);

		$role = Role::create([			
			'name' =>  $request->input('name'),
			'display_name' =>  $request->input('display_name'),
			'description' =>  $request->input('description'),
		]);	
		
		$permissions = Input::get('permissions');
		foreach($permissions as $row){
			$role->attachPermission($row);
		}

        return redirect()->route('roles.index')->with('success', "$role->display_name berhasil ditambahkan.");
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
            $roles = Role::findOrFail($id);		
		
			return view('staffview.roles.delete')
				->with('roles', $roles);
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
            $roles = Role::findOrFail($id);		
			
			$permissions = Permission::all();
		
			$params = [
				'roles' => $roles,
				'permissions' => $permissions,
			];
		
			return view('staffview.roles.edit')
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
		
			$roles = Role::findOrFail($id);	

			$this->validate($request, [
				'name' => 'required|unique:roles,name,'.$id,
				'display_name' => 'required|unique:roles,display_name,'.$id,
			]);     			
			
			$roles->name = $request->input('name');
			$roles->display_name = $request->input('display_name');
			$roles->description = $request->input('description');
            $roles->save();			

			return redirect()->route('roles.index')->with('success', "$roles->display_name berhasil diubah.");
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
            $roles = Role::findOrFail($id);	

			$roles->delete();
		
			return redirect()->route('roles.index')->with('success', "$roles->display_name berhasil dihapus");
		}
		catch (ModelNotFoundException $ex) 
        {
            if ($ex instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }
	
	   public function showpermission($id)
    {
		 try{
            $roles = Role::findOrFail($id);		
			
			$permissions = Permission::all();
		
			$params = [
				'roles' => $roles,
				'permissions' => $permissions,
			];
		
			return view('staffview.roles.permission')
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
	
	
    public function editpermission(Request $request, $id)
    {
		 try{
			
			$roles = Role::findOrFail($id);	

			$this->validate($request, [
				'name' => 'required|unique:roles,name,'.$id,
				'display_name' => 'required|unique:roles,display_name,'.$id,
			]);     			
			
			$roles->name = $request->input('name');
			$roles->display_name = $request->input('display_name');
			$roles->description = $request->input('description');
            $roles->save();		
			
			$permissiondb = Permission::all();
			foreach($permissiondb as $row){
				$roles->detachPermission($row->id);
			}

			$permissions = Input::get('permissions');
			foreach($permissions as $row){
				$roles->attachPermission($row);
			}
		
			return redirect()->route('roles.index')->with('success', "$roles->name permission berhasil diubah");
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
