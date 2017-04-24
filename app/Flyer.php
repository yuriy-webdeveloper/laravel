<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Flyer extends Model
{
    protected $table = 'flyers';


    /**
     * fillable fields for a flyer
     *
     * @var array
     */
    protected $fillable = [
        'street',
        'city',
        'zip',
        'state',
        'country',
        'price',
        'description',
    ];

    /**
     * A flyer has many photos
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
        return $this->hasMany('App\Photo');
    }

    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }


    /**
     * Determine if the given user created the flyer
     *
     * @param User $user
     * @return bool
     */
    public function ownedBy(User $user)
    {
        return $this->user_id == $user->id;
    }


    /**
     * Scope query for located at specified street and zip.
     *
     * @param Builder $query
     * @param string $zip
     * @param string $street
     * @return Builder mixed
     */
    public function scopeLocatedAt($query, $zip, $street)
    {
        //$street = str_replace(' ', '-', $street);

        return $query->where(compact('zip', 'street'))->firstOrFail();
    }

    public function getPriceAttribute($price)
    {
        return '$' . number_format($price);
    }

    public function addPhoto(Photo $photo)
    {
        return $this->photos()->save($photo);
    }


    public function path()
    {
        return $this->zip.'/'.$this->street;
    }


}
