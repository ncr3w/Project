<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Division;
use App\Models\Sport;
use App\Models\Storage;
use App\Models\Blog;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Itemlist;
use App\Models\Paylist;
use App\Models\Customer;
use App\Models\Province;
use App\Models\Ongkir;
use App\Models\Payment;
use App\Models\Account;
use Illuminate\Http\Response;
use DB;

class WebsiteController extends Controller {
	
	function returnForm(){	
		$key='';
		$brands = Brand::where('show','=','1')->get();
		$divisions = Division::where('name', '!=', 'unknown')->get();
		$sports = Sport::where('name', '!=', 'unknown')->get();
		return view('website.return',compact('key','brands', 'divisions', 'sports'));
	}
	function printNota(Request $req,$receipt){
		$trans = Transaction::find($receipt);
		$paylists = Paylist::whereTransaction($receipt)->get();
		foreach($paylists as $pay){
			$acc = Account::find($pay->account);
			$pay->name = $acc->bank." (".$acc->name." - ".$acc->account.")";
		} 
		$itemlists = Itemlist::whereTransaction($receipt)->get();
		return view('website.bon',compact('trans','paylists','itemlists'));
	}
    function confirmationReset(Request $req){
    		if(isset($_COOKIE['nomorTransaksi'])){
    			unset($_COOKIE['nomorTransaksi']);
			// empty value and expiration one hour before$
			$res = setcookie('nomorTransaksi', '', time() - 3600);
			
    			
    		}
    		$key='';
	        $brands = Brand::where('show','=','1')->get();
	        $divisions = Division::where('name', '!=', 'unknown')->get();
	        $sports = Sport::where('name', '!=', 'unknown')->get();
	        $itemlists=[1];
    		return view('website.paymentconfirmation',compact('key','brands', 'divisions', 'sports','itemlists'));
 
    }
    function confirmation(Request $req){
    		if($req->has('konfirmasi')){
    			$payment = new Payment;
    			$payment->transaction = $req->get('transaction');
    			$payment->bank_from = $req->get('bankFrom');
    			$payment->bank_to = $req->get('bankTo');
    			$payment->bank_nama = $req->get('bankNama');
    			$payment->nominal = $req->get('nominal');
    			$payment->transfer_date = $req->get('transferDate');
    			$payment->status = 0;
    			$payment->save();
    			unset($_COOKIE['nomorTransaksi']);
    			$res = setcookie('nomorTransaksi', '', time() - 3600);
		    	$key='';
		        $brands = Brand::where('show','=','1')->get();
		        $divisions = Division::where('name', '!=', 'unknown')->get();
		        $sports = Sport::where('name', '!=', 'unknown')->get();
			$itemlists=[];
    			return view('website.paymentconfirmation',compact('key','brands', 'divisions', 'sports','itemlists'));
    		}
    		else{
    			$itemlists=[1];
    			if(isset($_COOKIE['nomorTransaksi'])){
    				$itemlists = Itemlist::whereTransaction($_COOKIE['nomorTransaksi'])->get();
    				if(count($itemlists)==0){
    					unset($_COOKIE['nomorTransaksi']);
					// empty value and expiration one hour before$
					$res = setcookie('nomorTransaksi', '', time() - 3600);
			
    				}
	    		}
	    		
		    	$key='';
		        $brands = Brand::where('show','=','1')->get();
		        $divisions = Division::where('name', '!=', 'unknown')->get();
		        $sports = Sport::where('name', '!=', 'unknown')->get();
	    		return view('website.paymentconfirmation',compact('key','brands', 'divisions', 'sports','itemlists'));
    		}
    		
    }
    function payment(Request $req){
    	if($req->has('bayar')&&count($req->session()->get('item.sku'))>0){
    		$cust = null;
    		if(!isset($_COOKIE['customer_id'])){
    			$cust = new Customer;
	    		$cust->name = ucwords($_COOKIE['name']);
	    		$city = Ongkir::find($_COOKIE['city_id'])->city;
	    		if(isset($_COOKIE['postcode'])){
	    			$cust->address = ucwords($_COOKIE['address'])." ".$_COOKIE['postcode'].", ".$city.", ".$_COOKIE['province_id'];
	    		} 
	    		else{
	    			$cust->address = ucwords($_COOKIE['address']).", ".$city.", ".$_COOKIE['province_id'];
	    		}
	    		
	    		$cust->phone = $_COOKIE['phone'];
	    		$cust->media = $_COOKIE['email'];
	    		$cust->save();
	    		setcookie("customer_id", $cust->id,time() + (86400 * 7));
    		}
    		else{
    			$cust = Customer::find($_COOKIE['customer_id']);
    			$cust->name = ucwords($_COOKIE['name']);
	    		$city = Ongkir::find($_COOKIE['city_id'])->city;
	    		if(isset($_COOKIE['postcode'])){
	    			$cust->address = ucwords($_COOKIE['address'])." ".$_COOKIE['postcode'].", ".$city.", ".$_COOKIE['province_id'];
	    		} 
	    		else{
	    			$cust->address = ucwords($_COOKIE['address']).", ".$city.", ".$_COOKIE['province_id'];
	    		}
	    		
	    		$cust->phone = $_COOKIE['phone'];
	    		$cust->media = $_COOKIE['email'];
	    		$cust->save();
    		}
    		
    		$trans = new Transaction;
    		$trans->startdate = date('Y-m-d');
    		$trans->enddate = date("Y-m-d");
    		$trans->customer = $cust->id;
    		$ongkir = 0.1;
    		switch( $req->get('selectedOngkir')){
    			case 0: $trans->expedition = "Economic";$ongkir = Ongkir::find($_COOKIE['city_id'])->oke;break;
    			case 1: $trans->expedition = "Reguler";$ongkir = Ongkir::find($_COOKIE['city_id'])->reg;break;
    			case 2: $trans->expedition = "Kilat";$ongkir = Ongkir::find($_COOKIE['city_id'])->yes;break;
    		}
    		$trans->information = $req->get('addtionalinformation');
    		$payment = 0;
    		$weight = 0.1;
    		for($i=0; $i<count($req->session()->get('item.sku'));$i++){
    			$payment+=$req->session()->get('item.qty')[$i]*Storage::whereArticle($req->session()->get('item.sku')[$i])->first()->sell_price;
    			
			if(Storage::whereArticle($req->session()->get('item.sku')[$i])->first()->promotion=='freeongkir'){
				$weight+=0;
			}
    			else if(Storage::whereArticle($req->session()->get('item.sku')[$i])->first()->division==1){
    				$weight+=1.5;
    			}
    			else{
    				$weight+=$req->session()->get('item.qty')[$i]*0.4;
    			}
    		}
    		$asuransi = 0;
    		if($req->get('pakaiasuransi')==1){
    			$asuransi = $req->get('pakaiasuransi')*(0.002*$payment)+5000;
    			$trans->expedition.=" + Asuransi";
    		}
    		$trans->payment = $payment+$ongkir*round($weight)+$asuransi;
    		$trans->status = -1;
    		$trans->save();
    		$trans->payment = $trans->payment+($trans->id%100);
    		$trans->save();
    		for($i=0; $i<count($req->session()->get('item.sku'));$i++){
			$item = new Itemlist();
			$item->transaction = $trans->id;
			$item->article = $req->session()->get('item.sku')[$i];
			$storage = Storage::whereArticle($req->session()->get('item.sku')[$i])->first();
			$item->name = $storage->name." -- ".$storage->color;
			$item->qty = $req->session()->get('item.qty')[$i];
			$item->price = $storage->sell_price;
			$item->size = $req->session()->get('item.size')[$i];
			$item->save();
    		}
    		$item = new Itemlist();
    		$item->transaction = $trans->id;
		$item->article = "ADD-COST";
		$item->name = "Ongkir ".$trans->expedition;
		$item->qty = 1;
		$item->price = $ongkir*round($weight)+$asuransi;
		$item->save();
		$item2 = new Itemlist();
		$item2->transaction = $trans->id;
		$item2->article = "ADD-COST";
		$item2->name = "Kode Verifikasi";
		$item2->qty = 1;
		$item2->price = $trans->id%100;
		$item2->save();
		$array = [];
    		$req->session()->put('item.sku',$array);
    		
    		$req->session()->put('item.name',$array);
    		
    		$req->session()->put('item.price',$array);

    		$req->session()->put('item.size',$array);

    		$req->session()->put('item.qty',$array);

    		$req->session()->put('item.weight',$array);
		$orders = Itemlist::whereTransaction($trans->id)->get();
		$this->sentMail($cust, 0, "", $orders, $trans->payment, $trans, "");
    		
    		
	    	$key='';
	        $brands = Brand::where('show','=','1')->get();
	        $divisions = Division::where('name', '!=', 'unknown')->get();
	        $sports = Sport::where('name', '!=', 'unknown')->get();
	        $statusPage = 'bayar';
	        $nomorTransaksi = $trans->id;
	        $totalPayment = $trans->payment;
	        setcookie("totalPayment",$totalPayment,time() + (86400 * 7));
	        setcookie("nomorTransaksi",$nomorTransaksi,time() + (86400 * 7));
	    	return view('website.payment',compact('key','brands', 'divisions', 'sports','statusPage','nomorTransaksi','totalPayment'));
    	
    	}
    	return redirect("http://ncrsport.com");
    }
    function formorderconfirmation(Request $req){
    	if($req->has('bayar')&&count($req->session()->get('item.sku'))>0){
    		$pakaiasuransi = $req->get('pakaiasuransi');
		$selectedOngkir = $req->get('selectedOngkir');
		$key='';
	        $brands = Brand::where('show','=','1')->get();
	        $divisions = Division::where('name', '!=', 'unknown')->get();
	        $sports = Sport::where('name', '!=', 'unknown')->get();
	        $statusPage = 'choose';
	        $nomorTransaksi = 0;
	        $totalPayment = 0;
    		return view('website.payment',compact('key','brands', 'divisions', 'sports','statusPage','nomorTransaksi','totalPayment','selectedOngkir','pakaiasuransi'));
    		
    	}
    	else if(count($req->session()->get('item.sku'))>0){
		$ongkir = Ongkir::find($req->get('city'));
		
	    	setcookie("name", $req->get('name'),time() + (86400 * 7));
		setcookie("email", $req->get('email'),time() + (86400 * 7));
		setcookie("address", $req->get('address'),time() + (86400 * 7));
		setcookie("city_id", $req->get('city'),time() + (86400 * 7));
		setcookie("province_id", $req->get('province'),time() + (86400 * 7));
		setcookie("phone", $req->get('phoneNumber'),time() + (86400 * 7));
		setcookie("postcode", $req->get('postcode'),time() + (86400 * 7));
		$name = $req->get('name');
		$email = $req->get('email');	
		$address = $req->get('address');
		$city = $req->get('city_name');
		$province = $req->get('province_name');
		$phone = $req->get('phoneNumber');
		$postcode = $req->get('postcode');
		$information = $req->get('information');
	    	$key='';
	        $brands = Brand::where('show','=','1')->get();
	        $divisions = Division::where('name', '!=', 'unknown')->get();
	        $sports = Sport::where('name', '!=', 'unknown')->get();
	        return view('website.formorderconfirmation',compact('key','brands', 'divisions', 'sports','name','email','address','city','province','phone','postcode','information','ongkir'));
        }
        return redirect("http://ncrsport.com");
    }
    function formorder(Request $req){
		if(count($req->session()->get('item.sku'))>0){
			$key='';
		        $brands = Brand::where('show','=','1')->get();
		        $divisions = Division::where('name', '!=', 'unknown')->get();
		        $sports = Sport::where('name', '!=', 'unknown')->get();
		
			$provinces = Province::orderBy('province')->get();
			$city = Ongkir::orderBy('city')->get();
			return view('website.formorder',compact('key','brands', 'divisions', 'sports','provinces','city'));
    		}
    		else{
    			return redirect("http://ncrsport.com");
    		}
    		
  	
    }
    function cart(Request $req){
    	if($req->get("orderCart")!=-1){
    		
    		$array = $req->session()->get('item.sku');
    		unset($array[$req->get("orderCart")]);
    		$array = array_values($array);
    		$req->session()->put('item.sku',$array);
    		
    		$array = $req->session()->get('item.name');
    		unset($array[$req->get("orderCart")]);
    		$array = array_values($array);
    		$req->session()->put('item.name',$array);
    		
    		$array = $req->session()->get('item.price');
    		unset($array[$req->get("orderCart")]);
    		$array = array_values($array);
    		$req->session()->put('item.price',$array);
    		
    		$array = $req->session()->get('item.size');
    		unset($array[$req->get("orderCart")]);
    		$array = array_values($array);
    		$req->session()->put('item.size',$array);
    		
    		$array = $req->session()->get('item.qty');
    		unset($array[$req->get("orderCart")]);
    		$array = array_values($array);
    		$req->session()->put('item.qty',$array);
    		
    		$array = $req->session()->get('item.weight');
    		unset($array[$req->get("orderCart")]);
    		$array = array_values($array);
    		$req->session()->put('item.weight',$array);
    		
    		
    	}
    	return redirect($req->get("url"));
    }
    function blogDetail($id){
        $key='';
        $brands = Brand::where('show','=','1')->get();
        $divisions = Division::where('name', '!=', 'unknown')->get();
        $sports = Sport::where('name', '!=', 'unknown')->get();
        $blog = Blog::find($id);
        $relateds = Storage::where('status','=','rdy')->orderByRaw("RAND()")->take(5)->get();
        return view('website.detailBlog', compact('key','brands', 'divisions', 'sports', 'blog','relateds'));
    }
    function blog(){
         $key='';
        $brands = Brand::where('show','=','1')->get();
        $divisions = Division::where('name', '!=', 'unknown')->get();
        $sports = Sport::where('name', '!=', 'unknown')->get();
        $blogs = Blog::get();
        return view('website.blog', compact('key','brands', 'divisions', 'sports', 'blogs'));
    }
    function index() {
    $key="";
        $brands = Brand::where('show','=','1')->get();
        $divisions = Division::where('name', '!=', 'unknown')->get();
        
        $sports = Sport::where('name', '!=', 'unknown')->get();
        $basketid = Sport::whereName('basket')->first()->id;
        $footballid = Sport::whereName('football')->first()->id;
        $casualid = Sport::whereName('sneakers')->first()->id;
        $runningid = Sport::whereName('lari')->first()->id;
        $basketballs = Storage::where('status','=','rdy')->whereDate('release','<=',date('Y-m-d'))->whereSport($basketid)->orderBy('created_at', 'desc')->take(7)->get();
        $footballs = Storage::where('status','=','rdy')->whereSport($footballid)->orderBy('created_at', 'desc')->take(7)->get();
        $unrelease = Storage::whereDate('release','>',date('Y-m-d'))->orderBy('created_at', 'asc')->take(7)->get();
        $casuals = Storage::where('status','=','rdy')->whereSport($casualid)->orderBy('created_at', 'desc')->take(7)->get();
        $runnings = Storage::where('status','=','rdy')->whereSport($runningid)->orderBy('created_at', 'desc')->take(7)->get();
        return view('website.home', compact('brands', 'divisions', 'sports', 'basketballs', 'footballs', 'casuals', 'runnings','key','unrelease'));
    }

