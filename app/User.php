<?php

namespace App;
// namespace App\Models;
use App\Notifications\UserRegistered;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Notification;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
    use Notifiable, HasRoles, LogsActivity, CausesActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'email', 'password', 'google_id',
    ];

    protected static $logAttributes = ['name', 'email','password'];
    protected static $logOnlyDirty = true;
    public static $logFillable=true;
    protected static $logAttributesToIgnore = ['remember_token'];
    protected static $ignoreChangedAttributes = ['remember_token'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [ 'email_verified_at' => 'datetime', ];

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'author_id');
    }

    
    public static function boot()           
    {
        parent::boot();
        static::created(function($model){
           $admins=User::all()->filter(function ($user)
         {
            return $user->hasRole('super-admin');
        });
        Notification::send($admins,new UserRegistered($model))  ;
        });
    }
    public function requests()
    {
        return $this->hasMany('App\Request');
    }

}