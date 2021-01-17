<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Stevebauman\Purify\Facades\Purify;

class Videos extends Model
{
    protected $table = 'videos';

    /**
     * List all elements on the DB for the Videos
     * @param $query
     * @param null $search
     * @param $order
     * @param $orderBy
     * @return
     */
    public function scopeListAllVideos($query, $search = null, $order, $orderBy)
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
    public function scopeGetFrontInfo($query)
    {
        $query->where('visible', true);
        $query->orderBy('id', 'DESC');
        return $query;
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
        return $query;
    }

}