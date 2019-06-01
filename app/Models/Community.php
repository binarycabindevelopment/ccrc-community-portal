<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
{

    protected $guarded = [];

    public function getPath($suffix=''){
        if(!empty($suffix)){
            if (substr($suffix, 0, 1) !== '/') {
                $suffix = '/'.$suffix;
            }
        }
        return '/community/'.$this->uuid.$suffix;
    }

    public function getContactRecipientEmail(){
        //TODO return the CCRC user this is tied to
        return 'info@flywheelliving.com';
    }

}
