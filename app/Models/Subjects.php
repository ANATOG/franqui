<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Stevebauman\Purify\Facades\Purify;

class Subjects extends Model
{
    protected $table = 'subjects';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'image'
    ];

    /**
     * List all elements on the DB for the Admins
     * @param $query
     * @param null $search
     * @param $order
     * @param $orderBy
     * @return
     */
    public function scopeListAllSubjects($query, $search = null, $order, $orderBy)
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
    public function scopeGetListSubjects($query)
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
     * Get the subjects associated with the given franchise.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function franchises()
    {
        return $this->hasMany(Franchises::class, 'subject_id', 'id');
    }

    /**
     * Get the tag associated with the given subjects.
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