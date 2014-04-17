<?php

use Atrauzzi\LaravelDoctrine\Support\Facades\Doctrine;

/**
 * Account controller
 *
 * Responsible for all activities of account
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
     * Serve
     *
     * @route GET /account/index/id/:id
     */
    public function getIndex($id)
    {
        $account                = Doctrine::getRepository("Account")->findOneById($id);
        $this->data['account']  = $account;
        $this->layout->content  = View::make('account.index', $this->data);
    }

    /**
     * Serve the accout creation page
     *
     * @route GET /account/create/id/:id
     */
    public function getCreate($id)
    {
        $this->data["user_id"]      = $id;
        $this->data["account_no"]   = Account::generateAccountNo();
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
        $this->data["account_no"]   = Account::generateAccountNo();
        $this->layout->content = View::make('account.createbyuser', $this->data);
    }


   /**
    * Process account creation
    *
    *@route Post /account/processaccount
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
            $accountEntity->setInterestRate(Input::get('interest_rate', 0));
            $accountEntity->setIsActive(true);
            $accountEntity->setCreateDate(new DateTime('now'));

            try{
                Doctrine::persist($accountEntity);
                Doctrine::flush();
            } catch(\Exception $e) {
                return Redirect::to('account/create/' . Input::get('user_id'))->with('message', 'Something went wrong')->withErrors($validator)->withInput();
            }

            if (Input::has('amount')) {

                $transaction = new Transaction();
                $transaction->setAccount($accountEntity);
                $transaction->setAmount(Input::get('amount'));
                $transaction->setDescription('Investment');
                $transaction->setType(Transaction::CREDIT);

                Doctrine::persist($transaction);
                Doctrine::flush();
            }

			return Redirect::to('admin/userdetails/' . Input::get('user_id'))->with('message', 'Thanks for registering!');
		} else {
			return Redirect::to('account/create/' . Input::get('user_id'))->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
		}
    }

   /**
    * Process account creation by user application
    *
    *@route Post /account/processcreateaccountbyuser
    */
    public function postProcesscreateaccountbyuser()
    {
        $validator = Validator::make(Input::all(), Account::getRulesUserApply());

		if ($validator->passes()) {

            $user          = Doctrine::getRepository("User")->findOneBy(array("id" => Input::get('user_id')));
			$accountEntity = new Account;
            $accountEntity->setUser($user);
            $accountEntity->settype(Input::get('type'));
            $accountEntity->setAccountNo(Input::get('account_no'));
            $accountEntity->setInterestRate(0);
            $accountEntity->setIsActive(Account::UNAPPROVED);
            $accountEntity->setCreateDate(new DateTime('now'));

            try{
                Doctrine::persist($accountEntity);
                Doctrine::flush();
            } catch(\Exception $e) {
                return Redirect::to('account/create/' . Input::get('user_id'))->with('message', 'Something went wrong')->withErrors($validator)->withInput();
            }
			return Redirect::to('users/dashboard')->with('message', 'Application is accepted.');
		} else {
			return Redirect::to('account/accountcreatebyuser')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
		}
    }

    public function getApprovelist()
    {
        $this->data["unapprovedAccounts"]  = Doctrine::getRepository("Account")->findby(array('isActive' => Account::UNAPPROVED));
        $this->layout->content             = View::make('account.approvelist', $this->data);
    }

    /**
     * Process admin account approval
     *
     * @route GET /account/approve/id/:id
     */
    public function getApprove($id)
    {
        $account     = Doctrine::getRepository("Account")->find($id);
        $account->setIsActive(Account::APPROVED);
        Doctrine::persist($account);
        Doctrine::flush();

        return Redirect::to('admin/dashboard')->with('message', 'Account Approved');
    }

   /**
    * Process account creation
    *
    *@route GET /account/withdraw/id/:id
    */
    public function getWithdraw($id)
    {
        $user         = Doctrine::getRepository("User")->find($id);
        $accounts     = Doctrine::getRepository("Account")->findby(array('user'     => $user->getId(),
                                                                         'isActive' => Account::APPROVED));
        $userAccounts = array();

        foreach($accounts as $account)
        {
            $userAccounts[$account->getId()] = $account->getAccountNo() .' - ' . ucfirst($account->getType()) . " (" . $account->getBalance()." CAD)";
        }

        $this->data['userAccounts'] = $userAccounts;
        $this->layout->content = View::make('account.withdraw', $this->data);
    }


   /**
    * Process account creation
    *
    * @route GET /account/deposit/id/:id
    */
    public function getDeposit($id)
    {
        $user         = Doctrine::getRepository("User")->find($id);
        $accounts     = Doctrine::getRepository("Account")->findby(array('user'     => $user->getId(),
                                                                         'isActive' => Account::APPROVED));
        $userAccounts = array();

        foreach($accounts as $account)
        {
            $userAccounts[$account->getId()] = $account->getAccountNo() .' - ' . ucfirst($account->getType()) . " (" . $account->getBalance()." CAD)";
        }

        $this->data['userAccounts'] = $userAccounts;
        $this->layout->content = View::make('account.deposit', $this->data);
    }

   /**
    * Process withdraw from account
    *
    * @route POST /account/processwithdraw
    */
    public function postProcesswithdraw()
    {
        $validator = Validator::make(Input::all(), Account::getRulesForDeposit());

		if ($validator->passes()) {

            $acount_id   = (int) Input::get('account_no');
            $account     = Doctrine::getRepository("Account")->find($acount_id);
            $balane      = $account->getBalance();

            if(Input::get('amount') > $balane) {
                return Redirect::to('account/deposit/' . Input::get('account_no'))->with('message', 'Insufficient Balance');
            }

            $transaction = new Transaction();
			$transaction->setAccount($account);
			$transaction->setAmount(Input::get('amount'));
            $transaction->setDescription('Withdraw');
			$transaction->setType(Transaction::DEBIT);

            Doctrine::persist($transaction);
            Doctrine::flush();

            return Redirect::to('admin/dashboard')->with('message', 'Transaction is done successfully.');
        }  else {
            return Redirect::to('account/withdraw/' . Input::get('account_no'))->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
        }
    }

   /**
    * Process deposit to account
    *
    * @route GET /account/processdeposit
    */
    public function postProcessdeposit()
    {
        $validator = Validator::make(Input::all(), Account::getRulesForDeposit());

		if ($validator->passes()) {

            $acount_id   = (int) Input::get('account_no');
            $account     = Doctrine::getRepository("Account")->find($acount_id);
            $transaction = new Transaction();
			$transaction->setAccount($account);
			$transaction->setAmount(Input::get('amount'));
            $transaction->setDescription('Deposit');
			$transaction->setType(Transaction::CREDIT);

            Doctrine::persist($transaction);
            Doctrine::flush();
            return Redirect::to('admin/dashboard')->with('message', 'Money is deposited Successfully.');
        }  else {
            return Redirect::to('account/deposit/' . Input::get('account_no'))->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
        }
    }


   /**
    * Generate PDF For Individual account
    *
    * @route GET /account/generatepdf/:id
    */
    public function getGeneratepdf($id)
    {
        $account                = Doctrine::getRepository("Account")->findOneById($id);
        $this->data['account']  = $account;
        $html                   = View::make('account.pdf', $this->data);

        return PDF::load($html, 'A4', 'portrait')->download($account->getAccountNo());
    }

    /**
    * Generate PDF For Individual account
    *
    * @route GET /account/receipt/:id
    */
    public function getReceipt($id)
    {
        $account                = Doctrine::getRepository("Account")->findOneById($id);
        $this->data['account']  = $account;
        $html                   = View::make('account.pdf', $this->data);

        return PDF::load($html, 'A4', 'portrait')->download($account->getAccountNo());
    }
}