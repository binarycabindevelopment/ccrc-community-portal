<?php

namespace App\Options;

use BinaryCabin\Options\BaseOption;

class User extends BaseOption {

	public function getArray(){
	    $items = [];
	    $users = \App\User::orderBy('name','ASC')->get();
	    foreach($users as $user){
	        $items[$user->id] = $user->name.' ('.$user->email.')';
        }
        return $items;
    }

}