<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Stevebauman\Purify\Facades\Purify;

class UserController extends BaseAdminController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $method
     * @param null $id
     * @return array
     */
    public function rules($method, $id = null)
    {
        switch ($method) {
            case 'create': {
                return [
                    'first_name' => 'required',
                    'email'      => 'required|email|unique:users,email',
                    'password'   => 'alpha_num|min:6',
                    'role_id'    => 'required'
                ];
            }
            case 'edit': {
                return [
                    'first_name' => 'required',
                    'email'      => 'required|email|unique:users,email,' . $id,
                    'password'   => 'alpha_num|min:6',
                    'role_id'    => 'required'
                ];
            }
            default:
                break;
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $loggedUser = $this->getLoggedUser();
        $limit      = ($request->get('limit')) ? $limit = $request->get('limit') : $limit = 10;
        $search     = $request->get('search');
        $order      = ($request->get('order')) ? $request->get('order') : 'id';
        $orderBy    = ($request->get('orderby')) ? $request->get('orderby') : 'desc';
        $role       = 4;

        $data                = [];
        $data['loggedUser']  = $loggedUser;
        $data['breadcrumbs'] = [
            trans('custom.breadcrumbs_users'),
            trans('custom.breadcrumbs_registered'),
            trans('custom.breadcrumbs_list')
        ];

        $data['items'] = User::ListAllUsers($search, $order, $orderBy, $role)->paginate($limit);

        return View::make('admin.user.list')->with($data);
    }

    /**
     * @return mixed
     */
    public function create()
    {
        $data                = [];
        $data['loggedUser']  = $this->getLoggedUser();
        $data['breadcrumbs'] = [
            trans('custom.breadcrumbs_users'),
            trans('custom.breadcrumbs_registered'),
            trans('custom.breadcrumbs_create')
        ];

        return View::make('admin.user.create')->with($data);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $inputs   = $request->all();
        $validate = Validator::make($inputs, $this->rules('create'));

        if ($validate->fails()) {
            return Redirect::back()->withErrors($validate->errors())->withInput();
        } else {
            if ($this->storeUser($inputs)) {
                return Redirect()->route('user.list')->with('message_success', trans('custom.data_created_correctly'));
            } else {
                return Redirect::back()->withErrors(trans('custom.data_created_failed'));
            }
        }
    }

    /**
     * Create user
     *
     * @param $inputs
     * @return bool
     */
    public function storeUser($inputs)
    {
        $admin             = new User;
        $admin->first_name = Purify::clean($inputs['first_name']);
        $admin->email      = Purify::clean($inputs['email']);
        $admin->role_id    = Purify::clean($inputs['role_id']);

        if (!empty($inputs['password'])) {
            $admin->password = Hash::make($inputs['password']);
        }
        return $admin->save();
    }

    /**
     * @param User $user
     * @return mixed
     * @internal param $id
     */
    public function edit(User $user)
    {
        $data                = [];
        $data['loggedUser']  = $this->getLoggedUser();
        $data['breadcrumbs'] = [
            trans('custom.breadcrumbs_users'),
            trans('custom.breadcrumbs_registered'),
            trans('custom.breadcrumbs_edit')
        ];
        $data['item']        = $user;

        return View::make('admin.user.edit')->with($data);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return mixed
     * @internal param $id
     */
    public function update(Request $request, User $user)
    {
        $inputs   = $request->all();
        $validate = Validator::make($inputs, $this->rules('edit', $user->id));

        if ($validate->fails()) {
            return Redirect::back()->withErrors($validate->errors())->withInput();
        } else {
            if ($this->updateUser($user, $inputs)) {
                return Redirect()->route('user.list')->with('message_success', trans('custom.data_edited_correctly'));
            } else {
                return Redirect::back()->withErrors(trans('custom.data_edited_failed'));
            }
        }
    }

    /**
     * Update user
     *
     * @param $user
     * @param $inputs
     * @return mixed
     */
    public function updateUser($user, $inputs)
    {
        $user->first_name = Purify::clean($inputs['first_name']);
        $user->email      = Purify::clean($inputs['email']);
        $user->role_id    = Purify::clean($inputs['role_id']);

        if (!empty($inputs['password'])) {
            $user->password = Hash::make($inputs['password']);
        }
        return $user->save();
    }

    /**
     * @param User $user
     * @return mixed
     * @internal param null $id
     */
    public function delete(User $user)
    {
        $data                = [];
        $data['item']        = $user;
        $data['loggedUser']  = $this->getLoggedUser();
        $data['breadcrumbs'] = [
            trans('custom.breadcrumbs_users'),
            trans('custom.breadcrumbs_registered'),
            trans('custom.breadcrumbs_delete')
        ];

        return View::make('admin.user.delete')->with($data);
    }

    /**
     * @param User $user
     * @return mixed
     * @internal param Request $request
     */
    public function destroy(User $user)
    {
        if ($user->delete()) {
            return Redirect()->route('user.list')->with('message_success', trans('custom.data_deleted_correctly'));
        } else {
            return Redirect::back()->withErrors(trans('custom.data_deleted_failed'));
        }
    }

    /**
     * Set the item like visible or not
     *
     * @param User $user
     * @return
     * @internal param null $id
     */
    public function changeVisible(User $user)
    {
        if ($user->visible) {
            $user->visible = false;
        } else {
            $user->visible = true;
        }

        if ($user->save()) {
            return Redirect()->route('user.list')->with('message_success',
                trans('custom.data_change_visibility_correctly'));
        } else {
            return Redirect::back()->withErrors(trans('custom.data_change_visibility_failed'));
        }
    }
}
