<?php

use Atrauzzi\LaravelDoctrine\Support\Facades\Doctrine;

class TransferController extends BaseController 
{

        /**
        * The layout that should be used for responses.
        */
        protected $layout = 'layouts.main';
        /**
         * @var User 
         */
        private $user;
        
        public function __construct() 
        {
            parent::__construct();
            if(!Auth::check()) {
                return Redirect::to('users/login')
                        ->with('message', 'Please login first');
            }
            $this->user = Doctrine::getRepository("User")->find(Auth::user()->id);
        }


        /**
	 * Display a listing of the resource.
	 *
	 * @return Response
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
                $from[$account->getId()] = $account->getAccountNo()."(".$account->getBalance().")";
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
			Session::flash('message', 'Payment completed Successfully!');
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
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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