    function product(Request $req, $sku) {
    	if($req->has('addCart')){
    		if( $req->get('quantity')!=""|| $req->get('quantity')>0){
	    	 	$item = Storage::whereArticle($sku)->first();
	    		$req->session()->push('item.name', $item->name);
	    		$req->session()->push('item.price', $item->sell_price);
	    		$req->session()->push('item.sku', $sku);
	    		$req->session()->push('item.size', $req->get('size'));
	    		$req->session()->push('item.qty', $req->get('quantity'));
				if($item->promotion=='freeongkir'){
					$req->session()->push('item.weight', 0);
				}
	    		if($item->division==1){
	    			$req->session()->push('item.weight', 1.5);
	    		}
	    		else{
	    			$req->session()->push('item.weight', 0.4);
	    		}
	    		
	    		
    		}
    		return redirect('/product/'.$sku);
    	}
	$key = "";
        $imgSize = "";
        $brands = Brand::where('show','=','1')->get();
        $divisions = Division::where('name', '!=', 'unknown')->get();
        $sports = Sport::where('name', '!=', 'unknown')->get();
        $item = Storage::whereArticle($sku)->first();
        $colors = Storage::where('name', '=', $item->name)->where('status','!=','sld')->get();
        $basketid = Sport::whereName('basket')->first()->id;
        $relateds = Storage::where('sport','=',$item->sport)->where('status','=','rdy')->where('color', 'like', '%'.$item->color.'%')->take(7)->orderByRaw("RAND()")->get();
        $relatedsCount = Storage::where('sport','=',$item->sport)->where('status','=','rdy')->where('color', 'like', '%'.$item->color.'%')->take(7)->orderByRaw("RAND()")->count();
        if($relatedsCount<=1){
        	$relateds = Storage::where('sport','=',$item->sport)->where('status','=','rdy')->take(7)->orderByRaw("RAND()")->get();
        }
        $session = $req->session()->get('username');
        $nikeMens = array(
            array("us", 7, 7.5, 8, 8.5, 9, 9.5, 10, 10.5, 11, 11.5, 12, 12.5, 13),
            array("uk", 6, 6.5, 7, 7.5, 8, 8.5, 9, 9.5, 10, 10.5, 11, 11.5, 12,),
            array("euro", 40, 40.5, 41, 42, 42.5, 43, 44, 44.5, 45, 45.6, 46, 47, 47.5),
            array("cm", 25, 25.5, 26, 26.5, 27, 27.5, 28, 28.5, 29, 29.5, 30, 30.5, 31)
        );
        $nikeWomens = array(
            array("us", 5, 5.5, 6, 6.5, 7, 7.5, 8, 8.5, 9, 9.5, 10, 10.5, 11, 11.5, 12),
            array("uk", 2.5, 3, 3.5, 4, 4.5, 5, 5.5, 6, 6.5, 7, 7.5, 8, 8.5, 9, 9.5),
            array("euro", 35.5, 36, 36.5, 37.5, 38, 38.5, 39, 40, 40.5, 41, 42, 42.5, 43, 44, 44.5),
            array("cm", 22, 22.5, 23, 23.5, 24, 24.5, 25, 25.5, 26, 26.5, 27, 27.5, 28, 28.5, 29)
        );
        $nikeGS = array(
            array("us", 3.5, 4, 4.5, 5, 5.5, 6, 6.5, 7),
            array("uk", 3, 3.5, 4, 4.5, 5, 5.5, 6, 6),
            array("euro", 35.5, 36, 36.5, 37.5, 38, 38.5, 39, 40),
            array("cm", 22.5, 23, 23.5, 23.5, 24, 24, 24.5, 25)
        );
        $adidasF = array(
            array("us", 7, 7.5, 8, 8.5, 9, 9.5, 10, 10.5, 11, 11.5, 12, 12.5),
            array("uk", 6.5, 7, 7.5, 8, 8.5, 9, 9.5, 10, 10.5, 11, 11.5, 12),
            array("euro", 40, 40.7, 41.3, 42, 42.7, 43.3, 44, 44.7, 45.3, 46, 46.7, 47.3),
            array("cm", 25, 25.5, 26, 26.5, 27, 27.5, 28, 28.5, 29, 29.5, 30, 30.5)
        );
        $adidasFWomens = array(
            array("us", 4.5,5,5.5,6,6.5,7,7.5,8,8.5,9,9.5),
            array("uk", 3,3.5,4,4.5,5,5.5,6,6.5,7,7.5,8),
            array("euro", 35.3,36,36.7,37.3,38,38.7,39.3,40,40.7,41.3,42),
            array("cm", 21.5,22,22.5,23,23.5,24,24.5,25,25.5,26,26.5)
        );
        $peakF = array(
            array("us", 6.5, 7, 8, 8.5, 9.5, 10, 10.5, 12),
            array("euro", 38, 39, 40, 41, 42, 43, 44, 45),
            array("cm", 24.5, 25, 25.5, 26, 26.5, 27, 27.5, 28)
        );
        $liningF = array(
            array("us", 6, 6.5, 7, 7.5, 8, 8.5, 9, 9.5, 10, 10.5, 11, 11.5, 12),
            array("euro", 38.3, 39, 39.7, 40.3, 41, 41.7, 42.3, 43, 43.7, 44.3, 45, 45.7, 46.3),
            array("cm", 23.5, 24, 24.5, 25, 25.5, 26, 26.5, 27, 27.5, 28, 28.5, 29, 29.5)
        );
        $nikeSock = array(
            array("Size", "S", "M", "L", "XL"),
            array('Ukuran Sepatu (USA)', "< 6", "6 - 8", "8 - 12", "12 - 15")
        );
        $mcdavidLegSleeve = array(
            array("Size", 'S', 'M', 'L', 'XL'),
            array("Lingkar Lutut (Inch)", '10-12', '12-14', '14-16', '16-19')
        );
        $mcdavidArmSleeve = array(
            array("Size", 'S', 'M', 'L'),
            array("Lingkar Lengan (Inch)", '8-9.5', '9.5-11', '11-13')
        );
        $mcdavidAnkle = array(
            array("Size", 'S', 'M', 'L', 'XL'),
            array("Lingkar Kaki (Inch)", '7-10', '10-12', '12-14', '15-16'),
        );
        $mcdavidKneeSleeve = array(
            array("Size", 'S', 'M', 'L', 'XL'),
            array("Lingkar Lutut (Inch)", '12-14', '14-15', '15-17', '17-20')
        );
        $mcdavidCalfSleeve = array(
            array("Size", 'S', 'M', 'L', 'XL'),
            array("Lingkar Betis (Inch)", '12-14', '14-15', '15-17', '17-20')
        );
        $mcdavidThighSleeve = array(
            array("Size", 'S', 'M', 'L', 'XL'),
            array("Lingkar Paha (Inch)", '18-20', '20-22', '22-25', '25-28')
        );
        $mcdavidShoulder = array(
            array("Size", 'S', 'M', 'L'),
            array("Lingkar Dada (Inch)", '30-36', '36-42', '42-50')
        );
        $mcdavidBackSupport = array(
            array("Size", 'S', 'M', 'L', 'XL'),
            array("Lingkar pinggang (Inch)", '24-32', '27-42', '36-52', '46-60')
        );
        $mcdavidThigh = array(
            array("Size", 'S', 'M', 'L', 'XL'),
            array("Lingkar Paha (Inch)", '18-20', '20-22', '22-25', '25-28')
        );
        $mcdavidShort = array(
            array("Size", 'S', 'M', 'L', 'XL'),
            array("Lingkar Pinggang (Inch)", '28-30', '30-34', '34-48', '38-42')
        );
        $pumaMens = array(
        array("us", 6,6.5,7,7.5,8,8.5,9,9.5,10,10.5,11,11.5,12,12.5,13),
            array("uk", 5,5.5,6,6.5,7,7.5,8,8.5,9,9.5,10,10.5,11,11.5,12),
            array("euro", 38,38.5,39,40,40.5,41,42,42.5,43,44,44.5,45,46,46.5,47),
            array("cm", 24,24.5,25,25.5,26,26.5,27,27.5,28,28.5,29,30,30.5,31,31.5)
        );
        $pumaWomens = array(
        array("us", 4,4.5,5,5.5,6,6.5,7,7.5,8,8.5,9,9.5,10,10.5),
            array("uk", 1.5,2,2.5,3,3.5,4,4.5,5,5.5,6,6.5,7,7.5,8),
            array("euro", 34,34.5,35,35.5,36,37,37.5,38,38.5,39,40,40.5,41,42),
            array("cm", 20.5,21,21.5,22,22.5,23,23.5,24,24.5,25,25.5,26,26.5,27)
        );
        if ($item->getBrand() == "nike" || $item->getBrand() == "jordan" || $item->getBrand() == "Under Armour") {
            $keySize = strtolower(($item->name . " " . $item->color . " " . $item->key . " " . $item->article));
            if (strpos($keySize, "socks") !== FALSE) {
                $size = $nikeSock;
            } else if ( strpos($keySize, "boys grade school") !== FALSE &&$item->getDivision() == "footwear") {
                $size = $nikeGS;
            } else if (strpos($keySize, "wmns") !== FALSE || strpos($keySize, "womens") !== FALSE) {
                $size = $nikeWomens;
            } else if ($item->getDivision() == "footwear") {
                $size = $nikeMens;
            } else {
                $size = array(
                    array("Please Contact our Customer Service"),
                );
            }
        } else if ($item->getBrand() == "adidas") {
            
            if($item->getDivision() == "footwear"){
            $keySize = strtolower(($item->name . " " . $item->color . " " . $item->key . " " . $item->article));
            	if(strpos($keySize, "wmns") !== FALSE || strpos($keySize, "womens") !== FALSE){
	            	$size = $adidasFWomens;
	        } 
	        else{
	        	$size = $adidasF;
	        }
            	
            }
            else {
                $size = array(
                    array("Please Contact our Customer Service"),
                );
            }
        } else if ($item->getBrand() == "peak") {
            $size = $peakF;
        } else if ($item->getBrand() == "lining") {
            $size = $liningF;
        } else if ($item->getBrand() == "mcdavid") {
            $keySize = strtolower(($item->name . " " . $item->color . " " . $item->key . " " . $item->article));
            if (strpos($keySize, " 6572b") !== FALSE || strpos($keySize, "calf") !== FALSE) {
                $size = $mcdavidCalfSleeve;
            } else if (strpos($keySize, "armsleeve") !== FALSE) {
                $size = $mcdavidArmSleeve;
                $imgSize = "/img/forearm.png";
            } else if (strpos($keySize, "knee") !== FALSE) {
                $size = $mcdavidKneeSleeve;
                $imgSize = "/img/knee.png";
            } else if (strpos($keySize, "legsleeve") !== FALSE) {
                $size = $mcdavidLegSleeve;
                $imgSize = "/img/knee.png";
            } else if (strpos($keySize, "shoulder") !== FALSE) {
                $size = $mcdavidShoulder;
                $imgSize = "/img/chest.png";
            } else if (strpos($keySize, "back") !== FALSE) {
                $size = $mcdavidBackSupport;
                $imgSize = "/img/waist.png";
            } else if (strpos($keySize, "ankle") !== FALSE) {
                $size = $mcdavidAnkle;
                $imgSize = "/img/ankle.png";
            } else if (strpos($keySize, "short") !== FALSE) {
                $size = $mcdavidShort;
                $imgSize = "/img/waist.png";
            } else {
                $size = array(
                    array("Please Contact our Customer Service"),
                );
            }
        }else if ($item->getBrand() == "Puma" && $item->getDivision() =="footwear"){
        	$keySize = strtolower(($item->name . " " . $item->color . " " . $item->key . " " . $item->article));
            	if(strpos($keySize, "wmns") !== FALSE || strpos($keySize, "womens") !== FALSE){
	            	$size = $pumaWomens;
	        } 
	        else{
	        	$size = $pumaMens;
	        }
        }
        else{
        	$size = array(
                    array("Please Contact our Customer Service"),
                );
        }
        
        if ($item->getDivision() == "footwear") {
            $imgSize = "/img/foot.png";
        }
        return view('website.product', compact('brands', 'divisions', 'sports', 'item', 'colors', 'relateds', 'size', 'imgSize','session','key'));
    }

