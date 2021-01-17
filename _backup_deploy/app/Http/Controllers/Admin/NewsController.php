<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Models\News;
use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Stevebauman\Purify\Facades\Purify;

class NewsController extends BaseAdminController
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
                    'title' => 'required|unique:news,title',
                    'image' => 'required|image|mimes:jpeg,png,jpg|max:2048|dimensions:max_width=2000,max_height=2000',
                ];
            }
            case 'edit': {
                return [
                    'title' => 'required|unique:news,title,' . $id,
                    'image' => 'image|mimes:jpeg,png,jpg|max:2048|dimensions:max_width=2000,max_height=2000',
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
        //$limit      = ($request->get('limit')) ? $limit = $request->get('limit') : $limit = 10;
        $search  = $request->get('search');
        $order   = ($request->get('order')) ? $request->get('order') : 'id';
        $orderBy = ($request->get('orderby')) ? $request->get('orderby') : 'desc';

        $data                = [];
        $data['loggedUser']  = $loggedUser;
        $data['breadcrumbs'] = [
            trans('custom.breadcrumbs_web_content'),
            trans('custom.breadcrumbs_news'),
            trans('custom.breadcrumbs_list')
        ];

        $data['items'] = News::orderBy('order', 'ASC')->get();

        return View::make('admin.news.list')->with($data);
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
            trans('custom.breadcrumbs_news'),
            trans('custom.breadcrumbs_create')
        ];

        return View::make('admin.news.create')->with($data);
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
            if ($this->storeNews($request, $inputs)) {
                return Redirect()->route('news.list')->with('message_success', trans('custom.data_created_correctly'));
            } else {
                return Redirect::back()->withErrors(trans('custom.data_created_failed'));
            }
        }
    }

    /**
     * Create news
     *
     * @param $request
     * @param $inputs
     * @return bool
     */
    public function storeNews($request, $inputs)
    {
        $news              = new News;
        $news->title       = Purify::clean($inputs['title']);
        $news->author      = Purify::clean($inputs['author']);
        $news->slug        = Purify::clean(str_slug($inputs['title'], '-'));
        $news->image       = $request->file('image')->store('news', 'public');
        $news->video       = Purify::clean($this->checkVideo($inputs['video']));
        $news->type        = Purify::clean($inputs['type']);
        $news->description = Purify::clean($inputs['description']);

        $result = $news->save();
        if ($result) {
            // Sync tag for the inserted thematic
            $this->syncTags($request->get('tags'), $news);
        }

        return $result;
    }

    /**
     * @param News $news
     * @return mixed
     * @internal param $id
     */
    public function edit(News $news)
    {
        $data                = [];
        $data['loggedUser']  = $this->getLoggedUser();
        $data['breadcrumbs'] = [
            trans('custom.breadcrumbs_web_content'),
            trans('custom.breadcrumbs_news'),
            trans('custom.breadcrumbs_edit')
        ];
        $data['item']        = $news;
        $data['tags']        = $news->getTagsNames();

        return View::make('admin.news.edit')->with($data);
    }

    /**
     * @param Request $request
     * @param News $news
     * @return mixed
     * @internal param $id
     */
    public function update(Request $request, News $news)
    {
        $inputs = $request->all();

        $validate = Validator::make($inputs, $this->rules('edit', $news->id));

        if ($validate->fails()) {
            return Redirect::back()->withErrors($validate->errors())->withInput();
        } else {
            if ($this->updateNews($request, $news, $inputs)) {
                return Redirect()->route('news.list')->with('message_success', trans('custom.data_edited_correctly'));
            } else {
                return Redirect::back()->withErrors(trans('custom.data_edited_failed'));
            }
        }
    }

    /**
     * Update news
     *
     * @param $request
     * @param $news
     * @param $inputs
     * @return mixed
     */
    public function updateNews($request, $news, $inputs)
    {
        $news->title  = Purify::clean($inputs['title']);
        $news->author = Purify::clean($inputs['author']);
        $news->type   = Purify::clean($inputs['type']);
        $news->slug   = Purify::clean(str_slug($inputs['title'], '-'));
        if ($request->hasFile('image')) {
            if (file_exists('./uploads/' . $news->image) && !empty($news->image)) {
                unlink('./uploads/' . $news->image);
            }
            $news->image = $request->file('image')->store('news', 'public');
        }
        $news->video       = Purify::clean($this->checkVideo($inputs['video']));
        $news->description = Purify::clean($inputs['description']);

        if ($request->get('tags') == "") {
            // Remove all tag for the updated thematic
            $this->removeTags($news);
        } else {
            // Sync tag for the edited thematic
            $this->syncTags($request->get('tags'), $news);
        }


        return $news->save();
    }

    public function removeTags($news)
    {
        $tagsIds = $news->getTagsIds();
        $news->tags()->detach($tagsIds);
    }

    public function syncTags($tags, $news)
    {
        $tags = explode(",", $tags);
        foreach ($tags as $tag) {
            Tags::firstOrCreate(['name' => Purify::clean($tag)]);
        }
        $tagsIds = Tags::whereIn("name", $tags)->pluck('id')->all();
        $news->tags()->sync($tagsIds);
    }

    /**
     * @param News $news
     * @return mixed
     * @internal param null $id
     */
    public function delete(News $news)
    {
        $data                = [];
        $data['item']        = $news;
        $data['loggedUser']  = $this->getLoggedUser();
        $data['breadcrumbs'] = [
            trans('custom.breadcrumbs_web_content'),
            trans('custom.breadcrumbs_news'),
            trans('custom.breadcrumbs_delete')
        ];

        return View::make('admin.news.delete')->with($data);
    }

    /**
     * @param News $news
     * @return mixed
     * @internal param Request $request
     */
    public function destroy(News $news)
    {
        if (file_exists('./uploads/' . $news->image) && !empty($news->image)) {
            unlink('./uploads/' . $news->image);
        }
        if ($news->delete()) {
            return Redirect()->route('news.list')->with('message_success', trans('custom.data_deleted_correctly'));
        } else {
            return Redirect::back()->withErrors(trans('custom.data_deleted_failed'));
        }
    }

    /**
     * Set the item like visible or not
     *
     * @param News $news
     * @return
     * @internal param null $id
     */
    public function changeVisible(News $news)
    {
        if ($news->visible) {
            $news->visible = false;
        } else {
            $news->visible = true;
        }

        if ($news->save()) {
            return Redirect()->route('news.list')->with('message_success',
                trans('custom.data_change_visibility_correctly'));
        } else {
            return Redirect::back()->withErrors(trans('custom.data_change_visibility_failed'));
        }
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
            $news        = News::find($value);
            $news->order = $index;
            if (!$news->save()) {
                return json_encode(['status' => false]);
            }
        }

        return json_encode(['status' => true]);
    }

}