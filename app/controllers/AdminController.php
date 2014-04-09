<?php

use Atrauzzi\LaravelDoctrine\Support\Facades\Doctrine;

/**
 * Admin Controller
 *
 * Responsible for all admin related task
 *
 * @author Eftakhairul Islam <eftakhairul@gmail.com>
 */
class AdminController extends BaseController
{
    
     protected $layout = "layouts.main";

     public function __construct() {
         
         parent::__construct();  
    }
    
    public function getDashboard() {
        if(!$this->is_admin)
            return Redirect::to("/")->with('message', 'You are not logged in as admin!');
        
        $this->data["user"]   =     $this->logged_in_user;
        $this->data["users"]  = Doctrine::getRepository("User")->findby(array('roolId' => User::USER));
        $this->layout->content = View::make('admin.dashboard', $this->data);
    }


    /**
     * Return details of a user
     *
     * @param int $id
     * @route GET /admin/userdetails/id/{:id}
     * @return mixed
     */
    public function getUserdetails($id)
    {
        if (empty($id)) return Redirect::to('admin/dashboard')->with('message', 'User not found');
        $user = Doctrine::getRepository("User")->find($id);
        if (empty($user)) return Redirect::to('admin/dashboard')->with('message', 'User not found');

        $accounts = $user->getAccounts();
        if(!$accounts) {
             $accounts =  new \Doctrine\Common\Collections\ArrayCollection();
        }

        $this->data['accounts'] = $accounts;
        $this->data['user']     = $user;

        $this->layout->content = View::make('admin.userdetails', $this->data);

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