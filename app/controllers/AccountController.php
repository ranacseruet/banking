<?php

/**
 * Account controller
 *
 * Responsible for all account related task of user
 *
 * @author Eftakhairul Islam <eftakhairul@gmail.com>
 */
use Atrauzzi\LaravelDoctrine\Support\Facades\Doctrine;

class AccountController extends BaseController
{
    
     protected $layout = "layouts.main";

     public function __construct()
     {
         parent::__construct();  
     }
}