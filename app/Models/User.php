<?php

namespace App\Models;

use App\Models\Roles\Role;
use App\Models\Route\Route;
use App\Permissions\HasPermissionsTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class User extends Authenticatable
{
    use Notifiable, HasPermissionsTrait; //, SoftDeletes;

    /*
     * Set the logged in user id on resource create in DB
     * */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
            $query->company_id = 1;
            //$query->terminal_id = Auth::user()->terminal_id;
        });

    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /*
     * @return the list of Destinations
     * */
    public function cities()
    {
        return $this->hasMany(City::class);
    }

    /*
     * @return the list of Routes
     * created by user routes
     * */
    /*public function routes()
    {
        return $this->hasMany(Route::class);
    }*/

    /*
     * @return the list of Routes
     * has preminssion to book tickets
     * */
    public function routes()
    {
        return $this->belongsToMany(Route::class);
    }



    public function city(){
        return $this->belongsTo(City::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function terminal(){
        return $this->belongsTo(Terminal::class);
    }

    public function tickets(){
        return $this->hasMany(Ticket::class);
    }

    public function department(){
        return $this->belongsTo(Department::class, 'dept_id');
    }

    public function designation(){
        return $this->belongsTo(Designation::class, 'design_id');
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

}
