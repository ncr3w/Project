<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Ask;

class ProductViewController extends Controller
{
	
	    /**
     * Show all asks
     *
     * @return \Illuminate\Http\Response
     */
	
	public function index()
    {	
		try{
			$asks = Ask::all();
			
			$params = [
				'asks' => $asks,
			];
			
			return view('product.browse')
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
     * Show the product details
     *
     * @return \Illuminate\Http\Response
     */
	
	public function newproduct($article)
    {	
		try{
			$product = Product::where('article','=',$article)->first();
			$asks = Ask::where([['id_product','=',$product->id],['type','=','New']])->get();
			
			$params = [
				'product' => $product,
				'asks' => $asks,
			];
			
			return view('product.new_product')
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
     * Show the asks details for a used product
     *
     * @return \Illuminate\Http\Response
     */
	
	public function usedproduct($article,$name,$id){
		try{
			$ask = Ask::findOrFail($id);	
			$params = [
				'ask' => $ask,
			];
			
			return view('product.used_product')
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
}
