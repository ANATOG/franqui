<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Stevebauman\Purify\Facades\Purify;

class Franchises extends Model
{
    protected $table = 'franchises';

    public function save(array $options = array()) {
        parent::save($options);

        $is_dollar = false;
        $investment = strtolower($this->total_investment);

        // separar por barra y tomar primer elemento
        if (strpos($investment, '/') !== false) {
            $investment = explode('/', $investment);
            $investment = $investment[0];
        }elseif (strpos($investment, 'a') !== false) {
           $investment = explode('a', $investment);
           $investment = $investment[0];
        }

        // detectar si es dolar
        if (strpos($investment, 'u$s') !== false) {
            $is_dollar = true;
        }

        // eliminar todo caracter no numerico
        $investment = preg_replace('/[^0-9]*/','',$investment);

        // si es dolar multiuplica por aproximado
        if ($is_dollar) {
            $investment = $investment * 15;
        }

        if (empty($investment)) {
            $investment = 0;
        }

        $this->pure_investment = $investment;

        $assets = $this->franchiseAsset()->count();
        if ($assets < 6) {
           $must_assets = ['logo', 'image_top', 'right_one', 'left_one', 'left_two', 'left_three'];

           for($i=0; $i<count($must_assets); $i++){
             $asset = new FranchisesAssets();
             $asset->image = '';
             $asset->position = $must_assets[$i];
             $asset->franchise_id = $this->id;
             $asset->order = 9999;
             $asset->visible = 1;

             $asset->save();
          }
        }

        return parent::save($options);
    }

    /**
     * List all elements on the DB for the Franchises
     * @param $query
     * @param null $search
     * @param $order
     * @param $orderBy
     * @param null $subject
     * @return 
     */
    public function scopeListAllFranchises($query, $search = null, $order, $orderBy, $subject = null)
    {

        if ($search != null) {
            $query->where($order, 'LIKE', '%' . $search . '%');
        }
        if ($subject != null) {
            $query->where('subject_id', $subject);
        }
        $query->orderBy($order, $orderBy);
        return $query;
    }

    /**
     * List all elements on the DB for the Franchises
     * @param $query
     * @param $id
     * @return
     */
    public function scopeGetFranchises($query, $id = null)
    {
        $query->where('visible', true);
        if($id != null) {
            $query->where('id', '<>', $id);
        }
        return $query;
    }

    /**
     * List all elements on the DB for the Franchises
     * @param $query
     * @param null $order
     * @param null $subject
     * @param null $search
     * @param null $price
     * @param null $pais
     * @return
     */
    public function scopeListAllFranchisesFront($query, $order = null, $subject = null, $search = null, $price = null, $pais=null)
    {
        //$query->where('countries_show', 'LIKE', '%' . Purify::clean($pais) . '%');
        $query->where('visible', true);
        if ($search != null) {
            $query->where('name', 'LIKE', '%' . Purify::clean($search) . '%');
        }
        if ($subject != null) {
            $query->where('subject_id', Purify::clean($subject));
        }
        if ($price != null) {
            $p = explode("-", Purify::clean($price));
            $query->whereBetween('total_investment', $p);
        }

        if ($order != null) {
            if($order == 'mayor-precio') {
                $query->orderBy('pure_investment', 'DESC');
            }
            if($order == 'menor-precio') {
                $query->orderBy('pure_investment', 'ASC');
            }
            if($order == 'alfabeticamente') {
                $query->orderBy('name', 'ASC');
            }
        }else{
            $query->orderBy('highlights', 'DESC');
            $query->orderBy('order', 'ASC');
        }
        return $query;
    }

    /**
     * List all elements on the DB for the Franchises
     * @param $query
     * @param null $order
     * @param null $subject
     * @param null $search
     * @param null $price
     * @param null $pais
     * @return
     */
    public function scopeListSearchFront($query, $order = null, $subject = null, $search = null, $price = null, $pais=null)
    {
        //$query->where('countries_show', 'LIKE', '%' . Purify::clean($pais) . '%');
        $query->where('visible', true);
        if ($search != null) {
            $query->where(function($query) use ($search) {
                $query->where('name', 'LIKE', '%' . Purify::clean($search) . '%');
               //  $query->orWhere('description', 'LIKE', '%' . Purify::clean($search) . '%');
               //  $query->orWhere('string_tags', 'LIKE', '%' . Purify::clean($search) . '%');
            });
        }

        if ($subject != null) {
            $query->where(function($query) use ($subject){
                $query->where('subject_id', Purify::clean($subject));
            });

        }
        if ($price != null) {
            $query->where(function($query) use ($price) {
                $p = explode("-", Purify::clean($price));
                $query->whereBetween('pure_investment', $p);
                $query->orderBy('pure_investment', 'ASC');
            });

        }
        if ($order != null) {
            if($order == 'mayor-precio') {
              $query->orderBy('pure_investment', 'DESC');
            }
            if($order == 'menor-precio') {
              $query->orderBy('pure_investment', 'ASC');
            }
            if($order == 'alfabeticamente') {
               $query->orderBy('name', 'ASC');
            }
        }else{
            $query->orderBy('highlights', 'DESC');
            $query->orderBy('order', 'ASC');
        }
        return $query;
    }

