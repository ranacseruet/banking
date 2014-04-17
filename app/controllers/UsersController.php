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
            $userEntity->setBirthDate(new DateTime(Input::get('birth_date')));
            $userEntity->setAddress(Input::get('address'));
            $userEntity->setCreateDate(new DateTime('now'));
            $userEntity->setRoolId(User::USER);
            $userEntity->setPhone(Input::get('phone'));
			Doctrine::persist($userEntity);
            Doctrine::flush();
            $this->doLog("User created. User id:" .  $userEntity->getId());

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

            if($user->getRoolId() == User::ADMIN) {
                return Redirect::to('admin/dashboard')->with('message', 'You are now logged in!');
            } else {
                return Redirect::to('users/dashboard')->with('message', 'You are now logged in!');
            }
        } else {
            return Redirect::to('users/login')->with('message', 'Your username/password combination was incorrect')
				                              ->withInput();
		}
	}

    /**
     * Destroy the session
     *
     * @route GET /users/logout
     * @return mixed
     */
    public function getLogout()
    {
		Auth::logout();
		return Redirect::to('users/login')->with('message', 'Your are now logged out!');
	}


    /**
     * Serve the user dashboard
     *
     * @route GET /users/dashboard
     * @return mixed
     */
    public function getDashboard()
    {
        if (!Auth::check()) {
            return Redirect::to('users/login');
        }
        
        $this->data["user"] = Auth::user();

        if ($this->data["user"]->role_id == User::ADMIN) {
            return Redirect::to("admin/dashboard");
        } else {
            $user     = Doctrine::getRepository("User")->findOneById(Auth::user()->id);
            $accounts = Doctrine::getRepository("Account")->findby(array('user'     => $user->getId(),
                                                                         'isActive' => Account::APPROVED));
            if(!$accounts) {
                 $accounts =  new \Doctrine\Common\Collections\ArrayCollection();
            }

            $this->data["user"]     = $user;
            $this->data['accounts'] = $accounts;
            $this->layout->content  = View::make('users.dashboard', $this->data);
        }
	}

    /**
     * Show the password
     *
     * @route post /users/changepassword/id/{:id}
     */
    public function getChangepassword($id)
    {
        View::share('user_id', $id);
        $this->layout->content = View::make('users.changepassword');
    }


    /**
     * show the Pin
     *
     * @route post /card/processchangepassword
     */
    public function postProcesschangepassword()
    {
        $validator = Validator::make(Input::all(), User::getRulesForChangePassword());

        if ($validator->passes()) {

            $userEntity = Doctrine::getRepository("User")->find(Input::get('user_id'));

            if(!Hash::check(Input::get('old_password'), $userEntity->getPassword())) {
                return Redirect::to('users/changepassword/' . Input::get('user_id'))->with('message', "Old password doen't match");
            }

            $userEntity->setPassword(Hash::make(Input::get('password')));
            $userEntity->setUpdateDate(new \DateTime('now'));

			Doctrine::persist($userEntity);
            Doctrine::flush();


			if($userEntity->getRoolId() == User::ADMIN) {
                return Redirect::to('admin/dashboard')->with('message', 'Password Change Successfully.');
            } else {
                return Redirect::to('users/dashboard')->with('message', 'Password Change Successfully.');
            }
		} else {
			return Redirect::to('users/changepassword/' . Input::get('user_id'))->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
		}
    }
}
