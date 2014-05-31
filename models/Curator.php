<?php

class Curator extends Illuminate\Database\Eloquent\Model {

	protected $table = "Curators";
	public $timestamps = false;

	public function scores() {
	return $this->hasMany('Article');
	}

}