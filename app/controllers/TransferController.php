<?php

use Atrauzzi\LaravelDoctrine\Support\Facades\Doctrine;

class TransferController extends \BaseController {

        /**
        * The layout that should be used for responses.
        */
        protected $layout = 'layouts.main';
        
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
            //$transfers = new \Doctrine\Common\Collections\ArrayCollection();
            //$transfers->add((new Transaction())->setAmount(10));
            //$transfers->add((new Transaction())->setAmount(20));
            $transfers = Doctrine::getRepository("Transaction")->findAll();
            View::share('transfers', $transfers);
            $this->layout->content = View::make('transfer.list');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}