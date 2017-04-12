<?php

namespace App\Http\Controllers\Location;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\District;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DistrictsController extends Controller
{
	/**
	 * Get the Districts from db and return it as JSON
	 *
	 * @param int id regency
	 * @return \Illuminate\Http\Response
	 */
	public function getDistricts($id){
		$data = DB::table('districts')->where('id_regency', '=', $id)->get();
		return response()->json(['success' => true, 'data' => $data]);
	}
 
}
