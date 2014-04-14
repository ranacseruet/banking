<?php

use Atrauzzi\LaravelDoctrine\Support\Facades\Doctrine;

/**
 * Card controller
 *
 * Responsible for all card related task of user
 *
 * @author Eftakhairul Islam <eftakhairul@gmail.com>
 */
class CardController extends BaseController
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
     * @route GET /card/create/id/:id
     */
    public function getCreate($id)
    {
        View::share('account_id', $id);
        View::share('type', Card::getAllType());
        View::share('card_no', Card::generateCardNo());
        $this->layout->content = View::make('card.create');
    }


    /**
     * Process account creation
     *
     * @route post /card/processcreate
     */
    public function postProcesscreate()
    {
        $validator = Validator::make(Input::all(), Card::getRules());

		if ($validator->passes()) {

            $account    = Doctrine::getRepository("Account")->find(Input::get('account_id'));

            if (Input::get('type') == Card::CREDIT && $account->getType() != Account::CREDIT_CARD) {
                return Redirect::to('card/create/' . Input::get('account_id'))->with('message', 'Account has to be Credit Card')->withErrors($validator)->withInput();
            }


			$cardEntity = new Card();
            $cardEntity->setType(Input::get('type'));
            $cardEntity->setCardNo(Input::get('card_no'));
            $cardEntity->setExpireDate(new \DateTime(Input::get('expire_date')));
            $cardEntity->setIssueDate(new \DateTime(Input::get('issue_date')));
            $cardEntity->setPinNo(Input::get('pin_no'));
            $cardEntity->setCreateDate(new \DateTime('now'));
            $cardEntity->setAccount($account);
			Doctrine::persist($cardEntity);
            Doctrine::flush();

			return Redirect::to('admin/dashboard')->with('message', 'Card is added successfully');
		} else {
			return Redirect::to('card/create/' . Input::get('account_id'))->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
		}
    }

    /**
     * show the Pin
     *
     * @route post /card/changepin/id/{:id}
     */
    public function getChangepin($id)
    {
        View::share('card_id', $id);
        $this->layout->content = View::make('card.changepin');
    }


    /**
     * show the Pin
     *
     * @route post /card/processchangepin
     */
    public function postProcesschangepin()
    {
        $validator = Validator::make(Input::all(), Card::getRulesForChangePin());

        if ($validator->passes()) {

			$cardEntity = Doctrine::getRepository("Card")->find(Input::get('card_id'));
            $cardEntity->setPinNo(Input::get('pin_no'));
            $cardEntity->setUpdateDate(new \DateTime('now'));

			Doctrine::persist($cardEntity);
            Doctrine::flush();


			return Redirect::to('account/index/' . $cardEntity->getAccount()->getId())->with('message', 'Pin is changed successfully.');
		} else {
			return Redirect::to('card/create/' . Input::get('card_id'))->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
		}
    }

    /**
     * ATM machine UI
     *
     * @route post /atm
     */
    public function getAtm()
    {
        $this->layout->content = View::make('card.atm');
    }

    /**
     * Process ATM Withdraw
     *
     * @route post /card/processchangepin
     */
    public function postProcessatm()
    {
        $validator = Validator::make(Input::all(), Card::getRulesForATMWithdraw());

		if ($validator->passes()) {
            $card = Doctrine::getRepository("Card")->findby(array('cardNo' => Input::get('card_no')));

            if (empty($card)) {
                return Redirect::to('/atm')->with('message', 'Invalid Card No.')->withErrors($validator)->withInput();
            }

            if($card->getAccount()->getBalance() < Input::get('amount')) {
                return Redirect::to('/atm')->with('message', 'Sorry. Insufficient Balance in your account.')->withErrors($validator)->withInput();
            }


			$transaction = new Transaction();
			$transaction->setAccount($card->getAccount());
			$transaction->setAmount(Input::get('amount'));
            $transaction->setDescription('ATM Withdraw');
			$transaction->setType(Transaction::DEBIT);

            Doctrine::persist($transaction);
            Doctrine::flush();

            $this->layout->content = View::make('card.thankyou');
		} else {
			return Redirect::to('/atm')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
		}
    }


}