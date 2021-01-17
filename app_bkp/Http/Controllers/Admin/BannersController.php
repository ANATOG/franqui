<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Models\Banners;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Stevebauman\Purify\Facades\Purify;

class BannersController extends BaseAdminController
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
                    'title'    => 'required|unique:banners,title',
                    'image'    => 'required|image|mimes:jpeg,png,jpg|max:2048',
                    'url'      => 'url',
                    'position' => 'required'
                ];
            }
            case 'edit': {
                return [
                    'title' => 'required|unique:banners,title,' . $id,
                    'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                    'url'   => 'url'
                ];
            }
            case 'edit_special': {
                return [
                    'title' => 'required|unique:banners,title,' . $id,
                    'url'   => 'url'
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
        $limit      = ($request->get('limit')) ? $limit = $request->get('limit') : $limit = 9999;
        $search     = $request->get('search');
        $order      = ($request->get('order')) ? $request->get('order') : 'order';
        $orderBy    = ($request->get('orderby')) ? $request->get('orderby') : 'asc';

        $data                = [];
        $data['loggedUser']  = $loggedUser;
        $data['breadcrumbs'] = [
            trans('custom.breadcrumbs_web_content'),
            trans('custom.breadcrumbs_banners'),
            trans('custom.breadcrumbs_list')
        ];

        $data['items'] = Banners::ListAllBanners($search, $order, $orderBy)->paginate($limit);

        return View::make('admin.banners.list')->with($data);
    }

    /**
     * @return mixed
     */
    public function create()
    {
        $data                = [];
        $data['loggedUser']  = $this->getLoggedUser();
        $data['breadcrumbs'] = [
            trans('custom.breadcrumbs_web_content'),
            trans('custom.breadcrumbs_banners'),
            trans('custom.breadcrumbs_create')
        ];

        return View::make('admin.banners.create')->with($data);
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
            if ($this->storeBanner($inputs, $request)) {
                return Redirect()->route('banners.list')->with('message_success',
                    trans('custom.data_created_correctly'));
            } else {
                return Redirect::back()->withErrors(trans('custom.data_created_failed'));
            }
        }
    }

    /**
     * Create banner
     *
     * @param $inputs
     * @param $request
     * @return bool
     */
    public function storeBanner($inputs, $request)
    {
        $banner           = new Banners;
        $banner->title    = Purify::clean($inputs['title']);
        $banner->url      = Purify::clean($inputs['url']);
        $banner->position = Purify::clean($inputs['position']);
        $banner->image    = $request->file('image')->store('banners', 'public');
        return $banner->save();
    }

    /**
     * @param Banners $banner
     * @return mixed
     * @internal param $id
     */
    public function edit(Banners $banner)
    {
        $data                = [];
        $data['loggedUser']  = $this->getLoggedUser();
        $data['breadcrumbs'] = [
            trans('custom.breadcrumbs_web_content'),
            trans('custom.breadcrumbs_banners'),
            trans('custom.breadcrumbs_edit')
        ];
        $data['item']        = $banner;

        return View::make('admin.banners.edit')->with($data);
    }

    /**
     * @param Request $request
     * @param Banners $banner
     * @return mixed
     * @internal param $id
     */
    public function update(Request $request, Banners $banner)
    {
        $inputs = $request->all();

        $caseEdit = 'edit_special';
        if ($request->hasFile('image') || empty($inputs['old_image'])) {
            $caseEdit = 'edit';
        }

        $validate = Validator::make($inputs, $this->rules($caseEdit, $banner->id));

        if ($validate->fails()) {
            return Redirect::back()->withErrors($validate->errors())->withInput();
        } else {
            if ($this->updateBanner($request, $inputs, $banner)) {
                return Redirect()->route('banners.list')->with('message_success',
                    trans('custom.data_edited_correctly'));
            } else {
                return Redirect::back()->withErrors(trans('custom.data_edited_failed'));
            }
        }
    }

    /**
     * Update banner
     *
     * @param $request
     * @param $inputs
     * @param $banner
     * @return mixed
     */
    public function updateBanner($request, $inputs, $banner)
    {
        $banner->title = Purify::clean($inputs['title']);
        $banner->url   = Purify::clean($inputs['url']);
        if ($request->hasFile('image')) {
            if (file_exists('./uploads/' . $banner->image)) {
                unlink('./uploads/' . $banner->image);
            }
            $banner->image = $request->file('image')->store('banners', 'public');
        }
        return $banner->save();
    }

    /**
     * @param Banners $banner
     * @return mixed
     * @internal param null $id
     */
    public function delete(Banners $banner)
    {
        $data                = [];
        $data['item']        = $banner;
        $data['loggedUser']  = $this->getLoggedUser();
        $data['breadcrumbs'] = [
            trans('custom.breadcrumbs_web_content'),
            trans('custom.breadcrumbs_banners'),
            trans('custom.breadcrumbs_delete')
        ];

        return View::make('admin.banners.delete')->with($data);
    }

    /**
     * @param Banners $banner
     * @return mixed
     * @internal param Request $request
     */
    public function destroy(Banners $banner)
    {
        if (file_exists('./uploads/' . $banner->image) && !empty($banner->image)) {
            unlink('./uploads/' . $banner->image);
        }

        if ($banner->delete()) {
            return Redirect()->route('banners.list')->with('message_success', trans('custom.data_deleted_correctly'));
        } else {
            return Redirect::back()->withErrors(trans('custom.data_deleted_failed'));
        }
    }

    /**
     * Set the item like visible or not
     *
     * @param Banners $banner
     * @return
     * @internal param null $id
     */
    public function changeVisible(Banners $banner)
    {
        if ($banner->visible) {
            $banner->visible = false;
        } else {
            $banner->visible = true;
        }

        if ($banner->save()) {
            return Redirect()->route('banners.list')->with('message_success',
                trans('custom.data_change_visibility_correctly'));
        } else {
            return Redirect::back()->withErrors(trans('custom.data_change_visibility_failed'));
        }
    }

    /**
     * Sort image
     *
     * @param Request $request
     * @internal param null $id
     * @return string
     */
    public function sort(Request $request)
    {
        $order = explode(',', $request->get("order"));
        foreach ($order as $index => $value) {
            $news        = Banners::find($value);
            $news->order = $index;
            if (!$news->save()) {
                return json_encode(['status' => false]);
            }
        }

        return json_encode(['status' => true]);
    }

}