    /**
     * List all elements on the DB for the Franchises
     * @param $query
     * @param null $thematic
     * @param null $order
     * @param null $search
     * @param null $price
     **@param null $pais
     * @return
     */
    public function scopeListAllFranchisesFrontByThematic($query, $thematic = null, $order = null, $search = null, $price = null, $pais=null)
    {
        //$query->where('countries_show', 'LIKE', '%' . Purify::clean($pais) . '%');
        $query->where('visible', true);
        if ($search != null) {
            $query->where('name', 'LIKE', '%' . Purify::clean($search) . '%');
        }
        if ($thematic != null) {
            $query->where('thematic_id', Purify::clean($thematic));
        }
        if ($price != null) {
            $p = explode("-", Purify::clean($price));
            $query->whereBetween('total_investment', $p);
        }
        if ($order != null) {
            if($order == 'mayor-precio') {
                $query->orderBy('pure_investment', 'DESC');
            }
            if($order == 'menor-precio') {
                $query->orderBy('pure_investment', 'ASC');
            }
            if($order == 'alfabeticamente') {
                $query->orderBy('name', 'ASC');
            }
        }else{
            $query->orderBy('highlights', 'DESC');
            $query->orderBy('order', 'ASC');
        }
        return $query;
    }

    /**
     * List all elements on the DB for the Franchises
     * @param $query
     * @param null $search
     * @param $order
     * @param $orderBy
     * @param $user_id
     * @return
     */
    public function scopeListAllFranchisesByUser($query, $search = null, $order, $orderBy, $user_id)
    {

        if ($search != null) {
            $query->where($order, 'LIKE', '%' . $search . '%');
        }

        $query->where('user_id', $user_id);
        $query->orderBy($order, $orderBy);
        return $query;
    }

    /**
     * @param $query
     * @param $thematic
     */
    public function scopeGetFrontInfoByThematics($query, $thematic)
    {
        $query->where('thematic_id', $thematic);
        $query->where('visible', true);
        $query->orderBy('order', 'ASC');
        return $query;
    }

    /**
     * @param $query
     * @param $subject
     */
    public function scopeGetFrontInfoBySubjects($query, $subject)
    {
        $query->where('subject_id', $subject);
        $query->where('visible', true);
        $query->orderBy('order', 'ASC');
        return $query;
    }

    /**
     * @param $query
     * @param $slug
     * @return mixed
     */
    public function scopeGetItem($query, $slug, $showHidden = false)
    {
        $query->where('slug', Purify::clean($slug));
        if (!$showHidden) {
         $query->where('visible', true);
        }
        return $query;
    }

    /**
     * @param $query
     */
    public function scopeGetWeekly($query)
    {
        $query->where('visible', true);
        $query->where('weekly', true);
        $query->orderBy('weekly', 'DESC');
        return $query;
    }

    /**
     * @param $query
     */
    public function scopeGetWeeklyImage($query)
    {
        $query->franchiseAsset();
        $query->orderBy('order', 'ASC');
        return $query;
    }

    /**
     * @param $query
     */
    public function scopeGetHomeSubjectFranchise($query)
    {
        $query->orderBy('subject_highlight', 'DESC');
        return $query;
    }

    /**
     * @param $query
     */
    public function scopeGetHomeThematicFranchise($query, $thematic)
    {
        $query->where('thematic_id', $thematic);
        $query->where('visible', true);
        $query->inRandomOrder();
        return $query;
    }

    /**
     * @param $query
     */
    public function scopeGetListFranchise($query)
    {
        $query->where('visible', true);
        return $query->pluck('name', 'id')->toArray();
    }

    /**
     * Get the images associated with the given franchise.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function franchiseAsset()
    {
        return $this->hasMany(FranchisesAssets::class, 'franchise_id', 'id');
    }

    /**
     * Get the offices associated with the given franchise.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function franchiseOffice()
    {
        return $this->hasMany(FranchisesOffices::class, 'franchise_id', 'id');
    }

    /**
     * Get the areas associated with the given franchise.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function franchiseAreas()
    {
        return $this->hasMany(FranchisesAreas::class, 'franchise_id', 'id');
    }

    /**
     * Get the images associated with the given franchise.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function franchiseAssetFront()
    {
        return $this->franchiseAsset()->orderBy('order', 'ASC')->get();
    }

    /**
     * Get the thematic associated with the given franchise.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function thematic()
    {
        return $this->belongsTo(Thematics::class, 'thematic_id', 'id');
    }

    /**
     * Get the thematic associated with the given franchise.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subject()
    {
        return $this->belongsTo(Subjects::class, 'subject_id', 'id');
    }

    /**
     * Get the user associated with the given franchise.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Get the user associated with the given franchise.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function userFavorites()
    {
        return $this->belongsToMany(Users::class, 'favorites', 'franchises_id');
    }

    /**
     * @return mixed
     */
    public function getThematicName()
    {
        return $this->thematic()->get()->first()->name;
    }

    /**
     * @return mixed
     */
    public function getSubjectName()
    {
        return $this->subject()->get()->first()->name;
    }

    /**
     * @return mixed
     */
    public function getSubjectImage()
    {
        return $this->subject()->get()->first()->image;
    }

    /**
     * Get the tag associated with the given franchise.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tags::class)->withTimestamps();
    }

    public function getTagsIds()
    {
        return $this->tags()->get()->pluck('id')->all();
    }
}