    function search(Request $req, $key, $page, $sort) {
        if ($req->has('searchBox')) {
            $key = str_replace(" ", "+", $req->get('searchBox'));
            return redirect('/search/' . $key . '/1/1');
        } else {
            $key = str_replace("+", " ", $key);
            $brands = Brand::where('show','=','1')->get();
            $divisions = Division::where('name', '!=', 'unknown')->get();
            $sports = Sport::where('name', '!=', 'unknown')->get();
            $numberStorage = 8;
            $skip = $numberStorage * ($page - 1);
            $splitKey = explode(" ", $key);
			$ascdesc ="desc";
            switch ($sort) {
                case 1:$sortBy = "created_at";
                    break;
                case 2:$sortBy = "name";
                    break;
                case 3:$sortBy = "sell_price";
                    break;
				case 4:$sortBy = "sell_price";
					$ascdesc = "asc";
                    break;	
                default:$sortBy = "created_at";
                    break;
            }
            $count = count(Storage::where('status','=','rdy')->where('name', 'like', "%" . $key . "%")->orWhere('key', 'like', "%" . $key . "%")->where('status','=','rdy')->orWhere('article', 'like', "%" . $key . "%")->where('status','=','rdy')->orWhere('color', 'like', "%" . $key . "%")->where('status','=','rdy')->get());
            if($count>0){
                $storages = Storage::where('status','=','rdy')->where('name', 'like', "%" . $key . "%")->orWhere('key', 'like', "%" . $key . "%")->where('status','=','rdy')->orWhere('article', 'like', "%" . $key . "%")->where('status','=','rdy')->orWhere('color', 'like', "%" . $key . "%")->where('status','=','rdy')->skip($skip)->take($numberStorage)->orderBy($sortBy, $ascdesc)->get();
            }
            else if (count($splitKey) == 1) {
                $count = count(Storage::where('status','=','rdy')->where('name', 'like', "%" . $key . "%")->orWhere('key', 'like', "%" . $key . "%")->where('status','=','rdy')->orWhere('article', 'like', "%" . $key . "%")->where('status','=','rdy')->orWhere('color', 'like', "%" . $key . "%")->where('status','=','rdy')->get());
                $storages = Storage::where('status','=','rdy')->where('name', 'like', "%" . $key . "%")->orWhere('key', 'like', "%" . $key . "%")->where('status','=','rdy')->orWhere('article', 'like', "%" . $key . "%")->where('status','=','rdy')->orWhere('color', 'like', "%" . $key . "%")->where('status','=','rdy')->skip($skip)->take($numberStorage)->orderBy($sortBy, $ascdesc)->get();
            } else {
                $query = 'select * from storages where ';
                $query.='(name like "%' . $key . '%" or ';
                $query.='`key` like "%' . $key . '%" or ';
                $query.='color like "%' . $key . '%" )';
                $count = count(DB::select($query));
                if ($count == 0) {
                    $query = 'select * from storages where (';
                    for ($i = 0; $i < count($splitKey); $i++) {
                        if ($i == (count($splitKey) - 1)) {
                            $query.='(name like "%' . $splitKey[$i] . '%" or ';
                            $query.='`key` like "%' . $splitKey[$i] . '%" or ';

                            $query.='color like "%' . $splitKey[$i] . '%" ))';
                        } else {
                            $query.='(name like "%' . $splitKey[$i] . '%" or ';
                            $query.='`key` like "%' . $splitKey[$i] . '%" or ';

                            $query.='color like "%' . $splitKey[$i] . '%") and ';
                        }
                    }
                }
                $query .= ' and  status = "rdy" order by ' . $sortBy .' '.$ascdesc.' limit ' . $skip . ',' . $numberStorage;
		$count = count(DB::select($query));
                $storages = DB::select($query);
            }
            $brandGets = Brand::where('show','=','1')->get();
            $brandSwitch=[];
            foreach ($brandGets as $brand) {
                $brandSwitch[$brand->id] = $brand->name;
            }
            $tittle = "Ncrsport.com - Search - $key";

            return view('website.filter', compact('brands', 'divisions', 'sports', 'storages', 'count', 'brandSwitch', 'tittle', 'page','key'));
        }
    }

