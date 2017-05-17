<?php

namespace App\Http\Controllers\Location;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AddressController extends Controller
{
   	/**
	 * Get the Address from db and return it as JSON
	 *
	 * @param int id province
	 * @return \Illuminate\Http\Response
	 */
	public function getAddress($email){		
		$user = User::where('email','=',$email)->first();
		if($user != null){
			$data = $user->address;
			if($data != null){
				return response()->json(['success' => true, 'data' => $data, 'user' => $user->id,'check' => true]);
			}else{
				return response()->json(['success' => true, 'user' => "-2",'check' => false]);
			}
		}else{
			return response()->json(['success' => true, 'user' => "-1",'check' => false]);
		}
	}
}
