<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Models\Videos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Stevebauman\Purify\Facades\Purify;

class VideosController extends BaseAdminController
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
                    'video' => 'required',
                ];
            }
            case 'edit': {
                return [
                    'title' => 'required|unique:news,title,' . $id,
                    'video' => 'required',
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
            trans('custom.breadcrumbs_videos'),
            trans('custom.breadcrumbs_list')
        ];

        $data['items'] = Videos::ListAllVideos($search, $order, $orderBy)->paginate($limit);

        return View::make('admin.videos.list')->with($data);
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
            trans('custom.breadcrumbs_videos'),
            trans('custom.breadcrumbs_create')
        ];

        return View::make('admin.videos.create')->with($data);
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
            if ($this->storeVideos($request, $inputs)) {
                return Redirect()->route('videos.list')->with('message_success',
                    trans('custom.data_created_correctly'));
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
    public function storeVideos($request, $inputs)
    {
        $videos              = new Videos;
        $videos->title       = Purify::clean($inputs['title']);
        $videos->slug        = Purify::clean(str_slug($inputs['title'], '-'));
        $videos->image       = $request->file('image')->store('videos', 'public');
        $videos->video       = Purify::clean($this->checkVideo($inputs['video']));
        $videos->description = Purify::clean($inputs['description']);
        return $videos->save();
    }

    /**
     * @param Videos $videos
     * @return mixed
     * @internal param $id
     */
    public function edit(Videos $videos)
    {
        $data                = [];
        $data['loggedUser']  = $this->getLoggedUser();
        $data['breadcrumbs'] = [
            trans('custom.breadcrumbs_web_content'),
            trans('custom.breadcrumbs_videos'),
            trans('custom.breadcrumbs_edit')
        ];
        $data['item']        = $videos;

        return View::make('admin.videos.edit')->with($data);
    }

    /**
     * @param Request $request
     * @param Videos $videos
     * @return mixed
     * @internal param $id
     */
    public function update(Request $request, Videos $videos)
    {
        $inputs = $request->all();

        $validate = Validator::make($inputs, $this->rules('edit', $videos->id));

        if ($validate->fails()) {
            return Redirect::back()->withErrors($validate->errors())->withInput();
        } else {
            if ($this->updateVideos($request, $videos, $inputs)) {
                return Redirect()->route('videos.list')->with('message_success', trans('custom.data_edited_correctly'));
            } else {
                return Redirect::back()->withErrors(trans('custom.data_edited_failed'));
            }
        }
    }

    /**
     * Update news
     *
     * @param $request
     * @param $videos
     * @param $inputs
     * @return mixed
     */
    public function updateVideos($request, $videos, $inputs)
    {
        $videos->title       = Purify::clean($inputs['title']);
        $videos->slug        = Purify::clean(str_slug($inputs['title'], '-'));
        if ($request->hasFile('image')) {
            if (file_exists('./uploads/' . $videos->image) && !empty($videos->image)) {
                unlink('./uploads/' . $videos->image);
            }
            $videos->image = $request->file('image')->store('videos', 'public');
        }
        $videos->video       = Purify::clean($this->checkVideo($inputs['video']));
        $videos->description = Purify::clean($inputs['description']);
        return $videos->save();
    }

    /**
     * @param Videos $videos
     * @return mixed
     * @internal param null $id
     */
    public function delete(Videos $videos)
    {
        $data                = [];
        $data['item']        = $videos;
        $data['loggedUser']  = $this->getLoggedUser();
        $data['breadcrumbs'] = [
            trans('custom.breadcrumbs_web_content'),
            trans('custom.breadcrumbs_videos'),
            trans('custom.breadcrumbs_delete')
        ];

        return View::make('admin.videos.delete')->with($data);
    }

    /**
     * @param Videos $videos
     * @return mixed
     * @internal param Request $request
     */
    public function destroy(Videos $videos)
    {
        if (file_exists('./uploads/' . $videos->image) && !empty($videos->image)) {
            unlink('./uploads/' . $videos->image);
        }
        if ($videos->delete()) {
            return Redirect()->route('videos.list')->with('message_success', trans('custom.data_deleted_correctly'));
        } else {
            return Redirect::back()->withErrors(trans('custom.data_deleted_failed'));
        }
    }

    /**
     * Set the item like visible or not
     *
     * @param Videos $videos
     * @return
     * @internal param null $id
     */
    public function changeVisible(Videos $videos)
    {
        if ($videos->visible) {
            $videos->visible = false;
        } else {
            $videos->visible = true;
        }

        if ($videos->save()) {
            return Redirect()->route('videos.list')->with('message_success',
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
}