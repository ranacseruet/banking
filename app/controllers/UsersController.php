<?php
use \Atrauzzi\LaravelDoctrine\Support\Facades\Doctrine;

class UsersController extends BaseController
{

	protected $layout = "layouts.main";

    /**
     * Initializing value
     */
    public function __construct()
    {
        parent::__construct();
		$this->beforeFilter('csrf', array('on'=>'post'));
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
			$userEntity->setEmailAddress(Input::get('email'));
			$userEntity->setPassword(Hash::make(Input::get('password')));
            $userEntity->setFirstName(Input::get('first_name'));
            $userEntity->setLastName(Input::get('last_name'));
            $userEntity->setCreateDate(new DateTime('now'));

            $userEntity->setRoolId(2);
			Doctrine::persist($userEntity);
            Doctrine::flush();

			return Redirect::to('users/login')->with('message', 'Thanks for registering!');
		} else {
			return Redirect::to('users/register')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
		}
	}

    /**
     *
     */
    public function getLogin() {
                
		$this->layout->content = View::make('users.login');
	}

    /**
     * @return mixed
     */
    public function postSignin() {
		if (Auth::attempt(array('email'=>Input::get('email'), 'password'=>Input::get('password')))) {
			return Redirect::to('users/dashboard')->with('message', 'You are now logged in!');
		} else {
			return Redirect::to('users/login')
				->with('message', 'Your username/password combination was incorrect')
				->withInput();
		}
	}

    /**
     * @return mixed
     */
    public function getDashboard() {
            $this->data["user"]   = Auth::user();
            
            $bill = new Bill();
            $bill->setName("test");
            \Atrauzzi\LaravelDoctrine\Support\Facades\Doctrine::persist($bill);
            \Atrauzzi\LaravelDoctrine\Support\Facades\Doctrine::flush();
            
            if($this->data["user"]->role_id==1){
                return Redirect::to("admin/dashboard");
            }
            else{
                $this->layout->content = View::make('users.dashboard',$this->data);
            }
	}

    /**
     * @return mixed
     */
    public function getLogout() {
		Auth::logout();
		return Redirect::to('users/login')->with('message', 'Your are now logged out!');
	}
}