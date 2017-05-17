<?php

namespace App\Http\Controllers\Staffview;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Debt;
use App\Models\Invoice;
use App\Models\BalanceIn;
use App\Models\BalanceOutTransaction;
use App\Models\BalanceOut;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DebtsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		// get all the items
        $debts = debt::all();

        // load the view and pass the items        

        return view('staffview.debts.list')
			->with('debts', $debts);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('staffview.debts.create');
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
		
		$debts = debt::create([
			'id_invoice' =>  $request->input('id_invoice'),
			'amount' =>  $request->input('amount'),
			'id_user' =>  $user[0]->id,
			'status' =>  $request->input('status'),
			'mod_user' =>  \Auth::User()->name(),
		]);
		
		
		if($request->hasFile('receipt')){
			$receipt = debtProof::findOrFail($debts->debt_proof->id);
			$temp = $request->receipt->store('public/images/debts');
			$file = explode("/",$temp);
			$receipt->picture = $file[3];
			$receipt->save();
		}
	
        return redirect()->route('debts.index')->with('success', "$debts->id berhasil ditambahkan.");
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
            $debts = debt::findOrFail($id);		
		
			return view('staffview.debts.delete')
				->with('debts', $debts);
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
            $debts = debt::findOrFail($id);		
		
			return view('staffview.debts.edit')
				->with('debts', $debts);
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

            $debts = debt::findOrFail($id);	
			$debts->id_invoice = $request->input('id_invoice');
			$debts->amount = $request->input('amount');
			$debts->status = $request->input('status');
			$debts->mod_user = \Auth::user()->name;	
			$debts->id_user = $user[0]->id;
            $debts->save();			
			
			if($request->hasFile('receipt')){
				$receipt = debtProof::findOrFail($debts->debt_proof->id);
				$temp = $request->receipt->store('public/images/debts');
				$file = explode("/",$temp);
				$receipt->picture = $file[3];
				$receipt->save();
			}
		
			return redirect()->route('debts.index')->with('success', "$debts->id berhasil diubah.");
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
            $debts = debt::findOrFail($id);	

			$debts->delete();
		
			return redirect()->route('debts.index')->with('success', "$debts->brand_name berhasil dihapus");
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

            $debts = debt::findOrFail($id);	
			$temp = $debts->invoice;		
			$invoice = Invoice::findorFail($temp->id);

			$debts->status = "Accepted";
			$debts->mod_user = \Auth::user()->name;			
            $debts->save();
			
			$invoice->status = "Process";
			$invoice->mod_user = \Auth::user()->name;
			$invoice->save();
			
			$balance_in = BalanceIn::Create([
				'id_user' => $debts->user->id,
				'amount' => $debts->amount,
				'type' => 1,
				'mod_user' => \Auth::user()->name,
			]);
			
			$balance_out = BalanceOut::Create([
				'id_user' => $debts->user->id,
				'amount' => $debts->amount,
				'type' => 1,
				'mod_user' => \Auth::user()->name,
			]);
			
			$balance_out_transaction = BalanceOutTransaction::Create([
				'id_balance_out' => $balance_out->id,
				'id_invoice' => $invoice->id,
				'mod_user' => \Auth::user()->name,
			]);
		
			return redirect()->route('debts.index')->with('success', "$debts->id accepted.");
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

	        $debts = debt::findOrFail($id);	

			$debts->status = "Rejected";
            $debts->save();
		
			return redirect()->route('debts.index')->with('success', "$debts->id rejected.");
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
