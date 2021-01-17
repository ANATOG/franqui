<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banners extends Model
{
    protected $table = 'banners';

    /**
     * List all elements on the DB for the Banners
     * @param $query
     * @param null $search
     * @param $order
     * @param $orderBy
     * @return
     */
    public function scopeListAllBanners($query, $search = null, $order, $orderBy)
    {

        if ($search != null) {
            $query->where($order, 'LIKE', '%' . $search . '%');
        }
        $query->orderBy($order, $orderBy);
        return $query;
    }

    /**
     * List all elements on the DB for the Banners
     * @param $query
     * @return
     */
    public function scopeListAllBannersFront($query)
    {
        $query->where('visible', true);
        return $query;
    }
}