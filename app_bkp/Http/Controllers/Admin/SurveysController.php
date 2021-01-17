<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Models\Answers;
use App\Models\Surveys;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Stevebauman\Purify\Facades\Purify;

class SurveysController extends BaseAdminController
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
                    'question' => 'required|unique:surveys,question',
                ];
            }
            case 'edit': {
                return [
                    'question' => 'required|unique:surveys,question,' . $id,
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
            trans('custom.breadcrumbs_surveys'),
            trans('custom.breadcrumbs_list')
        ];

        $data['items'] = Surveys::ListAllSurveys($search, $order, $orderBy)->paginate($limit);

        return View::make('admin.surveys.list')->with($data);
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
            trans('custom.breadcrumbs_surveys'),
            trans('custom.breadcrumbs_create')
        ];

        return View::make('admin.surveys.create')->with($data);
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
            return Redirect::back()->withErrors($validate->errors())->withInput(Input::except('answers'))->with('answers',
                Input::get('answers'));
        } else {
            if ($this->storeSurvey($inputs)) {
                return Redirect()->route('surveys.list')->with('message_success',
                    trans('custom.data_created_correctly'));
            } else {
                return Redirect::back()->withErrors(trans('custom.data_created_failed'));
            }
        }
    }

    /**
     * Create survey and answers
     *
     * @param $inputs
     * @return bool
     */
    public function storeSurvey($inputs)
    {
        $survey           = new Surveys;
        $survey->question = Purify::clean($inputs['question']);
        $survey->visible  = false;
        if ($survey->save()) {
            $answers     = Purify::clean($inputs['answers']);
            $saveAnswers = [];
            foreach ($answers as $answer) {
                if (!empty($answer)) {
                    $saveAnswers[] = new Answers(['answer' => $answer]);
                }
            }

            $survey->answers()->saveMany($saveAnswers);
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param Surveys $survey
     * @return mixed
     * @internal param $id
     */
    public function edit(Surveys $survey)
    {
        $data                = [];
        $data['loggedUser']  = $this->getLoggedUser();
        $data['breadcrumbs'] = [
            trans('custom.breadcrumbs_web_content'),
            trans('custom.breadcrumbs_surveys'),
            trans('custom.breadcrumbs_edit')
        ];
        $data['item']        = $survey;

        return View::make('admin.surveys.edit')->with($data);
    }

    /**
     * @param Request $request
     * @param Surveys $survey
     * @return mixed
     * @internal param $id
     */
    public function update(Request $request, Surveys $survey)
    {
        $inputs   = $request->all();
        $validate = Validator::make($inputs, $this->rules('edit', $survey->id));

        if ($validate->fails()) {
            return Redirect::back()->withErrors($validate->errors())->withInput();
        } else {
            if ($this->updateSurvey($survey, $inputs)) {
                return Redirect()->route('surveys.list')->with('message_success',
                    trans('custom.data_edited_correctly'));
            } else {
                return Redirect::back()->withErrors(trans('custom.data_edited_failed'));
            }
        }
    }

    /**
     * Update survey
     *
     * @param $survey
     * @param $inputs
     * @return mixed
     */
    public function updateSurvey($survey, $inputs)
    {
        $survey->question = Purify::clean($inputs['question']);
        return $survey->save();
    }

    /**
     * @param Surveys $survey
     * @return mixed
     * @internal param null $id
     */
    public function delete(Surveys $survey)
    {
        $data                = [];
        $data['item']        = $survey;
        $data['loggedUser']  = $this->getLoggedUser();
        $data['breadcrumbs'] = [
            trans('custom.breadcrumbs_web_content'),
            trans('custom.breadcrumbs_surveys'),
            trans('custom.breadcrumbs_delete')
        ];

        return View::make('admin.surveys.delete')->with($data);
    }

    /**
     * @param Surveys $survey
     * @return mixed
     * @internal param Request $request
     */
    public function destroy(Surveys $survey)
    {
        if ($survey->delete()) {
            return Redirect()->route('surveys.list')->with('message_success', trans('custom.data_deleted_correctly'));
        } else {
            return Redirect::back()->withErrors(trans('custom.data_deleted_failed'));
        }
    }

    /**
     * Set the item like visible or not
     *
     * @param Surveys $survey
     * @return
     * @internal param null $id
     */
    public function changeVisible(Surveys $survey)
    {
        if ($survey->visible) {
            $survey->visible = false;
        } else {
            $survey->visible = true;
            Surveys::where('visible', true)->update(['visible' => false]);
        }

        if ($survey->save()) {
            return Redirect()->route('surveys.list')->with('message_success',
                trans('custom.data_change_visibility_correctly'));
        } else {
            return Redirect::back()->withErrors(trans('custom.data_change_visibility_failed'));
        }
    }
}