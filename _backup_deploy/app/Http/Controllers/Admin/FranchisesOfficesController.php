<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Models\Franchises;
use App\Models\FranchisesOffices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Stevebauman\Purify\Facades\Purify;

class FranchisesOfficesController extends BaseAdminController
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
                    'latitud' => 'required|regex:/^-?\d{1,2}\.\d{6,}$/',
                    'longitud' => 'required|regex:/^-?\d{1,2}\.\d{6,}$/'
                ];
            }
            case 'edit': {
                return [
                    'latitud' => 'required|regex:/^-?\d{1,2}\.\d{6,}$/',
                    'longitud' => 'required|regex:/^-?\d{1,2}\.\d{6,}$/'
                ];
            }
            default:
                break;
        }
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'latitud.required' => 'La latitud debe estar completa. Debes seleccionar una opción del desplegable.',
            'longitud.required'  => 'La longitud debe esta completa. Debes seleccionar una opción del desplegable.',
        ];
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
            trans('custom.breadcrumbs_franchises_offices'),
            trans('custom.breadcrumbs_list')
        ];

        $data['items']     = $franchise->franchiseOffice()->orderBy('order', 'ASC')->get();
        $data['franchise'] = $franchise;

        return View::make('admin.franchises_offices.list')->with($data);
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
            trans('custom.breadcrumbs_franchises_offices'),
            trans('custom.breadcrumbs_create')
        ];
        $data['franchise_id'] = $franchise['id'];

        return View::make('admin.franchises_offices.create')->with($data);
    }

    /**
     * @param Request $request
     * @param Franchises $franchise
     * @return mixed
     */
    public function store(Request $request, Franchises $franchise)
    {
        $inputs   = $request->all();
        $validate = Validator::make($inputs, $this->rules('create'), $this->messages());

        if ($validate->fails()) {
            return Redirect::back()->withErrors($validate->errors())->withInput();
        } else {

            if ($this->createFranchiseOffice($franchise, $inputs)) {

                return Redirect()->route('franchises_offices.list',
                    ['franchise' => $franchise['id']])->with('message_success',
                    trans('custom.data_created_correctly'));
            } else {
                return Redirect()->route('franchises_offices.list',
                    ['franchise' => $franchise['id']])->with('message_success',
                    trans('custom.data_created_failed'));
            }
        }
    }

    /**
     * @param $franchise
     * @param $inputs
     * @return mixed
     * @internal param $franchisesOffices
     * @internal param $inputs
     */
    public function createFranchiseOffice($franchise, $inputs)
    {
        $franchise->franchiseOffice()->create(['name' => Purify::clean($inputs['name']), 'country' => Purify::clean($inputs['country']), 'lat' => Purify::clean($inputs['latitud']), 'lng' => Purify::clean($inputs['longitud']), 'full_direction' => Purify::clean($inputs['full_direction'])]);
        return true;
    }

    /**
     * @param Franchises $franchise
     * @param FranchisesOffices $franchisesOffices
     * @return mixed
     * @internal param $id
     */
    public function edit(Franchises $franchise, FranchisesOffices $franchisesOffices)
    {
        $data                 = [];
        $data['loggedUser']   = $this->getLoggedUser();
        $data['breadcrumbs']  = [
            trans('custom.breadcrumbs_web_content'),
            trans('custom.breadcrumbs_franchises_offices'),
            trans('custom.breadcrumbs_edit')
        ];
        $data['item']         = $franchisesOffices;
        $data['franchise_id'] = $franchise['id'];

        return View::make('admin.franchises_offices.edit')->with($data);
    }

    /**
     * @param Request $request
     * @param Franchises $franchise
     * @param FranchisesOffices $franchisesOffices
     * @return mixed
     * @internal param $id
     */
    public function update(Request $request, Franchises $franchise, FranchisesOffices $franchisesOffices)
    {

        $inputs = $request->all();

        $validate = Validator::make($inputs, $this->rules('edit', $franchise->id), $this->messages());

        if ($validate->fails()) {
            return Redirect::back()->withErrors($validate->errors())->withInput();
        } else {

            if ($this->updateFranchiseOffice($franchisesOffices, $inputs)) {
                return Redirect()->route('franchises_offices.list',
                    ['franchise' => $franchise['id']])->with('message_success',
                    trans('custom.data_edited_correctly'));
            } else {
                return Redirect::back()->withErrors(trans('custom.data_edited_failed'));
            }
        }
    }

    /**
     * @param $franchisesOffices
     * @param $inputs
     * @return mixed
     * @internal param $inputs
     */
    public function updateFranchiseOffice($franchisesOffices, $inputs)
    {
        $franchisesOffices->name           = Purify::clean($inputs['name']);
        $franchisesOffices->country        = Purify::clean($inputs['country']);
        $franchisesOffices->lat            = Purify::clean($inputs['latitud']);
        $franchisesOffices->lng            = Purify::clean($inputs['longitud']);
        $franchisesOffices->full_direction = Purify::clean($inputs['full_direction']);
        return $franchisesOffices->save();
    }

    /**
     * @param Franchises $franchise
     * @param FranchisesOffices $franchisesOffices
     * @return mixed
     * @internal param null $id
     */
    public function delete(Franchises $franchise, FranchisesOffices $franchisesOffices)
    {
        $data                 = [];
        $data['item']         = $franchisesOffices;
        $data['franchise_id'] = $franchise['id'];
        $data['loggedUser']   = $this->getLoggedUser();
        $data['breadcrumbs']  = [
            trans('custom.breadcrumbs_web_content'),
            trans('custom.breadcrumbs_franchises_offices'),
            trans('custom.breadcrumbs_delete')
        ];

        return View::make('admin.franchises_offices.delete')->with($data);
    }

    /**
     * @param Franchises $franchise
     * @param FranchisesOffices $franchisesOffices
     * @return mixed
     * @internal param Request $request
     */
    public function destroy(Franchises $franchise, FranchisesOffices $franchisesOffices)
    {
        if ($franchisesOffices->delete()) {
            return Redirect()->route('franchises_offices.list',
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
            $franchisesOffices        = FranchisesOffices::find($value);
            $franchisesOffices->order = $index;
            if (!$franchisesOffices->save()) {
                return json_encode(['status' => false]);
            }
        }

        return json_encode(['status' => true]);
    }

}