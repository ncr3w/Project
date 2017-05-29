<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Ask;

class ProductViewController extends Controller
{

	 /**
     * Show all asks
     *
     * @return \Illuminate\Http\Response
     */

	public function browseallnew()
    {
		try{
			$query = DB::table('asks')->where('type','=','New')->join('products', 'products.id', '=', 'asks.id_product')->join('photos','photos.id','=','products.id_photo');

			$result = $query->groupBy('products.id')->get();

			return view('product.browse')
				->with('result',$result);
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
     * Show filterd asks
     *
     * @return \Illuminate\Http\Response
     */

	public function browsenew($params)
    {
		try{

			$brand = null;
			$gender = null;
			$size = null;
			$pricefrom = null;
			$priceto = null;

			$array = explode('/', $params);
			foreach($array as $row){
				$temp = explode('-',$row);
				$brand = ($temp[0] == "Brand" && preg_match('/^[A-Za-z\s]+$/',$temp[1])) ? Brand::where('brand_name','=',$temp[1])->first()->id : $brand;
				$gender = ($temp[0] == "Gender" && preg_match('/^Men$|^Women$/',$temp[1])) ? ($temp[1] == 'Men')? 0 : 1 : $gender;
				$size = ($temp[0] == "Size" && preg_match('/^[0-9.]+$/',$temp[1])) ? $temp[1] : $size;
				$pricefrom = ($temp[0] == "Price" && preg_match('/^[0-9.]+$/',$temp[1])) ? $temp[1] : $pricefrom;
				$priceto = ($temp[0] == "Price" && preg_match('/^[0-9.]+$/',$temp[1])) ? $temp[2] : $priceto;
			}

			$query = DB::table('asks')->where('type','=','New')->join('products', 'products.id', '=', 'asks.id_product')->join('photos','photos.id','=','products.id_photo');

			if(isset($brand)){
				$query->where('id_brand','=',$brand);
			}

			if(isset($priceto)){
				$query->where('ask_amount','>=',$pricefrom)->where('ask_amount','<=',$priceto);
			}

			if(isset($gender)){
				$query->where('gender','=',$gender);
			}

			if(isset($size)){
				$query->where('size','=',$size);
			}

			$result = $query->groupBy('products.id')->get();
			return view('product.browse')
				->with('result',$result);

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
