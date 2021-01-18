<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Models\Franchises;
use App\Models\Tags;
use App\Models\User;
use App\Models\Thematics;
use App\Models\Subjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Stevebauman\Purify\Facades\Purify;

class FranchisesController extends BaseAdminController
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
                    'name'            => 'required|unique:franchises,name',
                    'subject_id'      => 'required|not_in:0',
                    'description_red' => 'max:255',
                    'user_id'         => 'required',
                    'cuit'            => 'numeric',
                    'website'         => 'url'
                ];
            }
            case 'edit': {
                return [
                    'name'              => 'required|unique:franchises,name,' . $id,
                    'subject_id'        => 'required|not_in:0',
                    'description_red'   => 'max:255',
                    // 'total_investment'  => 'numeric',
                    // 'fee'               => 'numeric',
                    // 'canon_advertising' => 'numeric',
                    // 'average_annual'    => 'numeric',
                    // 'franchises_total'  => 'numeric',
                    // 'franchises_local'  => 'numeric',
                    // 'grand_open'        => 'numeric',
                    // 'contact_email'     => 'email',
                    // 'email'             => 'required|email',
                    // 'total_investment'  => 'numeric',
                    // 'canon_advertising' => 'numeric',
                    // 'average_annual'    => 'numeric',
                    // 'fee'               => 'numeric',
                    // 'cuit'              => 'numeric',
                    // 'first_reasons'     => 'max:100',
                    // 'second_reasons'    => 'max:100',
                    // 'third_reasons'     => 'max:100',
                    // 'fourth_reasons'    => 'max:100',
                    // 'fifth_reasons'     => 'max:100',
                    'website'           => 'url'
                ];
            }
            case 'edit_special': {
                return [
                    'name'              => 'required|unique:franchises,name,' . $id,
                    'subject_id'        => 'required|not_in:0',
                    'description_red'   => 'max:255',
                    // 'total_investment'  => 'numeric',
                    'fee'               => 'numeric',
                    'canon_advertising' => 'numeric',
                    'average_annual'    => 'numeric',
                    'franchises_total'  => 'numeric',
                    'franchises_local'  => 'numeric',
                    'grand_open'        => 'numeric',
                    'contact_email'     => 'email',
                    'email'             => 'required|email',
                    // 'total_investment'  => 'numeric',
                    'canon_advertising' => 'numeric',
                    'average_annual'    => 'numeric',
                    'fee'               => 'numeric',
                    'cuit'              => 'numeric',
                    'first_reasons'     => 'max:100',
                    'second_reasons'    => 'max:100',
                    'third_reasons'     => 'max:100',
                    'fourth_reasons'    => 'max:100',
                    'fifth_reasons'     => 'max:100',
                    'website'           => 'url'
                ];
            }
            case 'franchise_owner': {
                return [
                    'name'              => 'required|unique:franchises,name,' . $id,
                    'description_red'   => 'max:255',
                    // 'total_investment'  => 'numeric',
                    'fee'               => 'numeric',
                    'canon_advertising' => 'numeric',
                    'average_annual'    => 'numeric',
                    'franchises_total'  => 'numeric',
                    'franchises_local'  => 'numeric',
                    'grand_open'        => 'numeric',
                    'contact_email'     => 'email',
                    // 'total_investment'  => 'numeric',
                    'canon_advertising' => 'numeric',
                    'average_annual'    => 'numeric',
                    'fee'               => 'numeric',
                    'cuit'              => 'numeric',
                    'first_reasons'     => 'max:100',
                    'second_reasons'    => 'max:100',
                    'third_reasons'     => 'max:100',
                    'fourth_reasons'    => 'max:100',
                    'fifth_reasons'     => 'max:100',
                    'website'           => 'url'
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
        $subject    = ($request->get('subject') && $request->get('subject') != 0) ? $request->get('subject') : null;

        $data               = [];
        $data['loggedUser'] = $loggedUser;
        $subjects           = Subjects::where('visible', true)->pluck('name', 'id')->toArray();
        // Add select option to the subjects array
        $data['subjects'] = ['0' => trans('custom.choose_subject')] + $subjects;

        $thematics = Thematics::where('visible', true)->pluck('name', 'id')->toArray();
        // Add select option to the thematics array
        $data['thematics'] = ['0' => trans('custom.choose_thematic')] + $thematics;

        $data['breadcrumbs'] = [
            trans('custom.breadcrumbs_web_content'),
            trans('custom.breadcrumbs_franchises'),
            trans('custom.breadcrumbs_list')
        ];

        if ($data['loggedUser']->hasRole(['root', 'admin'])) {
            $data['items'] = Franchises::ListAllFranchises($search, $order, $orderBy, $subject)->paginate($limit);
        } else {
            $data['items'] = Franchises::ListAllFranchisesByUser($search, $order, $orderBy,
                $loggedUser->id)->paginate($limit);
        }

        return View::make('admin.franchises.list')->with($data);
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
            trans('custom.breadcrumbs_franchises'),
            trans('custom.breadcrumbs_create')
        ];
        $subjects            = Subjects::where('visible', true)->pluck('name', 'id')->toArray();
        // Add select option to the subjects array
        $data['subjects'] = ['0' => trans('custom.choose_subject')] + $subjects;

        $franchises         = Franchises::GetFranchises()->pluck('name', 'id')->toArray();
        $data['franchises'] = ['0' => trans('custom.choose_suggested')] + $franchises;

        $thematics = Thematics::where('visible', true)->pluck('name', 'id')->toArray();
        // Add select option to the thematics array
        $data['thematics'] = ['0' => trans('custom.choose_thematic')] + $thematics;

        // REB agregar orden inverso
        $users = User::where('visible', true)->where('role_id', 3)->orderBy('id', 'desc')->pluck('user_name', 'id')->toArray();
        // Add select option to the subjects array
        $data['users'] = ['0' => trans('custom.choose_user')] + $users;

        return View::make('admin.franchises.create')->with($data);
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
            if ($this->storeFranchise($inputs)) {
                return Redirect()->route('franchises.list')->with('message_success',
                    trans('custom.data_created_correctly'));
            } else {
                return Redirect::back()->withErrors(trans('custom.data_created_failed'));
            }
        }
    }

    /**
     * Create franchise
     *
     * @param $inputs
     * @return bool
     */
    public function storeFranchise($inputs)
    {
        $franchise                         = new Franchises;
        $franchise->name                   = Purify::clean($inputs['name']);
        $franchise->slug                   = Purify::clean(str_slug($inputs['name'], '-'));
        $franchise->business_name          = Purify::clean($inputs['business_name']);
        $franchise->vat_condition          = Purify::clean($inputs['vat_condition']);
        $franchise->cuit                   = Purify::clean($inputs['cuit']);
        $franchise->contact_address        = Purify::clean($inputs['contact_address']);
        $franchise->authorizes_recruitment = Purify::clean($inputs['authorizes_recruitment']);
        $franchise->contrac_phone          = Purify::clean($inputs['contrac_phone']);
        $franchise->contact_email          = Purify::clean($inputs['contact_email']);
        $franchise->contracting_period     = Purify::clean($inputs['contracting_period']);
        $franchise->way_pay                = Purify::clean($inputs['way_pay']);
        $franchise->subject_id             = Purify::clean($inputs['subject_id']);
        $franchise->thematic_id            = Purify::clean($inputs['thematic_id']);

        if ($inputs['thematic_id'] != 0) {
            $franchise->thematic_id = Purify::clean($inputs['thematic_id']);
        } else {
            $franchise->thematic_id = null;
        }

        if (empty($inputs['user_id'])) {
            $franchise->user_id = null;
        } else {
            $franchise->user_id = Purify::clean($inputs['user_id']);
        }

        $franchise->first_suggested  = Purify::clean($inputs['first_suggested']);
        $franchise->second_suggested = Purify::clean($inputs['second_suggested']);
        $franchise->third_suggested  = Purify::clean($inputs['third_suggested']);
        $franchise->contact_name     = Purify::clean($inputs['contact_name']);
        $franchise->phone            = Purify::clean($inputs['phone']);
        $franchise->email            = Purify::clean($inputs['email']);
        $franchise->website          = Purify::clean($inputs['website']);
        $franchise->facebook         = Purify::clean($inputs['facebook']);
        $franchise->twitter          = Purify::clean($inputs['twitter']);
        $franchise->visible          = false;
        return $franchise->save();
    }

    /**
     * @param Franchises $franchise
     * @return mixed
     * @internal param $id
     */
    public function edit(Franchises $franchise)
    {
        $data               = [];
        $data['loggedUser'] = $this->getLoggedUser();

        if ($data['loggedUser']->id != $franchise->user_id && $data['loggedUser']->hasRole(['content_manager'])) {
            return Redirect::back()->withErrors(trans('custom.data_no_allowed'));
        }

        $data['breadcrumbs'] = [
            trans('custom.breadcrumbs_web_content'),
            trans('custom.breadcrumbs_franchises'),
            trans('custom.breadcrumbs_buttom_franchise_edit')
        ];
        $data['item']        = $franchise;
        $subject             = Subjects::find($franchise->subject_id);
        $tags                = $subject->getTagsList();
        // Add select option to the subjects array
        $data['tags'] = ['0' => trans('custom.choose_tags')] + $tags;

        $franchises         = Franchises::GetFranchises($franchise->id)->pluck('name', 'id')->toArray();
        $data['franchises'] = ['0' => trans('custom.choose_suggested')] + $franchises;


        $subjects = Subjects::where('visible', true)->pluck('name', 'id')->toArray();

        // var_dump($subjects);

        // Add select option to the subjects array
        $data['subjects'] = ['0' => trans('custom.choose_subject')] + $subjects;

        if ($data['loggedUser']->hasRole(['root', 'admin'])) {
            $thematics = Thematics::where('visible', true)->pluck('name', 'id')->toArray();
            // Add select option to the thematics array
            $data['thematics'] = ['0' => trans('custom.choose_thematic')] + $thematics;

            // REB invertir orden del combo de usuarios relacionados
            $users = User::where('visible', true)->where('role_id', 3)->orderBy('id', 'desc')->pluck('user_name', 'id')->toArray();

            // Add select option to the subjects array
            $data['users'] = ['0' => trans('custom.choose_user')] + $users;
        }

        return View::make('admin.franchises.nedit')->with($data);
    }

    /**
     * @param Request $request
     * @param Franchises $franchise
     * @return mixed
     * @internal param $id
     */
    public function update(Request $request, Franchises $franchise)
    {
        $loggedUser = $this->getLoggedUser();
        if ($loggedUser->id != $franchise->user_id && $loggedUser->hasRole(['content_manager'])) {
            return Redirect::back()->withErrors(trans('custom.data_no_allowed'));
        }

        $inputs = $request->all();;

        $caseEdit = 'edit_special';
        if (!$request->hasFile('image') && empty($inputs['old_image'])) {
            $caseEdit = 'edit';
        }

        // si es el dueño de la franquicia
        if ($loggedUser->hasRole(['content_manager']) && $loggedUser->id == $franchise->user_id) {
            $caseEdit = 'franchise_owner';
        }

        $validate = Validator::make($inputs, $this->rules($caseEdit, $franchise->id));

        // if ($validate->fails()) {
        //     return Redirect::back()->withErrors($validate->errors())->withInput();
        // } else {
            if ($this->updateFranchise($franchise, $inputs)) {
                return Redirect()->route('franchises.list')->with('message_success',
                    trans('custom.data_edited_correctly'));
            } else {
                return Redirect::back()->withErrors(trans('custom.data_edited_failed'));
            }
        //}
    }

    /**
     * Update franchise
     *
     * @param $franchise
     * @param $inputs
     * @return mixed
     */
    public function updateFranchise($franchise, $inputs)
    {
        $franchise->name                  = Purify::clean($inputs['name']);
        $franchise->slug                  = Purify::clean(str_slug($inputs['name'], '-'));
        $franchise->country               = Purify::clean($inputs['country']);
        $franchise->description_red       = Purify::clean($inputs['description_red']);
        $franchise->description           = Purify::clean($inputs['description']);
        $franchise->country_in            = Purify::clean($inputs['country_in']);

        $franchise->countries_show        = Purify::clean($inputs['countries_show']) ? $otraVariable : '0';

        $franchise->grand_open            = Purify::clean($inputs['grand_open']);
        $franchise->franchises_first_open = Purify::clean($inputs['franchises_first_open']);
        $franchise->franchises_local      = Purify::clean($inputs['franchises_local']);
        $franchise->franchises_this_year  = Purify::clean($inputs['franchises_this_year']);
        $franchise->franchises_total      = Purify::clean($inputs['franchises_total']);

        $franchise->fee = Purify::clean($inputs['fee']);
        $franchise->total_investment = Purify::clean($inputs['total_investment']);
        $franchise->canon_advertising = Purify::clean($inputs['canon_advertising']);
        $franchise->average_annual = Purify::clean($inputs['average_annual']);
        $franchise->royalty = Purify::clean($inputs['royalty']);

        $franchise->corporate_advertising = Purify::clean($inputs['corporate_advertising']);
        $franchise->financing_available   = Purify::clean($inputs['financing_available']);
        $franchise->recover_estimated     = Purify::clean($inputs['recover_estimated']);
        $franchise->premises_size         = Purify::clean($inputs['premises_size']);
        $franchise->employees             = Purify::clean($inputs['employees']);
        $franchise->contract_term         = Purify::clean($inputs['contract_term']);
        $franchise->exportable_franchise  = Purify::clean($inputs['exportable_franchise']);
        $franchise->first_reasons         = Purify::clean($inputs['first_reasons']);
        $franchise->second_reasons        = Purify::clean($inputs['second_reasons']);
        $franchise->third_reasons         = Purify::clean($inputs['third_reasons']);
        $franchise->fourth_reasons        = Purify::clean($inputs['fourth_reasons']);
        $franchise->fifth_reasons         = Purify::clean($inputs['fifth_reasons']);
        $franchise->meta_title            = Purify::clean($inputs['meta_title']);
        $franchise->meta_description      = Purify::clean($inputs['meta_description']);
        $franchise->meta_keywords         = Purify::clean($inputs['meta_keywords']);

        //$franchise->video = $this->checkVideo($inputs['video']);

        // REB
        $franchise->business_name          = Purify::clean($inputs['business_name']);
        $franchise->vat_condition          = Purify::clean($inputs['vat_condition']);
        $franchise->cuit                   = Purify::clean($inputs['cuit']);
        $franchise->contact_address        = Purify::clean($inputs['contact_address']);
        $franchise->authorizes_recruitment = Purify::clean($inputs['authorizes_recruitment']);
        $franchise->contrac_phone          = Purify::clean($inputs['contrac_phone']);
        $franchise->contact_email          = Purify::clean($inputs['contact_email']);

        if(!empty($inputs['contracting_period'])) {
            $franchise->contracting_period     = Purify::clean($inputs['contracting_period']);
        }

        $franchise->way_pay                = Purify::clean($inputs['way_pay']);

        // REB
        $franchise->partners         = Purify::clean($inputs['partners']);
        $franchise->contact_name     = Purify::clean($inputs['contact_name']);
        $franchise->phone            = Purify::clean($inputs['phone']);
        $franchise->email            = Purify::clean($inputs['email']);
        $franchise->website          = Purify::clean($inputs['website']);
        $franchise->facebook         = Purify::clean($inputs['facebook']);
        $franchise->twitter          = Purify::clean($inputs['twitter']);



        $franchise->subject_id = Purify::clean($inputs['subject_id']); // rubro


        $loggedUser = $this->getLoggedUser();
        if ($loggedUser->hasRole(['root', 'admin'])) {

            // REB: no aparece en el form como usuario de Franquicia
            if ($inputs['thematic_id'] != 0) {
                $franchise->thematic_id = Purify::clean($inputs['thematic_id']);
            } else {
                $franchise->thematic_id = null;
            }

            // REB: no aparece en el form como usuario de Franquicia

            $franchise->first_suggested  = Purify::clean($inputs['first_suggested']);
            $franchise->second_suggested = Purify::clean($inputs['second_suggested']);
            $franchise->third_suggested  = Purify::clean($inputs['third_suggested']);


            // $franchise->partners         = Purify::clean($inputs['partners']);
            // $franchise->contact_name     = Purify::clean($inputs['contact_name']);
            // $franchise->phone            = Purify::clean($inputs['phone']);
            // $franchise->email            = Purify::clean($inputs['email']);
            // $franchise->website          = Purify::clean($inputs['website']);
            // $franchise->facebook         = Purify::clean($inputs['facebook']);
            // $franchise->twitter          = Purify::clean($inputs['twitter']);
            // $franchise->first_suggested  = Purify::clean($inputs['first_suggested']);
            // $franchise->second_suggested = Purify::clean($inputs['second_suggested']);
            // $franchise->third_suggested  = Purify::clean($inputs['third_suggested']);

            if (empty($inputs['user_id'])) {
                $franchise->user_id = null;
            } else {
                $franchise->user_id = Purify::clean($inputs['user_id']);
            }


            // $franchise->business_name          = Purify::clean($inputs['business_name']);
            // $franchise->vat_condition          = Purify::clean($inputs['vat_condition']);
            // $franchise->cuit                   = Purify::clean($inputs['cuit']);
            // $franchise->contact_address        = Purify::clean($inputs['contact_address']);
            // $franchise->authorizes_recruitment = Purify::clean($inputs['authorizes_recruitment']);
            // $franchise->contrac_phone          = Purify::clean($inputs['contrac_phone']);
            // $franchise->contact_email          = Purify::clean($inputs['contact_email']);
            // $franchise->contracting_period     = Purify::clean($inputs['contracting_period']);
            // $franchise->way_pay                = Purify::clean($inputs['way_pay']);

        }

        if (isset($inputs['tags'])) {
            $franchise->tags()->sync($inputs['tags']);
        } else {
            $franchise->tags()->sync([]);
        }
        $franchise->string_tags = implode(',', $franchise->tags()->pluck('name')->toArray());

        return $franchise->save();
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

    /**
     * @param Franchises $franchise
     * @return mixed
     * @internal param null $id
     */
    public function delete(Franchises $franchise)
    {
        $data                = [];
        $data['item']        = $franchise;
        $data['loggedUser']  = $this->getLoggedUser();
        $data['breadcrumbs'] = [
            trans('custom.breadcrumbs_web_content'),
            trans('custom.breadcrumbs_franchises'),
            trans('custom.breadcrumbs_delete')
        ];

        return View::make('admin.franchises.delete')->with($data);
    }

    /**
     * @param Franchises $franchise
     * @return mixed
     * @internal param Request $request
     */
    public function destroy(Franchises $franchise)
    {

        if (file_exists('./uploads/' . $franchise->image) && !empty($franchise->image)) {
            unlink('./uploads/' . $franchise->image);
        }

        if ($franchise->delete()) {
            return Redirect()->route('franchises.list')->with('message_success',
                trans('custom.data_deleted_correctly'));
        } else {
            return Redirect::back()->withErrors(trans('custom.data_deleted_failed'));
        }
    }

    /**
     * Set the item like visible or not
     *
     * @param Franchises $franchise
     * @return
     * @internal param null $id
     */
    public function changeVisible(Franchises $franchise)
    {
        if ($franchise->visible) {
            $franchise->visible = false;
        } else {
            $franchise->visible = true;
        }


        if ($franchise->save()) {
            return Redirect()->back()->with('message_success', trans('custom.data_change_visibility_correctly'));
        } else {
            return Redirect::back()->withErrors(trans('custom.data_change_visibility_failed'));
        }
    }

    /**
     * Set the item like highlights or not
     *
     * @param Franchises $franchise
     * @return
     * @internal param null $id
     */
    public function changeHighlights(Franchises $franchise)
    {
        if ($franchise->highlights) {
            $franchise->highlights = false;
            $franchise->order      = 9999;
        } else {
            $franchise->highlights = true;
        }

        if ($franchise->save()) {
            return Redirect()->back()->with('message_success', trans('custom.data_change_highlights_correctly'));
        } else {
            return Redirect::back()->withErrors(trans('custom.data_change_highlights_failed'));
        }
    }

    /**
     * Set the item like subject_highlight or not
     *
     * @param Franchises $franchise
     * @return
     * @internal param null $id
     */
    public function changeSubjectHighlights(Franchises $franchise)
    {
        if ($franchise->subject_highlight) {
            $franchise->subject_highlight = false;
        } else {
            $franchise->weekly            = false;
            $franchise->subject_highlight = true;
            Franchises::where('subject_highlight', true)->update(['subject_highlight' => false]);
        }

        if ($franchise->save()) {
            return Redirect()->back()->with('message_success', trans('custom.data_change_highlights_correctly'));
        } else {
            return Redirect::back()->withErrors(trans('custom.data_change_highlights_failed'));
        }
    }

    /**
     * Set the item like subject_highlight or not
     *
     * @param Franchises $franchise
     * @return
     * @internal param null $id
     */
    public function changeWeekly(Franchises $franchise)
    {
        if ($franchise->weekly) {
            $franchise->weekly = false;
        } else {
            $franchise->weekly            = true;
            $franchise->subject_highlight = false;
        }

        if ($franchise->save()) {
            return Redirect()->back()->with('message_success', trans('custom.data_change_highlights_correctly'));
        } else {
            return Redirect::back()->withErrors(trans('custom.data_change_highlights_failed'));
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function order(Request $request)
    {
        $loggedUser = $this->getLoggedUser();
        $limit      = 50;
        $search     = Input::get('search');
        $order      = 'order';
        $orderBy    = 'asc';

        if (Input::get('subjectId')) {
            $subjectId = Input::get('subjectId');
        } else {
            $subjectId = Subjects::orderBy('order', 'ASC')->first()->id;
        }

        $data     = [];
        $subjects = Subjects::where('visible', true)->pluck('name', 'id')->toArray();
        // Add select option to the subjects array
        $data['subjects']    = ["0" => trans('custom.choose_subject')] + $subjects;
        $data['subjects_id'] = $subjectId;

        $data['loggedUser']  = $loggedUser;
        $data['breadcrumbs'] = [
            trans('custom.breadcrumbs_web_content'),
            trans('custom.breadcrumbs_franchises'),
            trans('custom.breadcrumbs_order')
        ];

        $data['items'] = Franchises::ListAllFranchises($search, $order, $orderBy, $subjectId)->where('highlights',
            true)->paginate($limit);

        return View::make('admin.franchises.order')->with($data);
    }

    /**
     * Set the item like visible or not
     *
     * @param Request $request
     * @internal param null $id
     * @return string
     */
    public function sort(Request $request)
    {
        $order = explode(',', $request->get("order"));
        foreach ($order as $index => $value) {
            $franchise        = Franchises::find($value);
            $franchise->order = $index;
            if (!$franchise->save()) {
                return json_encode(['status' => false]);
            }
        }
        return json_encode(['status' => true]);
    }

}
