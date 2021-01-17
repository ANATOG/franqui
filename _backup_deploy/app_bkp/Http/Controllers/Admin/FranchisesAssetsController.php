<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Models\Franchises;
use App\Models\FranchisesAssets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Stevebauman\Purify\Facades\Purify;

class FranchisesAssetsController extends BaseAdminController
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
                    'logo'       => 'required|image|mimes:jpeg,png,jpg|max:2048|dimensions:max_width=280,max_height=180',
                    'image_top'  => 'required|image|mimes:jpeg,png,jpg|max:2048|dimensions:max_width=1920,max_height=576',
                    'right_one'  => 'required|image|mimes:jpeg,png,jpg|max:2048',
                    'left_one'   => 'required|image|mimes:jpeg,png,jpg|max:2048',
                    'left_two'   => 'required|image|mimes:jpeg,png,jpg|max:2048',
                    'left_three' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                ];
            }
            case 'edit': {
                return [
                    'image' => 'image|mimes:jpeg,png,jpg|max:2048',
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
            trans('custom.breadcrumbs_franchises_assets'),
            trans('custom.breadcrumbs_list')
        ];

        $data['items']     = $franchise->franchiseAsset()->orderBy('order', 'ASC')->get();
        $data['franchise'] = $franchise;

        return View::make('admin.franchises_assets.list')->with($data);
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
            trans('custom.breadcrumbs_franchises_assets'),
            trans('custom.breadcrumbs_create')
        ];
        $data['franchise_id'] = $franchise['id'];

        return View::make('admin.franchises_assets.create')->with($data);
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
            return Redirect::back()->withErrors($validate->errors());
        } else {

            if ($this->createFranchiseAsset($request, $franchise)) {

                return Redirect()->route('franchises_assets.list',
                    ['franchise' => $franchise['id']])->with('message_success',
                    trans('custom.data_created_correctly'));
            } else {
                return Redirect()->route('franchises_assets.list',
                    ['franchise' => $franchise['id']])->with('message_success',
                    trans('custom.data_created_failed'));
            }
        }
    }

    /**
     * @param $request
     * @param $franchise
     * @return mixed
     * @internal param $franchisesAssets
     * @internal param $inputs
     */
    public function createFranchiseAsset($request, $franchise)
    {

        $images['logo']       = $request->file('logo')->store('franchises/' . $franchise->id, 'public');
        $images['image_top']  = $request->file('image_top')->store('franchises/' . $franchise->id, 'public');
        $images['right_one']  = $request->file('right_one')->store('franchises/' . $franchise->id, 'public');
        $images['left_one']   = $request->file('left_one')->store('franchises/' . $franchise->id, 'public');
        $images['left_two']   = $request->file('left_two')->store('franchises/' . $franchise->id, 'public');
        $images['left_three'] = $request->file('left_three')->store('franchises/' . $franchise->id, 'public');

        foreach ($images as $key => $image) {
            $franchise->franchiseAsset()->create([
                'image'    => $image,
                'position' => $key
            ]);
        }

        $franchise->video = $this->checkVideo($request['video']);
        $franchise->save();

        return true;
    }

    /**
     * @param Franchises $franchise
     * @param FranchisesAssets $franchisesAssets
     * @return mixed
     * @internal param $id
     */
    public function edit(Franchises $franchise, FranchisesAssets $franchisesAssets)
    {
        $data                 = [];
        $data['loggedUser']   = $this->getLoggedUser();
        $data['breadcrumbs']  = [
            trans('custom.breadcrumbs_web_content'),
            trans('custom.breadcrumbs_franchises_assets'),
            trans('custom.breadcrumbs_edit')
        ];
        $data['item']         = $franchisesAssets;
        $data['franchise_id'] = $franchise['id'];

        return View::make('admin.franchises_assets.edit')->with($data);
    }

    /**
     * @param Request $request
     * @param Franchises $franchise
     * @param FranchisesAssets $franchisesAssets
     * @return mixed
     * @internal param $id
     */
    public function update(Request $request, Franchises $franchise, FranchisesAssets $franchisesAssets)
    {

        $inputs = $request->all();

        $validate = Validator::make($inputs, $this->rules('edit', $franchise->id));

        if ($validate->fails()) {
            return Redirect::back()->withErrors($validate->errors())->withInput();
        } else {

            if ($this->updateFranchiseAsset($request, $franchise, $franchisesAssets, $inputs)) {
                return Redirect()->route('franchises_assets.list',
                    ['franchise' => $franchise['id']])->with('message_success',
                    trans('custom.data_edited_correctly'));
            } else {
                return Redirect::back()->withErrors(trans('custom.data_edited_failed'));
            }
        }
    }

    /**
     * @param Franchises $franchise
     * @return mixed
     * @internal param $id
     */
    public function editVideo(Franchises $franchise)
    {
        $data                 = [];
        $data['loggedUser']   = $this->getLoggedUser();
        $data['breadcrumbs']  = [
            trans('custom.breadcrumbs_web_content'),
            trans('custom.breadcrumbs_franchises_assets'),
            trans('custom.breadcrumbs_edit')
        ];
        $data['item']         = $franchise;
        $data['franchise_id'] = $franchise['id'];

        return View::make('admin.franchises_assets.edit_video')->with($data);
    }

    /**
     * @param Request $request
     * @param Franchises $franchise
     * @return mixed
     * @internal param $id
     */
    public function updateVideo(Request $request, Franchises $franchise)
    {
        $franchise->video = $this->checkVideo($request['video']);
        $franchise->save();
        return Redirect()->route('franchises_assets.list',
            ['franchise' => $franchise['id']])->with('message_success',
            trans('custom.data_edited_correctly'));
    }

    /**
     * @param $request
     * @param $franchise
     * @param $franchisesAssets
     * @param $inputs
     * @return mixed
     * @internal param $inputs
     */
    public function updateFranchiseAsset($request, $franchise, $franchisesAssets, $inputs)
    {
        $franchisesAssets->position = Purify::clean($inputs['position']);
        if ($request->hasFile('image')) {
            if (file_exists('./uploads/' . $franchisesAssets->image) && !empty($franchisesAssets->image)) {
                unlink('./uploads/' . $franchisesAssets->image);
            }
            $franchisesAssets->image = $request->file('image')->store('franchises/' . $franchise->id, 'public');
            return $franchisesAssets->save();
        }else{
            $franchise->video = $this->checkVideo($request['video']);
            return $franchise->save();
        }
    }

    /**
     * @param Franchises $franchise
     * @param FranchisesAssets $franchisesAssets
     * @return mixed
     * @internal param null $id
     */
    public function delete(Franchises $franchise, FranchisesAssets $franchisesAssets)
    {
        $data                 = [];
        $data['item']         = $franchisesAssets;
        $data['franchise_id'] = $franchise['id'];
        $data['loggedUser']   = $this->getLoggedUser();
        $data['breadcrumbs']  = [
            trans('custom.breadcrumbs_web_content'),
            trans('custom.breadcrumbs_franchises_assets'),
            trans('custom.breadcrumbs_delete')
        ];

        return View::make('admin.franchises_assets.delete')->with($data);
    }

    /**
     * @param Franchises $franchise
     * @param FranchisesAssets $franchisesAssets
     * @return mixed
     * @internal param Request $request
     */
    public function destroy(Franchises $franchise, FranchisesAssets $franchisesAssets)
    {
        if ($franchisesAssets->delete()) {
            return Redirect()->route('franchises_assets.list',
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
            $franchisesAssets        = FranchisesAssets::find($value);
            $franchisesAssets->order = $index;
            if (!$franchisesAssets->save()) {
                return json_encode(['status' => false]);
            }
        }

        return json_encode(['status' => true]);
    }

    /**
     * Get the ID of video of Vimeo or Youtube
     *
     * @param $url
     * @return mixed
     */
    public function checkVideo($url)
    {
        preg_match('#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#', $url,
            $matches);
        if (!empty($matches)) {
            $idVideo = $matches[0];
        } else {
            preg_match('/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/([a-z]*\/)*([‌​0-9]{6,11})[?]?.*/', $url,
                $matches);
            if (!empty($matches)) {
                $idVideo = $matches[5];
            } else {
                $idVideo = $url;
            }
        }
        return $idVideo;
    }

}