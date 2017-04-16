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
        'description'];

    /**
     * A flyer has many photos
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
        return $this->hasMany('App\Photo');
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

        return $query->where(compact('zip', 'street'))->first();
    }

    public function getPriceAttribute($price)
    {
        return '$'.number_format($price);
    }
}
