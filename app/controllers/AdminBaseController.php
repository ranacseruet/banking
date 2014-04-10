<?php
/**
 * Description of UserBaseController
 *
 * @author Rana
 */
class AdminBaseController extends \BaseController
{
    /**
    * The layout that should be used for responses.
    */
    protected $layout = 'layouts.main';
    /**
     * @var User 
     */
    protected $user;
    
    public function __construct() 
    {
        parent::__construct();

        if(!Auth::check()) {
            return Redirect::to('users/login')
                    ->with('message', 'Please login first');
        }

        if(Auth::user()->rool_id != 1) {
            return Redirect::to('users/dashboard')
                    ->with('message', "You aren't an admin");
        }
        $this->user = Doctrine::getRepository("User")->find(Auth::user()->id);
    }
}
