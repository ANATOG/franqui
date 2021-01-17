<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Models\Tags;
use App\Models\Subjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Stevebauman\Purify\Facades\Purify;

class SubjectsController extends BaseAdminController
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
                    'name' => 'required|unique:subjects,name',
                    'image' => 'required|image|mimes:jpeg,png,jpg|max:2048|dimensions:max_width=220,max_height=440',
                ];
            }
            case 'edit': {
                return [
                    'name' => 'required|unique:subjects,name,' . $id,
                    'image' => 'image|mimes:jpeg,png,jpg|max:2048|dimensions:max_width=220,max_height=440',
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
            trans('custom.breadcrumbs_subjects'),
            trans('custom.breadcrumbs_list')
        ];

        $data['items'] = Subjects::ListAllSubjects($search, $order, $orderBy)->paginate($limit);

        return View::make('admin.subjects.list')->with($data);
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
            trans('custom.breadcrumbs_subjects'),
            trans('custom.breadcrumbs_create')
        ];

        return View::make('admin.subjects.create')->with($data);
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

            $image = $request->file('image')->store('subjects', 'public');

            $subjects = Subjects::create(['name'  => Purify::clean($inputs['name']),
                                           'image' => $image,
                                           'slug'  => Purify::clean(str_slug($inputs['name'], '-'))
            ]);

            // Sync tag for the inserted thematic
            $this->syncTags($request->get('tags'), $subjects);

            return Redirect()->route('subjects.list')->with('message_success', trans('custom.data_created_correctly'));

        }
    }

    /**
     * @param Subjects $subjects
     * @return mixed
     * @internal param $id
     */
    public function edit(Subjects $subjects)
    {
        $data                = [];
        $data['loggedUser']  = $this->getLoggedUser();
        $data['breadcrumbs'] = [
            trans('custom.breadcrumbs_web_content'),
            trans('custom.breadcrumbs_subjects'),
            trans('custom.breadcrumbs_edit')
        ];
        $data['item']        = $subjects;
        $data['tags']        = $subjects->getTagsNames();

        return View::make('admin.subjects.edit')->with($data);
    }

    /**
     * @param Request $request
     * @param Subjects $subjects
     * @return mixed
     * @internal param $id
     */
    public function update(Request $request, Subjects $subjects)
    {
        $inputs = $request->all();

        $validate = Validator::make($inputs, $this->rules('edit', $subjects->id));

        if ($validate->fails()) {
            return Redirect::back()->withErrors($validate->errors())->withInput();
        } else {

            $subjects->name = Purify::clean($inputs['name']);
            $subjects->slug = Purify::clean(str_slug($inputs['name'], '-'));

            if ($request->hasFile('image')) {
                if (file_exists('./uploads/' . $subjects->image) && !empty($subjects->image)) {
                    unlink('./uploads/' . $subjects->image);
                }
                $subjects->image = $request->file('image')->store('subjects', 'public');
            }

            if ($request->get('tags') == "") {
                // Remove all tag for the updated thematic
                $this->removeTags($subjects);
            } else {
                // Sync tag for the edited thematic
                $this->syncTags($request->get('tags'), $subjects);
            }


            if ($subjects->save()) {
                return Redirect()->route('subjects.list')->with('message_success',
                    trans('custom.data_edited_correctly'));
            } else {
                return Redirect::back()->withErrors(trans('custom.data_edited_failed'));
            }
        }
    }

    public function removeTags($subjects)
    {
        $tagsIds = $subjects->getTagsIds();
        $subjects->tags()->detach($tagsIds);
    }

    public function syncTags($tags, $subjects)
    {
        $tags = explode(",", $tags);
        foreach ($tags as $tag) {
            Tags::firstOrCreate(['name' => Purify::clean($tag)]);
        }
        $tagsIds = Tags::whereIn("name", $tags)->pluck('id')->all();
        $subjects->tags()->sync($tagsIds);
    }

    /**
     * @param Subjects $subjects
     * @return mixed
     * @internal param null $id
     */
    public function delete(Subjects $subjects)
    {
        $data                = [];
        $data['item']        = $subjects;
        $data['loggedUser']  = $this->getLoggedUser();
        $data['breadcrumbs'] = [
            trans('custom.breadcrumbs_web_content'),
            trans('custom.breadcrumbs_subjects'),
            trans('custom.breadcrumbs_delete')
        ];

        return View::make('admin.subjects.delete')->with($data);
    }

    /**
     * @param Subjects $subjects
     * @return mixed
     * @internal param Request $request
     */
    public function destroy(Subjects $subjects)
    {
        if (file_exists('./uploads/' . $subjects->image) && !empty($subjects->image)) {
            unlink('./uploads/' . $subjects->image);
        }

        $tagsIds = $subjects->getTagsIds();
        $subjects->tags()->detach($tagsIds);

        $this->removeTags($subjects);
        if ($subjects->delete()) {
            return Redirect()->route('subjects.list')->with('message_success', trans('custom.data_deleted_correctly'));
        } else {
            return Redirect::back()->withErrors(trans('custom.data_deleted_failed'));
        }
    }

    /**
     * Set the item like visible or not
     *
     * @param Subjects $subjects
     * @return
     * @internal param null $id
     */
    public function changeVisible(Subjects $subjects)
    {
        if ($subjects->visible) {
            $subjects->visible = false;
        } else {
            $subjects->visible = true;
        }

        if ($subjects->save()) {
            return Redirect()->route('subjects.list')->with('message_success',
                trans('custom.data_change_visibility_correctly'));
        } else {
            return Redirect::back()->withErrors(trans('custom.data_change_visibility_failed'));
        }
    }

    /**
     * Sort subjects
     *
     * @param Request $request
     * @internal param null $id
     * @return string
     */
    public function sort(Request $request)
    {
        $order = explode(',', $request->get("order"));
        foreach ($order as $index => $value) {
            $subjects        = Subjects::find($value);
            $subjects->order = $index;
            if (!$subjects->save()) {
                return json_encode(['status' => false]);
            }
        }

        return json_encode(['status' => true]);
    }
}