<?php

namespace App\Http\Controllers\Staffview;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Division;
use App\Models\Photo;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		// get all the items
        $products = Product::all();


        // load the view and pass the items        

        return view('staffview.products.list')
			->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()	
    {
		$brands = Brand::all();
        $divisions = Division::all();
		
		$params = [
            'brands' => $brands,
            'divisions' => $divisions,
		];
		
        return view('staffview.products.create')
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
			'article' => 'required|unique:products,article',
			'brand_name' => 'required|exists:brands,id',
			'division_name' => 'required|exists:divisions,id',
			'gender' => 'required|boolean',
			'product_name' => 'required',
			'alias' => 'required',
			'color' => 'required',
			'retail_price' => 'required',
			'photo_1' => 'required|image|mimes:jpg,jpeg,bmp,png|max:2000',
			'photo_2' => 'required|image|mimes:jpg,jpeg,bmp,png|max:2000',
			'photo_3' => 'required|image|mimes:jpg,jpeg,bmp,png|max:2000',
		]);
		
		$temp1 = $request->photo_1->store('public/images/products');
		$temp2 = $request->photo_2->store('public/images/products');
		$temp3 = $request->photo_3->store('public/images/products');
		$file1 = explode("/",$temp1);
		$file2 = explode("/",$temp2);
		$file3 = explode("/",$temp3);

		$photo = Photo::create([
			'photo_1' => $file1[3],
			'photo_2' => $file2[3],
			'photo_3' => $file3[3],
		])->id;
		
		$product = Product::create([
			'product_name' =>  $request->input('product_name'),
			'article' => $request->input('article'),
			'alias' => $request->input('alias'),
			'color' => $request->input('color'),
			'retail_price' => $request->input('retail_price'),
			'gender' => $request->input('gender'),
			'id_brand' => $request->input('brand_name'),
			'id_division' => $request->input('division_name'),
			'id_photo' => $photo,
		]);
	
        return redirect()->route('products.index')->with('success', "$product->product_name berhasil ditambahkan.");
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
            $products = Product::findOrFail($id);		
		
			return view('staffview.products.delete')
				->with('products', $products);
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
			$brands = Brand::all();
			$divisions = Division::all();	
			$products = Product::findOrFail($id);			
		
			$params = [
				'brands' => $brands,
				'divisions' => $divisions,
				'products' => $products,
			];
            	
		
			return view('staffview.products.edit')
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
			
			$this->validate($request, [
				'article' => 'required|unique:products,article,'.$id,
				'brand_name' => 'required|exists:brands,id',
				'division_name' => 'required|exists:divisions,id',
				'gender' => 'required|boolean',
				'product_name' => 'required',
				'alias' => 'required',
				'color' => 'required',
				'retail_price' => 'required',
				'photo_1' => 'image|mimes:jpg,jpeg,bmp,png|max:2000',
				'photo_2' => 'image|mimes:jpg,jpeg,bmp,png|max:2000',
				'photo_3' => 'image|mimes:jpg,jpeg,bmp,png|max:2000',
			]);
			
			$products = Product::findOrFail($id);	
			$photo = Photo::findOrFail($products->id_photo);
			
			if($request->hasFile('photo_1')){
				$temp = $request->photo_1->store('public/images/products');
				$file = explode("/",$temp);
				$photo->photo_1 = $file[3];
				$photo->save();
			}

			if($request->hasFile('photo_2')){
				$temp = $request->photo_2->store('public/images/products');
				$file = explode("/",$temp);
				$photo->photo_2 = $file[3];
				$photo->save();
			}  
			
			if($request->hasFile('photo_3')){
				$temp = $request->photo_3->store('public/images/products');
				$file = explode("/",$temp);
				$photo->photo_3 = $file[3];
				$photo->save();
			}  

			$products->product_name = $request->input('product_name');
			$products->article = $request->input('article');
			$products->alias = $request->input('alias');
			$products->color = $request->input('color');
			$products->retail_price = $request->input('retail_price');
			$products->gender = $request->input('gender');
			$products->id_brand = $request->input('brand_name');
			$products->id_division = $request->input('division_name');			
            $products->save();
		
			return redirect()->route('products.index')->with('success', "$products->product_name berhasil diubah.");
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
            $products = Product::findOrFail($id);	

			$products->delete();
		
			return redirect()->route('products.index')->with('success', "$products->product_name berhasil dihapus");
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
