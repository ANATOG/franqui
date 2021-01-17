<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Models\Franchises;
use App\Models\FranchisesAreas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Stevebauman\Purify\Facades\Purify;

class FranchisesAreasController extends BaseAdminController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $method
     * @return array
     */
    public function rules($method)
    {
        switch ($method) {
            case 'create': {
                return [
                    'name' => 'required'
                ];
            }
            case 'edit': {
                return [
                    'name' => 'required'
                ];
            }
            default:
                break;
        }
    }

    /**
     * @param Franchises $franchise
     * @return mixed
     */
    public function index(Franchises $franchise)
    {
        $loggedUser = $this->getLoggedUser();

        $data                = [];
        $data['loggedUser']  = $loggedUser;
        $data['breadcrumbs'] = [
            trans('custom.breadcrumbs_web_content'),
            trans('custom.breadcrumbs_franchises_areas'),
            trans('custom.breadcrumbs_list')
        ];

        $data['items']     = $franchise->franchiseAreas()->orderBy('order', 'ASC')->get();
        $data['franchise'] = $franchise;

        return View::make('admin.franchises_areas.list')->with($data);
    }

    /**
     * @param Franchises $franchise
     * @return mixed
     */
    public function create(Franchises $franchise)
    {
        $data                 = [];
        $data['loggedUser']   = $this->getLoggedUser();
        $data['breadcrumbs']  = [
            trans('custom.breadcrumbs_web_content'),
            trans('custom.breadcrumbs_franchises_areas'),
            trans('custom.breadcrumbs_create')
        ];
        $data['franchise_id'] = $franchise['id'];

        return View::make('admin.franchises_areas.create')->with($data);
    }

    /**
     * @param Request $request
     * @param Franchises $franchise
     * @return mixed
     */
    public function store(Request $request, Franchises $franchise)
    {
        $inputs   = $request->all();
        $validate = Validator::make($inputs, $this->rules('create'));

        if ($validate->fails()) {
            return Redirect::back()->withErrors($validate->errors())->withInput();
        } else {

            if ($this->createFranchiseAreas($franchise, $inputs)) {

                return Redirect()->route('franchises_areas.list',
                    ['franchise' => $franchise['id']])->with('message_success',
                    trans('custom.data_created_correctly'));
            } else {
                return Redirect()->route('franchises_areas.list',
                    ['franchise' => $franchise['id']])->with('message_success',
                    trans('custom.data_created_failed'));
            }
        }
    }

    /**
     * @param $franchise
     * @param $inputs
     * @return mixed
     * @internal param $franchisesAreas
     * @internal param $inputs
     */
    public function createFranchiseAreas($franchise, $inputs)
    {
        $franchise->franchiseAreas()->create(['name' => Purify::clean($inputs['name'])]);
        return true;
    }

    /**
     * @param Franchises $franchise
     * @param FranchisesAreas $franchisesAreas
     * @return mixed
     * @internal param $id
     */
    public function edit(Franchises $franchise, FranchisesAreas $franchisesAreas)
    {
        $data                 = [];
        $data['loggedUser']   = $this->getLoggedUser();
        $data['breadcrumbs']  = [
            trans('custom.breadcrumbs_web_content'),
            trans('custom.breadcrumbs_franchises_areas'),
            trans('custom.breadcrumbs_edit')
        ];
        $data['item']         = $franchisesAreas;
        $data['franchise_id'] = $franchise['id'];

        return View::make('admin.franchises_areas.edit')->with($data);
    }

    /**
     * @param Request $request
     * @param Franchises $franchise
     * @param FranchisesAreas $franchisesAreas
     * @return mixed
     * @internal param $id
     */
    public function update(Request $request, Franchises $franchise, FranchisesAreas $franchisesAreas)
    {

        $inputs = $request->all();

        $validate = Validator::make($inputs, $this->rules('edit', $franchise->id));

        if ($validate->fails()) {
            return Redirect::back()->withErrors($validate->errors())->withInput();
        } else {

            if ($this->updateFranchiseAreas($franchisesAreas, $inputs)) {
                return Redirect()->route('franchises_areas.list',
                    ['franchise' => $franchise['id']])->with('message_success',
                    trans('custom.data_edited_correctly'));
            } else {
                return Redirect::back()->withErrors(trans('custom.data_edited_failed'));
            }
        }
    }

    /**
     * @param $franchisesAreas
     * @param $inputs
     * @return mixed
     * @internal param $inputs
     */
    public function updateFranchiseAreas($franchisesAreas, $inputs)
    {
        $franchisesAreas->name           = Purify::clean($inputs['name']);
        return $franchisesAreas->save();
    }

    /**
     * @param Franchises $franchise
     * @param FranchisesAreas $franchisesAreas
     * @return mixed
     * @internal param null $id
     */
    public function delete(Franchises $franchise, FranchisesAreas $franchisesAreas)
    {
        $data                 = [];
        $data['item']         = $franchisesAreas;
        $data['franchise_id'] = $franchise['id'];
        $data['loggedUser']   = $this->getLoggedUser();
        $data['breadcrumbs']  = [
            trans('custom.breadcrumbs_web_content'),
            trans('custom.breadcrumbs_franchises_areas'),
            trans('custom.breadcrumbs_delete')
        ];

        return View::make('admin.franchises_areas.delete')->with($data);
    }

    /**
     * @param Franchises $franchise
     * @param FranchisesAreas $franchisesAreas
     * @return mixed
     * @internal param Request $request
     */
    public function destroy(Franchises $franchise, FranchisesAreas $franchisesAreas)
    {
        if ($franchisesAreas->delete()) {
            return Redirect()->route('franchises_areas.list',
                ['franchise' => $franchise['id']])->with('message_success',
                trans('custom.data_deleted_correctly'));
        } else {
            return Redirect::back()->withErrors(trans('custom.data_deleted_failed'));
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
            $franchisesAreas        = FranchisesAreas::find($value);
            $franchisesAreas->order = $index;
            if (!$franchisesAreas->save()) {
                return json_encode(['status' => false]);
            }
        }

        return json_encode(['status' => true]);
    }

}