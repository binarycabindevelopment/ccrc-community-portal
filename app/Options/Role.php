<?php

namespace App\Options;

use BinaryCabin\Options\BaseOption;

class Role extends BaseOption {

	public function getArray(){
        return [
            'admin' => 'Admin',
            'authenticated' => 'Authenticated',
        ];
    }

}