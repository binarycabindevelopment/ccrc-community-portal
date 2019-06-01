<?php

namespace App;

use App\Repositories\CommunityRepository;
use BinaryCabin\LaravelUUID\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;

class ContactSubmission extends Model
{

    use HasUUID;

    protected $fillable = [
        'uuid',
        'community_id',
        'community_uuid',
        'first_name',
        'last_name',
        'email',
        'phone',
        'message',
        'subscribe',
        'recipients',
    ];

    public function getCommunity(){
        $communityRepository = new CommunityRepository();
        $community = $communityRepository->find($this->community_uuid);
        return $community;
    }

    public function sendMail(){
        \Mail::send(new \App\Mail\ContactSubmission($this));
    }

}
