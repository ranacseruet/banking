<?php

use Atrauzzi\LaravelDoctrine\Support\Facades\Doctrine;

/**
 * Account controller
 *
 * Responsible for all account related task of user
 *
 * @author Eftakhairul Islam <eftakhairul@gmail.com>
 */
class AccountController extends UserBaseController
{

    /**
     * @var string
     */
    protected $layout = "layouts.main";

    /**
     * Initializing the value
     */
    public function __construct()
     {
         parent::__construct();  
     }

    /**
     * Serve the accout creation page
     *
     *@route GET /account/create/id/:id
     */
    public function getCreate($id)
    {
        $this->data["user_id"] = $id;
        View::share('type', Account::getALLStatuses());
        $this->layout->content = View::make('account.create', $this->data);
    }

    /**
     * Serve the account creation page
     *
     *@route GET /account/accountcreatebyuser
     */
    public function getAccountcreatebyuser()
    {
        $this->data["user_id"] = $this->user->getId();
        View::share('type', Account::getALLStatuses());
        $this->layout->content = View::make('account.create', $this->data);
    }


   /**
    * Process account creation
    *
    *@route post /account/processaccount
    */
    public function postProcessaccount()
    {
        $validator = Validator::make(Input::all(), Account::getRules());

		if ($validator->passes()) {

            $user          = Doctrine::getRepository("User")->findOneBy(array("id" => Input::get('user_id')));
			$accountEntity = new Account;
            $accountEntity->setUser($user);
            $accountEntity->settype(Input::get('type'));
            $accountEntity->setAccountNo(Input::get('account_no'));
            $accountEntity->setInterestRate(Input::get('interest_rate'));
            $accountEntity->setIsActive(true);
            $accountEntity->setCreateDate(new DateTime('now'));

			Doctrine::persist($accountEntity);
            Doctrine::flush();

            //TODO route has to updated
			return Redirect::to('users/login')->with('message', 'Thanks for registering!');
		} else {
			return Redirect::to('account/create/' . Input::get('user_id'))->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
		}
    }
}