    function filter($filter, $name, $page, $sort) {
        $key ="";
        $brands = brand::where('show','=','1')->get();
        $divisions = Division::where('name', '!=', 'unknown')->get();
        $sports = Sport::where('name', '!=', 'unknown')->get();
        $numberStorage = 8;
        $skip = $numberStorage * ($page - 1);
        $ascdesc = 'desc';
        switch ($sort) {
            case 1:$sortBy = "created_at";
                break;
            case 2:$sortBy = "name";
                break;
            case 3:$sortBy = "sell_price";
                break;
            case 4:$sortBy = "sell_price";
            	$ascdesc = 'asc';
                break;    
            default:$sortBy = "created_at";
                break;
        }
        switch ($filter) {
            case "brand":
                $brand = Brand::whereName($name)->first();
                $filterName = "Produk ".ucfirst($brand->name);
                $idFilter = $brand->id;
                break;
            case "sport":
                $sport = Sport::whereName($name)->first();
                $filterName = "Perlengkapan ".ucfirst($sport->name);
                $idFilter = $sport->id;
                break;
            case "division":
                $division = Division::whereName($name)->first();
                $filterName = "".ucfirst($division->name);
                $idFilter = $division->id;
                break;
            case "sale":
                $filterName = "Sale Item";
                break;
            default:$filterName = "New Arrival";
                break;
        }
        $tittle = "Ncrsport.com - Jual ". $filterName." Original";
        $keyword = "Menjual ".$filterName." Original";
        if ($filter == "sale") {
            $query = "select * from storages where sell_price<retail_price and  status = 'rdy'";
            $count = count(DB::select($query));
            if($sortBy == "created_at"){
				$sortBy = "updated_at";
            }
            $query .= ' order by ' . $sortBy . ' '.$ascdesc.' limit ' . $skip . ',' . $numberStorage;
            $storages = DB::select($query);          
            
        }
        else if ($filter == "new") {
			$query = "select * from storages where sell_price>=retail_price and  status = 'rdy'";
			$count = count(DB::select($query));
			$query .= ' order by ' . $sortBy . ' '.$ascdesc.' limit ' . $skip . ',' . $numberStorage;
            
            $storages = DB::select($query);  
        } else {
            
            $storages = Storage::where('status','=','rdy')->where($filter, '=', $idFilter)->skip($skip)->take($numberStorage)->orderBy($sortBy, $ascdesc)->get();
            $count = count(Storage::where('status','=','rdy')->where($filter, '=', $idFilter)->get());
        }

        $brandGets = brand::where('show','=','1')->get();
        foreach ($brandGets as $brand) {
            $brandSwitch[$brand->id] = $brand->name;
        }
        return view('website.filter', compact('brands', 'divisions', 'sports', 'storages', 'count', 'tittle', 'brandSwitch', 'page','key'));
    }

