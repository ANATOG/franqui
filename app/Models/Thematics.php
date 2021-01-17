<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Stevebauman\Purify\Facades\Purify;

class Thematics extends Model
{
    protected $table = 'thematics';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * List all elements on the DB for the Admins
     * @param $query
     * @param null $search
     * @param $order
     * @param $orderBy
     * @return
     */
    public function scopeListAllThematics($query, $search = null, $order, $orderBy)
    {
        if ($search != null) {
            $query->where($order, 'LIKE', '%' . $search . '%');
        }
        $query->orderBy($order, $orderBy);
        return $query;
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeGetFrontInfo($query){
        $query->where('visible', true);
        $query->orderBy('order', 'ASC');
        return $query;
    }

    /**
     * @param $query
     */
    public function scopeGetListThematics($query)
    {
        $query->where('visible', true);
        return $query->pluck('name', 'slug')->toArray();
    }

    /**
     * @param $query
     * @param $slug
     * @return mixed
     */
    public function scopeGetItem($query, $slug)
    {
        $query->where('slug', Purify::clean($slug));
        $query->where('visible', true);
        $query->orderBy('order', 'DESC');
        return $query;
    }

    /**
     * Get the thematics associated with the given franchise.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function franchises()
    {
        return $this->hasMany(Franchises::class, 'thematic_id', 'id');
    }

}