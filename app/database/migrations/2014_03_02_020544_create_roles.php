<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoles extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('roles', function($table)
            {
               $table->increments('id');
               $table->string('name', 40)->unique();
               
           });
           DB::table('roles')->insert(
              array(array('name'  => 'admin'),array('name'  => 'user'))
              
           );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            Schema::drop('roles');
	}

}
