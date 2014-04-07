<?php

use Atrauzzi\LaravelDoctrine\Support\Facades\Doctrine;

class TransferController extends \BaseController {

        /**
        * The layout that should be used for responses.
        */
        protected $layout = 'layouts.main';
        
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
            $user = Doctrine::getRepository("User")->find(Auth::user()->id);
            if(!$user) {
                echo "invalid user";exit;
                //Redirect::to('users/login')
                //        ->with('message', 'invalid user information');
            }
            $accounts = $user->getAccounts();
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
            /**
             * @var Account Description
             */
            
            $user = Doctrine::getRepository("User")->find(1);
            $accounts = $user->getAccounts();
            $from = array(0 => "Select An Account");
            $to = array(0 => "Select An Account");
            foreach($accounts as $account) {
                $from[$account->getId()] = $account->getId();
                $to[$account->getId()] = $account->getId();
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
			'from_account'       => 'required',
			'to_account'      => 'required',
			'amount'        => 'required|numeric',
                        'description' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('transfer/create')
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {
			// store
			$transaction = new Transaction();
			$transaction->setAccount(Doctrine::getRepository("Account")->find(Input::get('from_account')));
			$transaction->setAmount(Input::get('amount'));
                        $transaction->setDescription(Input::get('description'));
			$transaction->setType("D");
                        Doctrine::persist($transaction);
                        
                        $transaction = new Transaction();
			$transaction->setAccount(Doctrine::getRepository("Account")->find(Input::get('to_account')));
			$transaction->setAmount(Input::get('amount'));
                        $transaction->setDescription(Input::get('description'));
			$transaction->setType("C");
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