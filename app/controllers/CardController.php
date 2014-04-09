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
        $this->layout->content = View::make('card.create');
    }


    /**
     * Process account creation
     *
     *@route post /card/processcreate
     */
    public function postProcesscreate()
    {
        $validator = Validator::make(Input::all(), Card::getRules());

		if ($validator->passes()) {

			$cardEntity = new Card();


            $cardEntity->settype(Input::get('type'));
            $cardEntity->setCardNo(Input::get('card_no'));
            $cardEntity->setExpireDate(new \DateTime(Input::get('expire_date')));
            $cardEntity->setIssueDate(new \DateTime(Input::get('issue_date')));
            $cardEntity->setPinNo(Input::get('pin_no'));
            $cardEntity->setCreateDate(new \DateTime('now'));
            $account    = Doctrine::getRepository("Account")->findOneBy(array('id' => Input::get('account_id')));
            $cardEntity->setAccount($account);
			Doctrine::persist($cardEntity);
            Doctrine::flush();

            //TODO route has to updated
			return Redirect::to('users/login')->with('message', 'Thanks for registering!');
		} else {
			return Redirect::to('card/create/' . Input::get('account_id'))->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
		}
    }
}