    function specificFilter($brand, $sport, $division, $color,$key, $page, $sort) {
        $key=$key;
        $brands = brand::where('show','=','1')->get();
        $divisions = Division::where('name', '!=', 'unknown')->get();
        $sports = Sport::where('name', '!=', 'unknown')->get();
        $brand = explode(",", $brand);
        $sport = explode(",", $sport);
        $division = explode(",", $division);
        $color = explode(",", $color);
        $query = "select * from storages where ";
		$query.='(name like "%' . $key . '%" or ';
                $query.='`key` like "%' . $key . '%" or ';
                $query.='color like "%' . $key . '%" ) and (';
        if (count($brand) > 1) {
            for ($i = 0; $i < count($brand); $i++) {
                if (($i + 1) != count($brand)) {
                    $query.="brand = " . $brand[$i] . " or ";
                } else {
                    $query.="brand = " . $brand[$i] . ") and ";
                }
            }
        } else {
            $query.="true) and ";
        }
        $query.=" ( ";
        if (count($sport) > 1) {
            for ($i = 0; $i < count($sport); $i++) {
                if (($i + 1) != count($sport)) {
                    $query.="sport = " . $sport[$i] . " or ";
                } else {
                    $query.="sport = " . $sport[$i] . ") and ";
                }
            }
        } else {
            $query.="true) and ";
        }
        $query.=" ( ";
        if (count($division) > 1) {
            for ($i = 0; $i < count($division); $i++) {
                if (($i + 1) != count($division)) {
                    $query.="division = " . $division[$i] . " or ";
                } else {
                    $query.="division = " . $division[$i] . ") and ";
                }
            }
        } else {
            $query.="true) and ";
        }
        $query.=" ( ";
        if (count($color) > 1) {
            for ($i = 0; $i < count($color); $i++) {
                if (($i + 1) != count($color)) {
                    $query.="color like '%" . $color[$i] . "%' or ";
                } else {
                    $query.="color like '%" . $color[$i] . "%') ";
                }
            }
        } else {
            $query.="true) ";
        }
        $numberStorage = 8;
        $skip = $numberStorage * ($page - 1);
		$ascdesc = "desc";
        switch ($sort) {
            case 1:$sortBy = "created_at";
                break;
            case 2:$sortBy = "name";
                break;
            case 3:$sortBy = "sell_price";
                break;
			case 4:$sortBy = "sell_price";
				$ascdesc = "asc";
                break;	
            default:$sortBy = "created_at";
                break;
        }
        
	$query .= ' and status = "rdy"';
	$count = count(DB::select($query));
        $query .= '  order by ' . $sortBy . ' '.$ascdesc.' limit ' . $skip . ',' . $numberStorage;
        $storages = DB::select($query);
        $tittle = "Ncrsport.com - Sepatu Basket Original | Original Sneakers Shop";
		$brandSwitch=[];
        $brandGets = Brand::where('show','=','1')->get();
        foreach ($brandGets as $brand) {
            $brandSwitch[$brand->id] = $brand->name;
		}
        return view('website.filter', compact('brands', 'divisions', 'sports', 'storages', 'count', 'tittle', 'brandSwitch', 'page','key'));
    }

