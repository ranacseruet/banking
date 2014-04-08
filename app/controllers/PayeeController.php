<?php

class PayeeController extends \BaseController {
    
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
            $payees = $this->user->getPayees();
            if(!$payees) {
                 $payees =  new \Doctrine\Common\Collections\ArrayCollection();
            }
            
            View::share('payees', $payees);
            $this->layout->content = View::make('payee.list');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
            $bills = Doctrine::getRepository("Bill")->findAll();
            $billsList = array(0 => "Select An Account");
            foreach ($bills as $bill) {
                $billsList[$bill->getId()] = $bill->getName();
            }
            View::share('bills', $billsList);
            $this->layout->content = View::make('payee.create');
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
			'bill'      => 'required',
			'accountNo'        => 'required|numeric|min:8'
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('payee/create')
				->withErrors($validator)
                                ->withInput();
		} else {
			// store
                        $bill = Doctrine::getRepository("Bill")->find(Input::get('bill'));
			
                        $payee = new Payee();
                        
                        $payee->setBill($bill);
                        $payee->setUser($this->user);
                        $payee->setAccountNo(Input::get('accountNo'));
                        
                        Doctrine::persist($payee);
                        
                        Doctrine::flush();
                        
			// redirect
			Session::flash('message', 'Payee added Successfully!');
			return Redirect::to('payee');
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
            Doctrine::remove(Doctrine::getPartialReference("Payee", $id));
            Doctrine::flush();
            return Redirect::to("payee");
	}

}