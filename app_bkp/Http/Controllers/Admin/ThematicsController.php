<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Models\Thematics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Stevebauman\Purify\Facades\Purify;

class ThematicsController extends BaseAdminController
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
                    'name' => 'required|unique:thematics,name'
                ];
            }
            case 'edit': {
                return [
                    'name' => 'required|unique:thematics,name,' . $id
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
        $limit      = 50;
        $search     = $request->get('search');
        $order      = 'order';
        $orderBy    = 'asc';

        $data                = [];
        $data['loggedUser']  = $loggedUser;
        $data['breadcrumbs'] = [
            trans('custom.breadcrumbs_web_content'),
            trans('custom.breadcrumbs_thematics'),
            trans('custom.breadcrumbs_list')
        ];

        $data['items'] = Thematics::ListAllThematics($search, $order, $orderBy)->paginate($limit);

        return View::make('admin.thematics.list')->with($data);
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
            trans('custom.breadcrumbs_thematics'),
            trans('custom.breadcrumbs_create')
        ];

        return View::make('admin.thematics.create')->with($data);
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

            $thematic       = new Thematics;
            $thematic->name = Purify::clean($inputs['name']);
            $thematic->slug = Purify::clean(str_slug($inputs['name'], '-'));

            if ($thematic->save()) {
                return Redirect()->route('thematics.list')->with('message_success',
                    trans('custom.data_created_correctly'));
            }else{
                return Redirect::back()->withErrors(trans('custom.data_created_failed'));
            }

        }
    }

    /**
     * @param Thematics $thematic
     * @return mixed
     * @internal param $id
     */
    public function edit(Thematics $thematic)
    {
        $data                = [];
        $data['loggedUser']  = $this->getLoggedUser();
        $data['breadcrumbs'] = [
            trans('custom.breadcrumbs_web_content'),
            trans('custom.breadcrumbs_thematics'),
            trans('custom.breadcrumbs_edit')
        ];
        $data['item']        = $thematic;

        return View::make('admin.thematics.edit')->with($data);
    }

    /**
     * @param Request $request
     * @param Thematics $thematic
     * @return mixed
     * @internal param $id
     */
    public function update(Request $request, Thematics $thematic)
    {
        $inputs = $request->all();

        $validate = Validator::make($inputs, $this->rules('edit', $thematic->id));

        if ($validate->fails()) {
            return Redirect::back()->withErrors($validate->errors())->withInput();
        } else {

            $thematic->name = Purify::clean($inputs['name']);
            $thematic->slug = Purify::clean(str_slug($inputs['name'], '-'));

            if ($thematic->save()) {
                return Redirect()->route('thematics.list')->with('message_success',
                    trans('custom.data_edited_correctly'));
            } else {
                return Redirect::back()->withErrors(trans('custom.data_edited_failed'));
            }
        }
    }

    /**
     * @param Thematics $thematic
     * @return mixed
     * @internal param null $id
     */
    public function delete(Thematics $thematic)
    {
        $data                = [];
        $data['item']        = $thematic;
        $data['loggedUser']  = $this->getLoggedUser();
        $data['breadcrumbs'] = [
            trans('custom.breadcrumbs_web_content'),
            trans('custom.breadcrumbs_thematics'),
            trans('custom.breadcrumbs_delete')
        ];

        return View::make('admin.thematics.delete')->with($data);
    }

    /**
     * @param Thematics $thematic
     * @return mixed
     * @internal param Request $request
     */
    public function destroy(Thematics $thematic)
    {
        if ($thematic->delete()) {
            return Redirect()->route('thematics.list')->with('message_success', trans('custom.data_deleted_correctly'));
        } else {
            return Redirect::back()->withErrors(trans('custom.data_deleted_failed'));
        }
    }

    /**
     * Set the item like visible or not
     *
     * @param Thematics $thematic
     * @return
     * @internal param null $id
     */
    public function changeVisible(Thematics $thematic)
    {
        if ($thematic->visible) {
            $thematic->visible = false;
        } else {
            $thematic->visible = true;
        }

        if ($thematic->save()) {
            return Redirect()->route('thematics.list')->with('message_success',
                trans('custom.data_change_visibility_correctly'));
        } else {
            return Redirect::back()->withErrors(trans('custom.data_change_visibility_failed'));
        }
    }

    /**
     * Set the item like highlights or not
     *
     * @param Thematics $thematic
     * @return
     * @internal param null $id
     */
    public function changeHighlights(Thematics $thematic)
    {
        if ($thematic->highlights) {
            $thematic->highlights = false;
        } else {
            Thematics::where('highlights', true)->update(['highlights' => false]);
            $thematic->highlights = true;
        }

        if ($thematic->save()) {
            return Redirect()->back()->with('message_success', trans('custom.data_change_highlights_correctly'));
        } else {
            return Redirect::back()->withErrors(trans('custom.data_change_highlights_failed'));
        }
    }

    /**
     * Sort thematics
     *
     * @param Request $request
     * @internal param null $id
     * @return string
     */
    public function sort(Request $request)
    {
        $order = explode(',', $request->get("order"));
        foreach ($order as $index => $value) {
            $thematic        = Thematics::find($value);
            $thematic->order = $index;
            if (!$thematic->save()) {
                return json_encode(['status' => false]);
            }
        }

        return json_encode(['status' => true]);
    }
}