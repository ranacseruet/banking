<?php

use Atrauzzi\LaravelDoctrine\Support\Facades\Doctrine;

class TransferController extends UserBaseController 
{
        /**
	 * Display a listing of the resource.
	 *
	 * @return \Response
	 */
	public function index()
	{   
            $accounts = $this->user->getAccounts();
            if(!$accounts) {
                 $accounts =  new \Doctrine\Common\Collections\ArrayCollection();
            }

            View::share('accounts', $accounts);
            $this->layout->content = View::make('transfer.list');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
            $accounts = $this->user->getAccounts();
            $from = array(0 => "Select An Account");
            $to = array(0 => "Select An Account");

            foreach($accounts as $account) {
                if(!$account->getIsActive())continue;
                if($account->getType() != Account::CHECKING || Account::SAVING) {
                    $from[$account->getId()] = $account->getAccountNo()."(".$account->getBalance().")";
                }
                $to[$account->getId()] = $account->getAccountNo()."(".$account->getBalance().")";
            }

            View::share('from', $from);
            View::share('to', $to);
            
            $this->layout->content = View::make('transfer.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// validate
		// read more on validation at http://laravel.com/docs/validation
		$rules = array(
			'from_account'       => 'required|different:to_account',
			'to_account'      => 'required|different:from_account',
			'amount'        => 'required|numeric|min:2',
                        'description' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('transfer/create')
				->withErrors($validator);
		} else {
			// store
                        $fromAccount = Doctrine::getRepository("Account")->find(Input::get('from_account'));
			$toAccount   = Doctrine::getRepository("Account")->find(Input::get('to_account'));
                        if($fromAccount->getBalance() < Input::get('amount')) {
                            return Redirect::to('transfer/create')
				->withErrors("You don't have enough balance");
                        }
                        
                        $transaction = new Transaction();
			$transaction->setAccount($fromAccount);
			$transaction->setAmount(Input::get('amount'));
                        $transaction->setDescription(Input::get('description'));
			$transaction->setType(Transaction::DEBIT);
                        Doctrine::persist($transaction);
                        
                        $transaction = new Transaction();
			$transaction->setAccount($toAccount);
			$transaction->setAmount(Input::get('amount'));
                        $transaction->setDescription(Input::get('description'));
			$transaction->setType(Transaction::CREDIT);
                        Doctrine::persist($transaction);
                        
                        Doctrine::flush();
                        
			// redirect
            $this->doLog('Transaction is done successfully. Transaction Id:'. $transaction->getId());
			Session::flash('message', "Transaction is done successfully. <a href='" . url('account/receipt', array('id' => $transaction->getId())) ."' target='_blank'>Print Receipt</a>.");
			return Redirect::to('transfer');
		}
           
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
            $account = Doctrine::getRepository("Account")->find($id);
            if(!$account) {
                 $account =  new Account();
            }
            View::share('account', $account);
            $this->layout->content = View::make('transfer.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
            $accounts = $this->user->getAccounts();
            $from = array(0 => "Select An Account");

            foreach($accounts as $account) {
                $from[$account->getId()] = $account->getAccountNo()."(".$account->getBalance().")";
            }

            View::share('from', $from);
            
            $this->layout->content = View::make('transfer.wire');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
            // validate
            // read more on validation at http://laravel.com/docs/validation
            $rules = array(
                    'from_account'       => 'required',
                    'to_account'      => 'required',
                    'name'      => 'required',
                    'bank'      => 'required',
                    'amount'        => 'required|numeric|min:10',
                    'address' => 'required'
            );
            $validator = Validator::make(Input::all(), $rules);

            // process the login
            if ($validator->fails()) {
                    return Redirect::to('transfer/wire/edit')
                            ->withErrors($validator);
            } else {
                    // store
                    $fromAccount = Doctrine::getRepository("Account")->find(Input::get('from_account'));
                    if($fromAccount->getBalance() < Input::get('amount')) {
                        return Redirect::to('transfer/wire/edit')
                            ->withErrors("You don't have enough balance");
                    }

                    $transaction = new Transaction();
                    $transaction->setAccount($fromAccount);
                    $transaction->setAmount(Input::get('amount'));
                    $transaction->setDescription(Input::get('description'));
                    $transaction->setType(Transaction::DEBIT);
                    Doctrine::persist($transaction);

                    $wtransfer = new WireTransfer();
                    $wtransfer->setName(Input::get('name'));
                    $wtransfer->setAccountNo(Input::get('to_account'));
                    $wtransfer->setAddress(Input::get('address'));
                    $wtransfer->setBankName(Input::get('bank'));
                    $wtransfer->setAmount(Input::get('amount'));
                    $wtransfer->setFromAccount($fromAccount);

                    Doctrine::persist($wtransfer);
                    Doctrine::flush();

                    $this->doLog('Transaction is done successfully. Transaction Id:'. $wtransfer->getId());
                    // redirect
                    Session::flash('message', "Transaction is done successfully. <a href='" . url('account/receipt', array('id' => $wtransfer->getId())) ."' target='_blank'>Print Receipt</a>.");
                    return Redirect::to('transfer');
            }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
        
}
