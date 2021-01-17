<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Stevebauman\Purify\Facades\Purify;

class Tags extends Model
{
    protected $table = 'tags';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * List all elements on the DB for the Tags
     * @param $query
     * @param null $search
     * @param $order
     * @param $orderBy
     * @return
     */
    public function scopeListAllTags($query, $search = null, $order, $orderBy)
    {

        if ($search != null) {
            $query->where($order, 'LIKE', '%' . $search . '%');
        }
        $query->orderBy($order, $orderBy);
        return $query;
    }

    /**
     * @param $query
     * @param $tag
     * @return mixed
     */
    public function scopeGetItem($query, $tag)
    {
        $query->where('name', Purify::clean($tag));
        return $query;
    }

    /**
     * Get the subject associated with the given tag.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function subject()
    {
        return $this->belongsToMany(Subjects::class);
    }

    /**
     * Get the tag franchises with the given tag.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function franchises()
    {
        return $this->belongsToMany(Franchises::class);
    }

    /**
     * Get the tag news with the given tag.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function news()
    {
        return $this->belongsToMany(News::class);
    }
}