<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Stevebauman\Purify\Facades\Purify;

class NewsController extends Controller
{
    /**
     * @return mixed
     */
    public function listAction()
    {
        $limit = 8;

        $data               = [];
        $data['frontClass'] = 'news';
        $data['loggedUser'] = $this->getLoggedUser();
        $data['news']       = News::where('visible', true)->orderBy('order', 'ASC')->paginate($limit);

        return View::make('frontend.news')->with($data);
    }

    /**
     * @return mixed
     */
    public function tagAction($tag)
    {
        $limit = 8;
        $tag = Tags::GetItem($tag)->get();

        $data               = [];
        $data['frontClass'] = 'news';
        $data['loggedUser'] = $this->getLoggedUser();
        $data['news']       = $tag[0]->news()->where('visible', true)->orderBy('order', 'ASC')->paginate($limit);

        return View::make('frontend.news')->with($data);
    }

    /**
     * @param $slug
     * @return mixed
     * @internal param News $slug
     */
    public function itemAction($slug)
    {
        $data               = [];
        $data['frontClass'] = 'news-item';
        $data['loggedUser'] = $this->getLoggedUser();
        $data['news']       = News::GetItem(Purify::clean($slug))->get();
        $data['moreNews']   = News::where('visible', true)->where('id', '<>', $data['news'][0]->id)->orderBy('order', 'ASC')->limit(4)->get();
        return View::make('frontend.news_item')->with($data);
    }
}
