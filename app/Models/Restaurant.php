<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    //protected $table = 'restaurants';
    //protected $primaryKey = 'restaurant_id';

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(){
        return 'slug';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','nit'
    ];

    public function branches(){
        return $this->hasMany(Branch::class);
    }
}
