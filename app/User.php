<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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


    /**
     * Define the relation, a user can have many flyers
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function flyer()
    {
        return $this->hasMany('App\Flyer');
    }


    /**
     * Check if the given user equals to the authenticated user
     *
     * @param $relations
     * @return bool
     */
    public function owns($relations)
    {
        return $relations->user_id == $this->id;
    }


    /**
     * Save the given flyer
     *
     * @param Flyer $flyer
     * @return false|\Illuminate\Database\Eloquent\Model
     */
    public function publish(Flyer $flyer)
    {
        return $this->flyer()->save($flyer);
    }
}