    function orderStatus(Request $req, $receipt,$email) {
	$key ="";
        $brands = brand::where('show','=','1')->get();
        $divisions = Division::where('name', '!=', 'unknown')->get();
        $sports = Sport::where('name', '!=', 'unknown')->get();
        if ($transaction = Transaction::find($this->decrypt($receipt))=="") {
            $find = false;
  
        } else if(Transaction::find($this->decrypt($receipt))->getCustomerMedia()==$email){
            $find = true;
            $transaction = Transaction::find($this->decrypt($receipt));
            $payLists = Paylist::whereTransaction($transaction->id)->get();
            $itemLists = Itemlist::whereTransaction($transaction->id)->get();
            $customer = Customer::find($transaction->customer);
        }
		else{
			$find = false;
			
		}
        return view('website.status', compact('brands', 'divisions', 'sports', 'transaction', 'customer', 'payLists', 'itemLists', 'find','receipt','key'));
    }

    function decrypt($secret) {
        $secret = str_replace("NCR", "", $secret);
        $res = "";
        $j = 0;
        for ($i = 0; $i < strlen($secret) - 2; $i+=2) {

            $res .= ord($secret[$i]) - 65 - $j;
            $j++;
        }
        return $secret;
    }

	/**
     * Method untuk mengirim email
     */
    function sentMail($customer, $status, $payments, $orders, $receipt, $transaction, $partner) {

        $judul;
        $isi;
        $headers = "From: customer.care@ncrsport.com\r\n";
        $headers .= "Reply-to: customer.care@ncrsport.com\r\n";
        if ($status == 0) {
            $judul = "Order Notification";
            $isi = "Dear Mr./Ms. " . $customer->name . "\n\n".
                   "Terima kasih atas kepercayaan Anda berbelanja di Ncrsport.com\n\n".
				   "Tanggal " . date("D d M, Y", strtotime($transaction->startdate)) . " anda melakukan order dengan nomor transaksi \"" . $transaction->id . '' . "\".\n\n";
            $isi .="Pesanan anda adalah : \n\n";

            foreach ($orders as $order) {
                if($order->name!='Kode Verifikasi'){
					$isi .= "Nama   : ".$order->article . " - " . $order->name . " \nSize    : " . $order->size . " \nJumlah : " . $order->qty." \nHarga   : ".$order->price."\n\n";
					
				}
            }
			
			$isi.= "Rincian pesanan anda : \n\n";
            $isi.="Keterangan : ".$transaction->information;
			$isi.="\nNama       : ".$customer->name." - (".$customer->phone.")";
            $isi.="\nAlamat     : ".$customer->address;
			
            $isi.="\n\nSilahkan lakukan pembayaran sebesar Rp ".$receipt." ke rekening dibawah dalam waktu 1 x 24 jam : \n\n";
            $isi.="Bank      : BCA\n";
			$isi.="Rekening : 7771510136\n";
			$isi.="Nama      : Steven Daniel \n\n";
			$isi.="Bank      : Mandiri\n";
			$isi.="Rekening : 1300013155067\n";
			$isi.="Nama      : Steven Daniel \n\n";
			$isi.="Silahkan lakukan konfirmasi pembayaran melalui link berikut http://ncrsport.com/confirmation\n\n";
			$isi.="Terimakasih,\n\n";
			$isi.="Ncrsport\n\n";
			$isi.="Jika membutuhkan bantuan lain harap hubungi Ncrsport pada +62-899-625-3121 atau Line @Ncrsport";
        } 
        
        $mail_sent = @mail("$customer->media", $judul, $isi, $headers);
        return $judul . "\n" . $isi;
    }
}