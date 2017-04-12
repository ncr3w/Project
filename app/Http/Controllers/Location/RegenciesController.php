<?php

namespace App\Http\Controllers\Location;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Regency;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RegenciesController extends Controller
{
	/**
	 * Get the Regencies from db and return it as JSON
	 *
	 * @param int id province
	 * @return \Illuminate\Http\Response
	 */
	public function getRegencies($id){
		$data = DB::table('regencies')->where('id_province', '=', $id)->get();
		return response()->json(['success' => true, 'data' => $data]);
	}
}
