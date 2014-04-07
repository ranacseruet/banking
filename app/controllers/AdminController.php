<?php

use Atrauzzi\LaravelDoctrine\Support\Facades\Doctrine;
class AdminController extends BaseController{
    
     protected $layout = "layouts.main";

     public function __construct() {
         
         parent::__construct();  
    }
    
    public function getDashboard() {
        if(!$this->is_admin)
            return Redirect::to("/")->with('message', 'You are not logged in as admin!');
        
        $this->data["user"]   =     $this->logged_in_user;      
        $this->layout->content = View::make('admin.dashboard', $this->data);
            
    }
    
    /**
     * Return list of user
     *
     * @route POST /users/Signin
     * @return mixed
     */
    public function getUserlist()
    {
        $users  = Doctrine::getRepository("User")->findby(array('roolId' => User::USER));
        View::share('users', $users);
        $this->layout->content = View::make('admin.list');
    }
}