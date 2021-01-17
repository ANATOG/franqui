<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Models\Consultants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Stevebauman\Purify\Facades\Purify;

class ConsultantsController extends BaseAdminController
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
                    'title' => 'required|unique:consultants,title',
                    'image' => 'required|image|mimes:jpeg,png,jpg|max:1024|dimensions:max_width=328,max_height=200',
                    'url'   => 'required|url'
                ];
            }
            case 'edit': {
                return [
                    'title' => 'required|unique:consultants,title,' . $id,
                    'image' => 'required|image|mimes:jpeg,png,jpg|max:1024|dimensions:max_width=328,max_height=200',
                    'url'   => 'required|url'
                ];
            }
            case 'edit_special': {
                return [
                    'title' => 'required|unique:consultants,title,' . $id,
                    'url'   => 'required|url'
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
            trans('custom.breadcrumbs_consultants'),
            trans('custom.breadcrumbs_list')
        ];

        $data['items'] = Consultants::ListAllConsultants($search, $order, $orderBy)->paginate($limit);

        return View::make('admin.consultants.list')->with($data);
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
            trans('custom.breadcrumbs_consultants'),
            trans('custom.breadcrumbs_create')
        ];

        return View::make('admin.consultants.create')->with($data);
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
            if ($this->storeConsultants($inputs, $request)) {
                return Redirect()->route('consultants.list')->with('message_success',
                    trans('custom.data_created_correctly'));
            } else {
                return Redirect::back()->withErrors(trans('custom.data_created_failed'));
            }
        }
    }

    /**
     * Create consultants
     *
     * @param $inputs
     * @param $request
     * @return bool
     */
    public function storeConsultants($inputs, $request)
    {
        $consultants        = new Consultants;
        $consultants->title = Purify::clean($inputs['title']);
        $consultants->url   = Purify::clean($inputs['url']);
        $consultants->image = $request->file('image')->store('consultants', 'public');
        return $consultants->save();
    }

    /**
     * @param Consultants $consultants
     * @return mixed
     * @internal param $id
     */
    public function edit(Consultants $consultants)
    {
        $data                = [];
        $data['loggedUser']  = $this->getLoggedUser();
        $data['breadcrumbs'] = [
            trans('custom.breadcrumbs_web_content'),
            trans('custom.breadcrumbs_consultants'),
            trans('custom.breadcrumbs_edit')
        ];
        $data['item']        = $consultants;

        return View::make('admin.consultants.edit')->with($data);
    }

    /**
     * @param Request $request
     * @param Consultants $consultants
     * @return mixed
     * @internal param $id
     */
    public function update(Request $request, Consultants $consultants)
    {
        $inputs = $request->all();

        $caseEdit = 'edit_special';
        if ($request->hasFile('image') || empty($inputs['old_image'])) {
            $caseEdit = 'edit';
        }

        $validate = Validator::make($inputs, $this->rules($caseEdit, $consultants->id));

        if ($validate->fails()) {
            return Redirect::back()->withErrors($validate->errors())->withInput();
        } else {
            if ($this->updateConsultants($request, $inputs, $consultants)) {
                return Redirect()->route('consultants.list')->with('message_success',
                    trans('custom.data_edited_correctly'));
            } else {
                return Redirect::back()->withErrors(trans('custom.data_edited_failed'));
            }
        }
    }

    /**
     * Update consultants
     *
     * @param $request
     * @param $inputs
     * @param $consultants
     * @return mixed
     */
    public function updateConsultants($request, $inputs, $consultants)
    {
        $consultants->title = Purify::clean($inputs['title']);
        $consultants->url   = Purify::clean($inputs['url']);
        if ($request->hasFile('image')) {
            if (file_exists('./uploads/' . $consultants->image)) {
                unlink('./uploads/' . $consultants->image);
            }
            $consultants->image = $request->file('image')->store('consultants', 'public');
        }
        return $consultants->save();
    }

    /**
     * @param Consultants $consultants
     * @return mixed
     * @internal param null $id
     */
    public function delete(Consultants $consultants)
    {
        $data                = [];
        $data['item']        = $consultants;
        $data['loggedUser']  = $this->getLoggedUser();
        $data['breadcrumbs'] = [
            trans('custom.breadcrumbs_web_content'),
            trans('custom.breadcrumbs_consultants'),
            trans('custom.breadcrumbs_delete')
        ];

        return View::make('admin.consultants.delete')->with($data);
    }

    /**
     * @param Consultants $consultants
     * @return mixed
     * @internal param Request $request
     */
    public function destroy(Consultants $consultants)
    {
        if (file_exists('./uploads/' . $consultants->image) && !empty($consultants->image)) {
            unlink('./uploads/' . $consultants->image);
        }

        if ($consultants->delete()) {
            return Redirect()->route('consultants.list')->with('message_success',
                trans('custom.data_deleted_correctly'));
        } else {
            return Redirect::back()->withErrors(trans('custom.data_deleted_failed'));
        }
    }

    /**
     * Set the item like visible or not
     *
     * @param Consultants $consultants
     * @return
     * @internal param null $id
     */
    public function changeVisible(Consultants $consultants)
    {
        if ($consultants->visible) {
            $consultants->visible = false;
        } else {
            $consultants->visible = true;
        }

        if ($consultants->save()) {
            return Redirect()->route('consultants.list')->with('message_success',
                trans('custom.data_change_visibility_correctly'));
        } else {
            return Redirect::back()->withErrors(trans('custom.data_change_visibility_failed'));
        }
    }

    /**
     * Sort answer
     *
     * @param Request $request
     * @internal param null $id
     * @return string
     */
    public function sort(Request $request)
    {
        $order = explode(',', $request->get("order"));
        foreach ($order as $index => $value) {
            $consultants        = Consultants::find($value);
            $consultants->order = $index;
            if (!$consultants->save()) {
                return json_encode(['status' => false]);
            }
        }

        return json_encode(['status' => true]);
    }
}
