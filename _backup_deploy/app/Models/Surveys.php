<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surveys extends Model
{
    protected $table = 'surveys';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question', 'visible'
    ];

    /**
     * List all elements on the DB for the Surveys
     * @param $query
     * @param null $search
     * @param $order
     * @param $orderBy
     * @return
     */
    public function scopeListAllSurveys($query, $search = null, $order, $orderBy)
    {

        if ($search != null) {
            $query->where($order, 'LIKE', '%' . $search . '%');
        }
        $query->orderBy($order, $orderBy);
        return $query;
    }

    /**
     * Get the answers associated with the given surveys.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function answers()
    {
        return $this->hasMany(Answers::class, 'survey_id', 'id');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeGetItem($query)
    {
        $query->where('visible', true);
        return $query;
    }

}