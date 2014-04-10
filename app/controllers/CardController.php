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
                    return Redirect::to('card/create/' . Input::get('account_id'))->with('message', 'Account has to be Credit Card.')->withErrors($validator)->withInput();
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

            //TODO route has to updated
			return Redirect::to('admin/dashboard')->with('message', 'Card is created.');
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

            //TODO route has to updated
			return Redirect::to('users/login')->with('message', 'Thanks for registering!');
		} else {
			return Redirect::to('card/create/' . Input::get('account_id'))->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
		}
    }
}