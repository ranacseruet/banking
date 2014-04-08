<?php
/**
 * Description of UserBaseController
 *
 * @author Rana
 */
class UserBaseController extends \BaseController
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
        $this->user = Doctrine::getRepository("User")->find(Auth::user()->id);
    }
}
