<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultants extends Model
{
    protected $table = 'consultants';

    /**
     * List all elements on the DB for the Banners
     * @param $query
     * @param null $search
     * @param $order
     * @param $orderBy
     * @return
     */
    public function scopeListAllConsultants($query, $search = null, $order, $orderBy)
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
    public function scopeListAllConsultantsFront($query)
    {
        $query->orderBy('order', 'ASC');
        $query->where('visible', true);
        return $query;
    }
}