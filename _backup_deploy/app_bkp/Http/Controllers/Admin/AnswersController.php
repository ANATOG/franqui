<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Models\Surveys;
use App\Models\Answers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Stevebauman\Purify\Facades\Purify;

class AnswersController extends BaseAdminController
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
                    'answer' => 'required',
                ];
            }
            case 'edit': {
                return [
                    'answer' => 'required',
                ];
            }
            default:
                break;
        }
    }

    /**
     * @param Surveys $survey
     * @return mixed
     */
    public function index(Surveys $survey)
    {
        $loggedUser = $this->getLoggedUser();

        $data                = [];
        $data['loggedUser']  = $loggedUser;
        $data['breadcrumbs'] = [
            trans('custom.breadcrumbs_web_content'),
            trans('custom.breadcrumbs_answers'),
            trans('custom.breadcrumbs_list')
        ];

        $data['items']  = $survey->answers()->orderBy('order', 'ASC')->get();
        $data['survey'] = $survey;

        return View::make('admin.answers.list')->with($data);
    }

    /**
     * @param Surveys $survey
     * @return mixed
     */
    public function create(Surveys $survey)
    {
        if ($survey->answers->count() >= 4) {
            return Redirect()->route('answers.list', ['survey' => $survey['id']])->with('message_success',
                trans('custom.data_more_than'));
        } else {
            $data                = [];
            $data['loggedUser']  = $this->getLoggedUser();
            $data['breadcrumbs'] = [
                trans('custom.breadcrumbs_web_content'),
                trans('custom.breadcrumbs_answers'),
                trans('custom.breadcrumbs_create')
            ];
            $data['survey_id']   = $survey['id'];

            return View::make('admin.answers.create')->with($data);

        }
    }

    /**
     * @param Request $request
     * @param Surveys $survey
     * @return mixed
     */
    public function store(Request $request, Surveys $survey)
    {
        if ($survey->answers->count() >= 4) {
            return Redirect()->route('answers.list', ['survey' => $survey['id']])->with('message_success',
                trans('custom.data_more_than'));
        } else {
            $inputs   = $request->all();
            $validate = Validator::make($inputs, $this->rules('create'));

            if ($validate->fails()) {
                return Redirect::back()->withErrors($validate->errors())->withInput();
            } else {

                $survey->answers()->create(['answer' => Purify::clean($inputs['answer'])]);

                return Redirect()->route('answers.list', ['survey' => $survey['id']])->with('message_success', trans('custom.data_created_correctly'));
            }
        }
    }

    /**
     * @param Surveys $survey
     * @param Answers $answer
     * @return mixed
     * @internal param $id
     */
    public function edit(Surveys $survey, Answers $answer)
    {
        $data                = [];
        $data['loggedUser']  = $this->getLoggedUser();
        $data['breadcrumbs'] = [
            trans('custom.breadcrumbs_web_content'),
            trans('custom.breadcrumbs_answers'),
            trans('custom.breadcrumbs_edit')
        ];
        $data['item']        = $answer;
        $data['survey_id']   = $survey['id'];

        return View::make('admin.answers.edit')->with($data);
    }

    /**
     * @param Request $request
     * @param Surveys $survey
     * @param Answers $answer
     * @return mixed
     * @internal param $id
     */
    public function update(Request $request, Surveys $survey, Answers $answer)
    {

        $inputs = $request->all();

        $caseEdit = 'edit_special';
        if (!$request->hasFile('image') && empty($inputs['old_image'])) {
            $caseEdit = 'edit';
        }

        $validate = Validator::make($inputs, $this->rules($caseEdit, $survey->id));

        if ($validate->fails()) {
            return Redirect::back()->withErrors($validate->errors())->withInput();
        } else {

            if ($this->updateAnswer($answer, $inputs)) {
                return Redirect()->route('answers.list', ['survey' => $survey['id']])->with('message_success',
                    trans('custom.data_edited_correctly'));
            } else {
                return Redirect::back()->withErrors(trans('custom.data_edited_failed'));
            }
        }
    }

    /**
     * @param $answer
     * @param $inputs
     * @return mixed
     */
    public function updateAnswer($answer, $inputs)
    {
        $answer->answer = Purify::clean($inputs['answer']);
        return $answer->save();
    }

    /**
     * @param Surveys $survey
     * @param Answers $answer
     * @return mixed
     * @internal param null $id
     */
    public function delete(Surveys $survey, Answers $answer)
    {
        $data                = [];
        $data['item']        = $answer;
        $data['survey_id']   = $survey['id'];
        $data['loggedUser']  = $this->getLoggedUser();
        $data['breadcrumbs'] = [
            trans('custom.breadcrumbs_web_content'),
            trans('custom.breadcrumbs_answers'),
            trans('custom.breadcrumbs_delete')
        ];

        return View::make('admin.answers.delete')->with($data);
    }

    /**
     * @param Surveys $survey
     * @param Answers $answer
     * @return mixed
     * @internal param Request $request
     */
    public function destroy(Surveys $survey, Answers $answer)
    {
        if ($answer->delete()) {
            return Redirect()->route('answers.list', ['survey' => $survey['id']])->with('message_success',
                trans('custom.data_deleted_correctly'));
        } else {
            return Redirect::back()->withErrors(trans('custom.data_deleted_failed'));
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
            $thematic        = Answers::find($value);
            $thematic->order = $index;
            if (!$thematic->save()) {
                return json_encode(['status' => false]);
            }
        }

        return json_encode(['status' => true]);
    }

}