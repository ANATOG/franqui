<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    /**
     * Get the franchises associated with the given user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function franchises()
    {
        return $this->hasMany(Franchises::class, 'id', 'user_id');
    }

    /**
     * Get the franchises associated with the given user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function favorites()
    {
        return $this->belongsToMany(Franchises::class, 'favorites', 'users_id');
    }

    /**
     * Get the franchises associated with the given user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function getListFavorites()
    {
        return $this->favorites()->get()->pluck('id')->all();
    }

    public function getFavoritesList()
    {
        return $this->favorites()->get()->pluck('name', 'slug')->all();
    }

    /**
     * @param $roles
     * @return bool
     */
    public function hasRole($roles)
    {
        $this->have_role = $this->getUserRole();
        if($this->have_role->name == 'Root') {
            return true;
        }
        if(is_array($roles)){
            foreach($roles as $need_role){
                if($this->checkIfUserHasRole($need_role)) {
                    return true;
                }
            }
        } else{
            return $this->checkIfUserHasRole($roles);
        }
        return false;
    }

    /**
     * @return mixed
     */
    private function getUserRole()
    {
        return $this->role()->getResults();
    }

    public function getRoleName()
    {
        return $this->role()->get()->first()->name;
    }

    /**
     * @param $need_role
     * @return bool
     */
    private function checkIfUserHasRole($need_role)
    {
        return (strtolower($need_role)==strtolower($this->have_role->name)) ? true : false;
    }

    /**
     * List all elements on the DB for the Users
     * @param $query
     * @param null $search
     * @param $order
     * @param $orderBy
     * @param $role
     * @return
     */
    public function scopeListAllAdmins($query, $search = null, $order, $orderBy, $role)
    {
        if($role != '1') {
            $query->where('role_id', '<>', '1');
        }
        $query->where('role_id', '<>', '4');
        $query->where('role_id', '<>', '5');

        if ($search != null) {
            $query->where($order, 'LIKE', '%' . $search . '%');
        }
        $query->orderBy($order, $orderBy);
        return $query;
    }

    /**
     * List all elements on the DB for the Admins
     * @param $query
     * @param null $search
     * @param $order
     * @param $orderBy
     * @param $role
     * @return
     */
    public function scopeListAllUsers($query, $search = null, $order, $orderBy, $role)
    {
        $query->where('role_id', '=', $role);

        if ($search != null) {
            $query->where($order, 'LIKE', '%' . $search . '%');
        }
        $query->orderBy($order, $orderBy);
        return $query;
    }

    public function sendPasswordResetNotification($token) {
        $this->notify(new \App\Http\Controllers\Auth\ResetPasswordCustomController($token));
    }
}