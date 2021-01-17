<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FranchisesAreas extends Model
{
    protected $table = 'franchises_areas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function franchises()
    {
        return $this->hasOne(Franchises::class, 'id', 'franchise_id');
    }

}