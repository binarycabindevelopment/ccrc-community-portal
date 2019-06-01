<?php

namespace App;

use App\Support\Traits\HasBillingMethod;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Permission\Traits\HasRoles;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;


class User extends Authenticatable implements HasMedia
{
    use Notifiable;
    use HasRoles;
    use HasMediaTrait;
    use HasBillingMethod;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'is_ccrc_manager',
        'company_name',
        'stripe_customer_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getNameAttribute(){
        if(!empty($this->first_name)){
            return $this->first_name.' '.$this->last_name;
        }
        return null;
    }

    public function registerMediaCollections()
    {
        $this
            ->addMediaCollection('avatar')
            ->singleFile();
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumbnail')
            ->crop(Manipulations::CROP_CENTER,300,300);
        $this->addMediaConversion('micro')
            ->crop(Manipulations::CROP_CENTER,50,50);
    }

    public function updatePassword($newPassword){
        \Auth::user()->password = \Hash::make($newPassword);
        \Auth::user()->save();
    }

    public function updateCCRCManager($isCCRCManager){
        if(!empty($isCCRCManager)){
            \Auth::user()->is_ccrc_manager = true;
            \Auth::user()->save();
        }else{
            \Auth::user()->is_ccrc_manager = false;
            \Auth::user()->save();
        }
    }

    public function isCCRCManager(){
        return $this->is_ccrc_manager;
    }

}
