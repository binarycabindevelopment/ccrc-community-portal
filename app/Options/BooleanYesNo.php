<?php

namespace App\Options;

use BinaryCabin\Options\BaseOption;

class BooleanYesNo extends BaseOption {

	public function getArray(){
        return [
            '1' => 'Yes',
            '0' => 'No',
        ];
    }

}