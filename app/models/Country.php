<?php

class Country extends Eloquent {

	protected $table = 'countries';

	public function getAllCountries(){
		$countries = DB::table('countries')->get();
		return $countries;
	}
}