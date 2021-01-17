<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Stevebauman\Purify\Facades\Purify;

class News extends Model
{
    protected $table = 'news';

    /**
     * List all elements on the DB for the News
     * @param $query
     * @param null $search
     * @param $order
     * @param $orderBy
     * @return
     */
    public function scopeListAllNews($query, $search = null, $order, $orderBy)
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

    /**
     * Get the tag associated with the given news.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tags::class)->withTimestamps();
    }

    public function getTagsNames()
    {
        return $this->tags()->get()->pluck('name')->all();
    }

    public function getTagsIds()
    {
        return $this->tags()->get()->pluck('id')->all();
    }

    public function getTagsList()
    {
        return $this->tags()->get()->pluck('name', 'id')->all();
    }

}