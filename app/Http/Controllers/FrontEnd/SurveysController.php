<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Answers;
use App\Models\Surveys;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;

class SurveysController extends Controller
{

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {

        if ($request->hasCookie('survey_cookie')) {
            $response['data'] = ['status' => false, 'message' => 'already_vote'];
            return response()->json($response);
        }

        $inputs           = $request->all();
        $validate         = Validator::make($inputs, ['vote' => 'required|numeric']);
        $response['data'] = [];

        if ($validate->fails()) {

            $response['data'] = ['status' => false, 'message' => $validate->errors()];
            return response()->json($response);

        } else {

            $results = $this->storeVote($inputs);
            if ($results) {
                foreach ($results as $result) {
                    $response['data']['results'][] = $result;
                }
                $response['data']['status']= true;
                return response(json_encode($response))->cookie('survey_cookie', $inputs['vote'], '10000');
            } else {
                $response['data'] = ['status' => false, 'message' => 'create_error'];
                return response()->json($response);
            }

        }
    }

    /**
     * Create vote in answers
     *
     * @param $inputs
     * @return bool
     */
    public function storeVote($inputs)
    {

        DB::beginTransaction();

        $answer = Answers::find(Purify::clean($inputs['vote']));
        $survey = $answer->survey()->get();
        if ($survey[0]->visible) {

            $survey[0]->total = $survey[0]->total + 1;
            $survey[0]->save();
            $answer->points = $answer->points + 1;
            $queryResult = $answer->save();

            if ($queryResult) {
                $results = $this->getResults($survey);
                DB::commit();
                return $results;
            } else {
                DB::rollBack();
                return false;
            }
        } else {
            DB::rollBack();
            return false;
        }

    }

    /**
     * Get results
     *
     * @param $survey
     * @return bool
     */
    public function getResults($survey)
    {
        $total   = $survey[0]->total;
        $answers = $survey[0]->answers()->orderBy('order', 'ASC')->get(['id', 'answer', 'points'])->toArray();
        foreach ($answers as $answer) {
            $realAnswers[$answer['id']]['answer'] = $answer['answer'];
            $results[$answer['id']]               = floor(($answer['points'] / $total) * 100);
        }

        arsort($results);
        $matchHundred = array_sum($results);

        if ($matchHundred < 100) {
            $first_key           = key($results);
            $results[$first_key] = $results[$first_key] + (100 - $matchHundred);
        }

        foreach ($results as $key => $value) {
            $realAnswers[$key]['percentage'] = $value;
        }

        return $realAnswers;
    }

}
