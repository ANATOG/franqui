<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Videos;
use App\Models\Surveys;
use App\Models\Sponsors;
use App\Models\Subjects;
use App\Models\Thematics;
use App\Models\Franchises;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{

    protected $data = [];

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $this->data['frontClass'] = 'home';
        $this->getHomeData();
        if ($request->hasCookie('survey_cookie')) {
            $this->data['alreadyVote'] = $request->cookie('survey_cookie');
        }
        $this->data['results'] = $this->getResults($this->data['survey']);
        return View::make('frontend.index')->with($this->data);
    }

    /**
     * Create data array
     */
    public function getHomeData()
    {
        $this->data['thematic']       = Thematics::where('highlights', true)->get();
        $this->data['franchise']      = $this->getHomeThematic();
        $this->data['loggedUser']     = $this->getLoggedUser();
        $this->data['survey']         = Surveys::GetItem()->limit(1)->get();
        $this->data['subjectsList']   = Subjects::GetListSubjects();
        $this->data['subjects']       = Subjects::GetFrontInfo()->get();
        $this->data['weeklies']       = $this->getWeeklyFront();
        $this->data['news']           = News::GetFrontInfo()->limit(10)->orderBy('order', 'ASC')->get();
        $this->data['answers']        = $this->data['survey'][0]->answers()->orderBy('order', 'ASC')->get();
        $this->data['videos']         = Videos::GetFrontInfo()->limit(4)->get();
        $this->data['sponsors']       = Sponsors::GetFrontInfo()->get();
    }

    /**
     * @return mixed
     */
    public function getHomeThematic()
    {

        if (isset($this->data['thematic'][0])) {
            $franchiseThematic = Franchises::GetHomeThematicFranchise($this->data['thematic'][0]->id)->limit(1)->get();
        } else {
            $this->data['thematic'] = '';
            $franchiseThematic = Franchises::ListAllFranchisesFront()->inRandomOrder()->limit(1)->get();
        }
        if (!isset($franchiseThematic[0])) {
            $this->data['thematic'] = '';
            $franchiseThematic = Franchises::ListAllFranchisesFront()->inRandomOrder()->limit(1)->get();
        }
        if (isset($franchiseThematic[0])) {
            $this->data['franchiseImage'] = $this->getImagesForFront($franchiseThematic);
        }
        return $franchiseThematic;
    }

    /**
     * @param $franchise
     * @return mixed
     */
    public function getImagesForFront($franchise)
    {
        $result = [];
        $images = $franchise[0]->franchiseAsset()->get()->toArray();
        foreach ($images as $image) {
            $result[$image['position']] = $image['image'];
        }
        return $result;
    }

    /**
     * @param $franchise
     * @return mixed
     */
    public function getImagesSpecialForFront($franchise)
    {
        $result = [];
        $images = $franchise->franchiseAsset()->get()->toArray();
        foreach ($images as $image) {
            $result[$image['position']] = $image['image'];
        }
        return $result;
    }

    /**
     * @return mixed
     */
    public function getWeeklyFront()
    {
        $weeklies = Franchises::GetWeekly()->get();
        foreach ($weeklies as $key => $weekly) {
            $images = $this->getImagesSpecialForFront($weeklies[$key]);
            if (isset($images['image_top'])) {
                $weeklies[$key]['image'] = $images['image_top'];
            }
            if (isset($images['logo'])) {
                $weeklies[$key]['logo'] = $images['logo'];
            }
        }
        return $weeklies;
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

        if ($total === 0) {
            foreach ($answers as $answer) {
                $realAnswers[$answer['id']]['answer']     = $answer['answer'];
                $realAnswers[$answer['id']]['id']         = $answer['id'];
                $realAnswers[$answer['id']]['percentage'] = 0;
            }

            return $realAnswers;
        } else {
            foreach ($answers as $answer) {
                $realAnswers[$answer['id']]['answer'] = $answer['answer'];
                $realAnswers[$answer['id']]['id']     = $answer['id'];
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

}
