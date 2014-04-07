<?php

use Atrauzzi\LaravelDoctrine\Support\Facades\Doctrine;
class AccountController extends BaseController
{
    
     protected $layout = "layouts.main";

     public function __construct()
     {
         
         parent::__construct();  
     }
}