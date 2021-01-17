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

class AdminController extends BaseAdminController
{


    private $messages = array('password.regex' => 'La contraseña debe ser alfanúmerica y contener 6 caractéres.');

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
                    'user_name'  => 'required|unique:users,user_name',
                    'password'   => 'alpha_num|min:6',
                    'email'      => 'required|email|unique:users,email',
                    'role_id'    => 'required'
                ];
            }
            case 'edit': {
                return [
                    'first_name' => 'required',
                    'user_name'  => 'required|unique:users,user_name,' . $id,
                    'password'   => 'alpha_num|min:6',
                    'email'      => 'required|email|unique:users,email,' . $id,
                    'role_id'    => 'required'
                ];
            }
            case 'edit_special': {
                return [
                    'first_name' => 'required',
                    'user_name'  => 'required|unique:users,user_name,' . $id,
                    'password'   => 'alpha_num|min:6',
                    'email'      => 'required|email|unique:users,email,' . $id
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
        $role       = $loggedUser->role_id;

        $data                = [];
        $data['loggedUser']  = $loggedUser;
        $data['breadcrumbs'] = [
            trans('custom.breadcrumbs_users'),
            trans('custom.breadcrumbs_admin'),
            trans('custom.breadcrumbs_list')
        ];

        $data['items'] = User::ListAllAdmins($search, $order, $orderBy, $role)->paginate($limit);

        return View::make('admin.admin.list')->with($data);
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
            trans('custom.breadcrumbs_admin'),
            trans('custom.breadcrumbs_create')
        ];

        return View::make('admin.admin.create')->with($data);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $inputs   = $request->all();
        $validate = Validator::make($inputs, $this->rules('create'), $this->messages);

        $loggedUser = $this->getLoggedUser();

        if ($loggedUser->getRoleName() != "root" && ($inputs['role_id'] == "2" || $inputs['role_id'] == "1")) {
            return Redirect::back()->withErrors("You can't create admins.");
        }

        if(!empty($inputs['password'])){
            $pos = strrpos($inputs['password'], " ");
            if($pos != false){
                return Redirect::back()->withErrors(trans('custom.password_no_blank'));
            }
            if($pos === 0){
                return Redirect::back()->withErrors(trans('custom.password_no_blank'));
            }
        }

        if ($validate->fails()) {
            return Redirect::back()->withErrors($validate->errors())->withInput();
        } else {
            if ($this->storeAdmin($inputs)) {
                return Redirect()->route('admin.list')->with('message_success', trans('custom.data_created_correctly'));
            } else {
                return Redirect::back()->withErrors(trans('custom.data_created_failed'));
            }
        }
    }

    /**
     * Create admin or content manager
     *
     * @param $inputs
     * @return bool
     */
    public function storeAdmin($inputs)
    {
        $admin             = new User;
        $admin->first_name = Purify::clean($inputs['first_name']);
        $admin->last_name  = Purify::clean($inputs['last_name']);
        $admin->email      = Purify::clean($inputs['email']);
        $admin->user_name  = Purify::clean($inputs['user_name']);
        $admin->role_id    = Purify::clean($inputs['role_id']);

        if (!empty($inputs['password'])) {
            $admin->password = Hash::make($inputs['password']);
        }

        return $admin->save();
    }

    /**
     * @param User $admin
     * @return mixed
     * @internal param $id
     */
    public function edit(User $admin)
    {
        $loggedUser = $this->getLoggedUser();
        if ($loggedUser->id != $admin->id && $loggedUser->hasRole(['content_manager'])) {
            return Redirect::back()->withErrors(trans('custom.data_no_allowed'));
        }

        if ($this->checkRoleAndNotId($loggedUser, $admin)) {
            return Redirect::back()->withErrors(trans('custom.data_edited_another_admin'));
        }

        $data               = [];
        $data['loggedUser'] = $loggedUser;

        $data['breadcrumbs'] = [
            trans('custom.breadcrumbs_users'),
            trans('custom.breadcrumbs_admin'),
            trans('custom.breadcrumbs_edit')
        ];
        $data['item']        = $admin;

        return View::make('admin.admin.edit')->with($data);
    }

    /**
     * @param Request $request
     * @param User $admin
     * @return mixed
     * @internal param $id
     */
    public function update(Request $request, User $admin)
    {

        $loggedUser = $this->getLoggedUser();

        if ($loggedUser->id != $admin->id && $loggedUser->hasRole(['content_manager'])) {
            return Redirect::back()->withErrors(trans('custom.data_no_allowed'));
        }

        if ($this->checkRoleAndNotId($loggedUser, $admin)) {
            return Redirect::back()->withErrors(trans('custom.data_edited_another_admin'));
        }

        $inputs = $request->all();

        $edit = 'edit';
        if (!$loggedUser->hasRole(['root', 'admin'])) {
            $edit = 'edit_special';
        }

        if(!empty($inputs['password'])){
            $pos = strrpos($inputs['password'], " ");
            if($pos != false){
                return Redirect::back()->withErrors(trans('custom.password_no_blank'));
            }
            if($pos === 0){
                return Redirect::back()->withErrors(trans('custom.password_no_blank'));
            }
        }

        $validate = Validator::make($inputs, $this->rules($edit, $admin->id), $this->messages);

        if ($validate->fails()) {
            return Redirect::back()->withErrors($validate->errors())->withInput();
        } else {
            if ($this->updateAdmin($admin, $inputs)) {
                if ($loggedUser->hasRole(['root', 'admin'])) {
                    return Redirect()->route('admin.list')->with('message_success',
                        trans('custom.data_edited_correctly'));
                } else {
                    return Redirect()->back()->with('message_success',
                        trans('custom.data_edited_correctly'));
                }
            } else {
                return Redirect::back()->withErrors(trans('custom.data_edited_failed'));
            }
        }
    }

    /**
     * Update admin or content manager
     *
     * @param $admin
     * @param $inputs
     * @return bool
     */
    public function updateAdmin($admin, $inputs)
    {
        $admin->first_name = Purify::clean($inputs['first_name']);
        $admin->last_name  = Purify::clean($inputs['last_name']);
        $admin->email      = Purify::clean($inputs['email']);
        $admin->user_name  = Purify::clean($inputs['user_name']);

        if ($this->getLoggedUser()->hasRole(['root', 'admin'])) {
            $admin->role_id = Purify::clean($inputs['role_id']);
        }

        if ($this->getLoggedUser()->hasRole(['root']) && $admin->id == 1) {
            $admin->role_id = 1;
        }

        if (!empty($inputs['password'])) {
            $admin->password = Hash::make($inputs['password']);
        }

        return $admin->save();
    }

    /**
     * @param User $admin
     * @return mixed
     * @internal param null $id
     */
    public function delete(User $admin)
    {
        $data                = [];
        $data['item']        = $admin;
        $data['loggedUser']  = $this->getLoggedUser();
        $data['breadcrumbs'] = [
            trans('custom.breadcrumbs_users'),
            trans('custom.breadcrumbs_admin'),
            trans('custom.breadcrumbs_delete')
        ];

        return View::make('admin.admin.delete')->with($data);
    }

    /**
     * @param User $admin
     * @return mixed
     * @internal param Request $request
     */
    public function destroy(User $admin)
    {

        $loggedUser = $this->getLoggedUser();

        if ($this->checkRoleAndNotId($loggedUser, $admin)) {
            return Redirect::back()->withErrors(trans('custom.data_deleted_another_admin'));
        }

        if ($admin->delete()) {
            return Redirect()->route('admin.list')->with('message_success', trans('custom.data_deleted_correctly'));
        } else {
            return Redirect::back()->withErrors(trans('custom.data_deleted_failed'));
        }
    }


    /**
     * Check if the admin is root, if only admin check if he is trying to edit/delete himself otherwise error
     *
     * @param $loggedUser
     * @param $admin
     * @return bool
     */
    public function checkRoleAndNotId($loggedUser, $admin)
    {
        if($loggedUser->hasRole(['root', 'admin']) && $admin->role_id == 3){
            return false;
        }
        if ($loggedUser->getRoleName() != "root" && $loggedUser->id != $admin->id) {
            return true;
        }
        return false;
    }

    /**
     * Set the item like visible or not
     *
     * @param User $admin
     * @return
     * @internal param null $id
     */
    public function changeVisible(User $admin)
    {
        $loggedUser = $this->getLoggedUser();

        if ($this->checkRoleAndNotId($loggedUser, $admin)) {
            return Redirect::back()->withErrors(trans('custom.data_edited_another_admin'));
        }

        if ($admin->visible) {
            $admin->visible = false;
        } else {
            $admin->visible = true;
        }

        if ($admin->save()) {
            return Redirect()->route('admin.list')->with('message_success',
                trans('custom.data_change_visibility_correctly'));
        } else {
            return Redirect::back()->withErrors(trans('custom.data_change_visibility_failed'));
        }
    }
}
