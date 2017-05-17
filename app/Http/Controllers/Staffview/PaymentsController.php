<?php

namespace App\Http\Controllers\Staffview;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Payment;
use App\Models\Invoice;
use App\Models\BalanceIn;
use App\Models\BalanceOutTransaction;
use App\Models\BalanceOut;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		// get all the items
        $payments = Payment::all();

        // load the view and pass the items        

        return view('staffview.payments.list')
			->with('payments', $payments);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('staffview.payments.create');
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
			'id_invoice' => 'required|exists:invoices,id',
			'email' => 'required|exists:users,email',
			'amount' => 'required|numeric',
			'status' => 'required',
			'receipt' => 'image|mimes:jpg,jpeg,bmp,png|max:2000',
		]);
		
		$user = User::where('email',$request->input('email'))->get();
		
		$payments = Payment::create([
			'id_invoice' =>  $request->input('id_invoice'),
			'amount' =>  $request->input('amount'),
			'id_user' =>  $user[0]->id,
			'status' =>  $request->input('status'),
			'mod_user' =>  \Auth::User()->name(),
		]);
		
		
		if($request->hasFile('receipt')){
			$receipt = PaymentProof::findOrFail($payments->payment_proof->id);
			$temp = $request->receipt->store('public/images/payments');
			$file = explode("/",$temp);
			$receipt->picture = $file[3];
			$receipt->save();
		}
	
        return redirect()->route('payments.index')->with('success', "$payments->id berhasil ditambahkan.");
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
            $payments = Payment::findOrFail($id);		
		
			return view('staffview.payments.delete')
				->with('payments', $payments);
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
            $payments = Payment::findOrFail($id);		
		
			return view('staffview.payments.edit')
				->with('payments', $payments);
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
				'id_invoice' => 'required|exists:invoices,id',
				'email' => 'required|exists:users,email',
				'amount' => 'required|numeric',
				'status' => 'required',
				'receipt' => 'image|mimes:jpg,jpeg,bmp,png|max:2000',
			]);
			
			$user = User::where('email',$request->input('email'))->get();			

            $payments = Payment::findOrFail($id);	
			$payments->id_invoice = $request->input('id_invoice');
			$payments->amount = $request->input('amount');
			$payments->status = $request->input('status');
			$payments->mod_user = \Auth::user()->name;	
			$payments->id_user = $user[0]->id;
            $payments->save();			
			
			if($request->hasFile('receipt')){
				$receipt = PaymentProof::findOrFail($payments->payment_proof->id);
				$temp = $request->receipt->store('public/images/payments');
				$file = explode("/",$temp);
				$receipt->picture = $file[3];
				$receipt->save();
			}
		
			return redirect()->route('payments.index')->with('success', "$payments->id berhasil diubah.");
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
            $payments = Payment::findOrFail($id);	
			$payments->mod_user = \Auth::user()->name;	
			$payments->save();
			$payments->delete();
		
			return redirect()->route('payments.index')->with('success', "$payments->brand_name berhasil dihapus");
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
     * Accept the receipt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function accept(Request $request, $id)
    {
		try{

            $payments = Payment::findOrFail($id);	
			$temp = $payments->invoice;		
			$invoice = Invoice::findorFail($temp->id);

			$payments->status = "Accepted";
			$payments->mod_user = \Auth::user()->name;			
            $payments->save();
			
			$invoice->status = "Process";
			$invoice->mod_user = \Auth::user()->name;
			$invoice->save();
			
			$balance_in = BalanceIn::Create([
				'id_user' => $payments->user->id,
				'amount' => $payments->amount,
				'type' => 1,
				'mod_user' => \Auth::user()->name,
			]);
			
			$balance_out = BalanceOut::Create([
				'id_user' => $payments->user->id,
				'amount' => $payments->amount,
				'type' => 1,
				'mod_user' => \Auth::user()->name,
			]);
			
			$balance_out_transaction = BalanceOutTransaction::Create([
				'id_balance_out' => $balance_out->id,
				'id_invoice' => $invoice->id,
				'mod_user' => \Auth::user()->name,
			]);
		
			return redirect()->route('payments.index')->with('success', "$payments->id accepted.");
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
     * Reject the receipt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reject(Request $request, $id)
    {
		try{

	        $payments = Payment::findOrFail($id);	

			$payments->status = "Rejected";
            $payments->save();
		
			return redirect()->route('payments.index')->with('success', "$payments->id rejected.");
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
