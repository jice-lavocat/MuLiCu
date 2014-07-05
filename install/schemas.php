<?php

# Creates the models for the application
use Illuminate\Database\Capsule\Manager as Capsule;
Capsule::schema()->create('curators', function($table)
{
	$table->increments('id');
	$table->string('email')->unique();
	$table->timestamps();
});