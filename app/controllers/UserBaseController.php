<?php
/**
 * Description of UserBaseController
 *
 * @author Rana
 */
class UserBaseController extends BaseController
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
            header("Location: users/login");exit;
            //return Redirect::to('users/login');exit;
        }
        $this->user = Doctrine::getRepository("User")->find(Auth::user()->id);
        if(!$this->user) {
            return Redirect::to('users/login')->with('message', 'Please login first'); 
        }
    }
}
