<?php

namespace App;

use App\Repositories\CommunityRepository;
use BinaryCabin\LaravelUUID\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;

class CommunityManagementRequest extends Model
{

    use HasUUID;

    protected $fillable = [
        'uuid',
        'user_id',
        'community_uuid',
        'approved_at',
        'approved_by_user_id',
    ];

    protected $dates = [
        'approved_at'
    ];

    public function user(){
        return $this->belongsTo(\App\User::class,'user_id');
    }

    public function approvedByUser(){
        return $this->belongsTo(\App\User::class,'approved_by_user_id');
    }

    public function getCommunityName(){
        $communityUUID = $this->community_uuid;
        $name = \Cache::remember('community_'.$communityUUID.'_name', 3600, function () use($communityUUID) {
            $repository = new CommunityRepository();
            $community = $repository->find($communityUUID);
            return $community->name;
        });
        return $name;
    }

}
