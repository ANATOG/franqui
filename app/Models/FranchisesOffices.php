<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FranchisesOffices extends Model
{
    protected $table = 'franchises_offices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'lat', 'lng', 'full_direction', 'country'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function franchises()
    {
        return $this->hasOne(Franchises::class, 'id', 'franchise_id');
    }

}