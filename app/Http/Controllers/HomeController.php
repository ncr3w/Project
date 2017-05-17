<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Ask;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
	
	public function index()
    {		
	
		$to =  date("Y/m/d");
		$from =  date('Y-m-d', strtotime($to. " -1 month"));

		$popular = Product::whereBetween('created_at', array($from, $to))->orderBy('number_sold', 'DESC')->take(4)->get();
		
		$to =  date("Y/m/d");
		$from =  date('Y-m-d', strtotime($to. " -1 week"));
		
		$recent_lowest_asks = Ask::whereBetween('created_at', array($from, $to))->orderBy('ask_amount', 'DESC')->take(4)->get();
		
		$params = [
            'popular' => $popular,
            'recent_lowest_asks' => $recent_lowest_asks,
		];
		
        return view('user_home')
			->with($params);
    }
}
