<?php

use Atrauzzi\LaravelDoctrine\Support\Facades\Doctrine;

/**
 * User Controller
 *
 * Responsible for user registration, login and logout
 *
 * @author Eftakhairul Islam <eftakhairul@gmail.com>
 */
class UsersController extends BaseController
{

	protected $layout = "layouts.main";

    /**
     * Initializing value
     */
    public function __construct()
    {
        parent::__construct();

		$this->beforeFilter('auth', array('only'=>array('getDashboard')));

        if (Auth::check()) {
            return Redirect::to('users/dashboard')->with('message', 'You are already logged in!');
        }
	}

    /**
     * Return Register Page
     *
     * @route GET /users/register
     */
    public function getRegister()
    {
		$this->layout->content = View::make('users.register');
	}

    /**
     * Process Registration form
     *
     * @route POST /users/register
     * @return mixed
     */
    public function postRegister()
    {
		$validator = Validator::make(Input::all(), User::getRules());

		if ($validator->passes()) {

			$userEntity = new User;
			$userEntity->setUsername(Input::get('username'));
			$userEntity->setEmail(Input::get('email'));
			$userEntity->setPassword(Hash::make(Input::get('password')));
            $userEntity->setFirstName(Input::get('first_name'));
            $userEntity->setLastName(Input::get('last_name'));
            $userEntity->setCreateDate(new DateTime('now'));

            $userEntity->setRoolId(User::USER);
			Doctrine::persist($userEntity);
            Doctrine::flush();

			return Redirect::to('users/login')->with('message', 'Thanks for registering!');
		} else {
			return Redirect::to('users/register')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
		}
	}

    /**
     * Serve only the login page
     *
     *@route GET /users/Signin
     */
    public function getLogin()
    {
		$this->layout->content = View::make('users.login');
	}

    /**
     * Process the login page
     *
     * @route POST /users/Signin
     * @return mixed
     */
    public function postSignin()
    {
        $user = Doctrine::getRepository("User")->findOneBy(array("email" => Input::get('email')));

        if($user && Hash::check(Input::get('password'), $user->getPassword())) {
            Auth::login(User::find($user->getid()));

            return Redirect::to('home/dashboard')->with('message', 'You are now logged in!');
        } else {
            return Redirect::to('users/login')->with('message', 'Your username/password combination was incorrect')
				                              ->withInput();
		}
	}

    /**
     * @return mixed
     */
    public function getLogout()
    {
		Auth::logout();
		return Redirect::to('users/login')->with('message', 'Your are now logged out!');
	}
}