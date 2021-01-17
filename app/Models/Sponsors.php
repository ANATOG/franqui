<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sponsors extends Model
{
    protected $table = 'sponsors';

    /**
     * List all elements on the DB for the Sponsors
     * @param $query
     * @param null $search
     * @param $order
     * @param $orderBy
     * @return
     */
    public function scopeListAllSponsors($query, $search = null, $order, $orderBy)
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
        return $query;
    }


}