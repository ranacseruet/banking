<?php

class BillingAccountController extends \AdminBaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
            $accounts = Doctrine::getRepository("Bill")->findAll();
            View::share('accounts', $accounts);
            $this->layout->content = View::make('billing-accounts.list');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
            $accountList = Doctrine::getRepository("Account")->findAll();
            $accounts = array(); 
            foreach($accountList as $account) {
                if($account->getType() == Account::CHECKING && !$account->getBillingAccount()) {
                    $accounts[$account->getId()] = $account->getAccountNo()."-".$account->getUser()->getFirstName()." ".$account->getUser()->getLastName()."";
                }
            }
            //print_r($accounts);
            View::share('accounts', $accounts);
            $this->layout->content = View::make('billing-accounts.create');
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
			'account'       => 'required',
			'name'      => 'required|unique:bills'
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('billing-accounts/create')
				->withErrors($validator);
		} else {
			// store
                        $account = Doctrine::getRepository("Account")->find(Input::get('account'));
			
                        
                        $billing = new Bill();
                        $billing->setAccount($account);
                        $billing->setName(Input::get('name'));
                        Doctrine::persist($billing);
                        
                        Doctrine::flush();
                        
			// redirect
			Session::flash('message', 'Billing Account Created Successfully!');
			return Redirect::to('billing-accounts');
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
            Doctrine::remove(Doctrine::getPartialReference("Bill", $id));
            Doctrine::flush();
            return Redirect::to("billing-accounts");
	}

}