<?php

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
    
    public function getUsers(){
        if(!$this->is_admin)
            return Redirect::to("/")->with('message', 'You are not logged in as admin!');
        
        $this->data["users"] = User::where('role_id',2)->get();
        
        $this->layout->content = View::make('admin.users', $this->data);
        
    }
}

?>
