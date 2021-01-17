<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Models\Sponsors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Stevebauman\Purify\Facades\Purify;

class SponsorsController extends BaseAdminController
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
                    'title' => 'required|unique:news,title',
                    'link'  => 'required',
                    'image' => 'image|mimes:jpeg,png,jpg|max:2048|dimensions:max_width=220,max_height=120',
                ];
            }
            case 'edit': {
                return [
                    'title' => 'required|unique:news,title,' . $id,
                    'link'  => 'required',
                    'image' => 'image|mimes:jpeg,png,jpg|max:2048|dimensions:max_width=220,max_height=120',
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

        $data                = [];
        $data['loggedUser']  = $loggedUser;
        $data['breadcrumbs'] = [
            trans('custom.breadcrumbs_web_content'),
            trans('custom.breadcrumbs_sponsors'),
            trans('custom.breadcrumbs_list')
        ];

        $data['items'] = Sponsors::ListAllSponsors($search, $order, $orderBy)->paginate($limit);

        return View::make('admin.sponsors.list')->with($data);
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
            trans('custom.breadcrumbs_sponsors'),
            trans('custom.breadcrumbs_create')
        ];

        return View::make('admin.sponsors.create')->with($data);
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
            if ($this->storeSponsors($request, $inputs)) {
                return Redirect()->route('sponsors.list')->with('message_success', trans('custom.data_created_correctly'));
            } else {
                return Redirect::back()->withErrors(trans('custom.data_created_failed'));
            }
        }
    }

    /**
     * Create news
     *
     * @param $request
     * @param $inputs
     * @return bool
     */
    public function storeSponsors($request, $inputs)
    {
        $sponsors        = new Sponsors;
        $sponsors->title = Purify::clean($inputs['title']);
        $sponsors->link = Purify::clean($inputs['link']);
        $sponsors->image = $request->file('image')->store('sponsors', 'public');
        return $sponsors->save();
    }

    /**
     * @param Sponsors $sponsors
     * @return mixed
     * @internal param $id
     */
    public function edit(Sponsors $sponsors)
    {
        $data                = [];
        $data['loggedUser']  = $this->getLoggedUser();
        $data['breadcrumbs'] = [
            trans('custom.breadcrumbs_web_content'),
            trans('custom.breadcrumbs_sponsors'),
            trans('custom.breadcrumbs_edit')
        ];
        $data['item']        = $sponsors;

        return View::make('admin.sponsors.edit')->with($data);
    }

    /**
     * @param Request $request
     * @param Sponsors $sponsors
     * @return mixed
     * @internal param $id
     */
    public function update(Request $request, Sponsors $sponsors)
    {
        $inputs = $request->all();

        $validate = Validator::make($inputs, $this->rules('edit', $sponsors->id));

        if ($validate->fails()) {
            return Redirect::back()->withErrors($validate->errors())->withInput();
        } else {
            if ($this->updateSponsors($request, $sponsors, $inputs)) {
                return Redirect()->route('sponsors.list')->with('message_success', trans('custom.data_edited_correctly'));
            } else {
                return Redirect::back()->withErrors(trans('custom.data_edited_failed'));
            }
        }
    }

    /**
     * Update news
     *
     * @param $request
     * @param $sponsors
     * @param $inputs
     * @return mixed
     */
    public function updateSponsors($request, $sponsors, $inputs)
    {
        $sponsors->title = Purify::clean($inputs['title']);
        $sponsors->link = Purify::clean($inputs['link']);
        if ($request->hasFile('image')) {
            if (file_exists('./uploads/' . $sponsors->image) && !empty($sponsors->image)) {
                unlink('./uploads/' . $sponsors->image);
            }
            $sponsors->image = $request->file('image')->store('sponsors', 'public');
        }
        return $sponsors->save();
    }

    /**
     * @param Sponsors $sponsors
     * @return mixed
     * @internal param null $id
     */
    public function delete(Sponsors $sponsors)
    {
        $data                = [];
        $data['item']        = $sponsors;
        $data['loggedUser']  = $this->getLoggedUser();
        $data['breadcrumbs'] = [
            trans('custom.breadcrumbs_web_content'),
            trans('custom.breadcrumbs_sponsors'),
            trans('custom.breadcrumbs_delete')
        ];

        return View::make('admin.sponsors.delete')->with($data);
    }

    /**
     * @param Sponsors $sponsors
     * @return mixed
     * @internal param Request $request
     */
    public function destroy(Sponsors $sponsors)
    {
        if (file_exists('./uploads/' . $sponsors->image) && !empty($sponsors->image)) {
            unlink('./uploads/' . $sponsors->image);
        }
        if ($sponsors->delete()) {
            return Redirect()->route('sponsors.list')->with('message_success', trans('custom.data_deleted_correctly'));
        } else {
            return Redirect::back()->withErrors(trans('custom.data_deleted_failed'));
        }
    }

    /**
     * Set the item like visible or not
     *
     * @param Sponsors $sponsors
     * @return
     * @internal param null $id
     */
    public function changeVisible(Sponsors $sponsors)
    {
        if ($sponsors->visible) {
            $sponsors->visible = false;
        } else {
            $sponsors->visible = true;
        }

        if ($sponsors->save()) {
            return Redirect()->route('sponsors.list')->with('message_success',
                trans('custom.data_change_visibility_correctly'));
        } else {
            return Redirect::back()->withErrors(trans('custom.data_change_visibility_failed'));
        }
    }

}
