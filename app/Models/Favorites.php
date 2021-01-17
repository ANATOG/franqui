<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorites extends Model
{
    protected $table = 'favorites';

    public function franchises()
    {
        return $this->belongsTo(Franchises::class);
    }

    public function users()
    {
        return $this->belongsTo(Users::class);
    }


}