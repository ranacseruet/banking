<?php

class HomeController extends BaseController
{

	protected $layout = "layouts.main";

	public function home()
	{

        $this->layout->content = View::make('home');
	}
}