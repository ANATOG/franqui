<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Franchises;
use App\Models\Thematics;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class ThematicsController extends Controller
{
    /**
     * @return mixed
     */
    public function listAction()
    {
        $data               = [];
        $data['frontClass'] = 'thematics';
        $data['loggedUser'] = $this->getLoggedUser();
        $data['thematics']  = Thematics::where('visible', true)->orderBy('order', 'ASC')->get();
        return View::make('frontend.thematics_list')->with($data);
    }

    /**
     * @param Request $request
     * @param $slug
     * @return mixed
     */
    public function itemAction(Request $request, $slug)
    {
        $order = ($request->get('orden')) ? $request->get('orden') : null;

        $data               = [];
        $data['frontClass'] = 'thematics-item';
        $data['loggedUser'] = $this->getLoggedUser();
        $thematic           = Thematics::GetItem($slug)->get();
        $data['favorites']  = [];
        if ($data['loggedUser']) {
            $user              = User::find($data['loggedUser']->id);
            $data['favorites'] = $user->getListFavorites();
        }

        if (!isset($thematic[0])) {
            return redirect("/");
        }

        if (Session::has('slugs')) {
            $data['slugSession'] = Session::get('slugs');
        } else {
            $data['slugSession'] = [];
        }

        $data['frontUrl']         = Config::get('app.url') . 'tematica/' . $slug . '?orden=';
        $data['selectedThematic'] = $thematic[0];
        $data['thematics']        = Thematics::GetFrontInfo()->limit(6)->get();
        $data['franchises']       = $this->getInfo($thematic[0]->id, $order);
        return View::make('frontend.thematics_item')->with($data);
    }

    /**
     * @param $thematic
     * @param $order
     * @return mixed
     */
    public function getInfo($thematic, $order)
    {
        $limit      = 16;
        $pais= $this->getLocation();
        $franchises = Franchises::ListAllFranchisesFrontByThematic($thematic, $order, $pais)->paginate($limit);
        foreach ($franchises as $key => $franchise) {
            $images                    = $this->getImagesForFront($franchise);
            $franchises[$key]['image'] = $images['right_one'];
            $franchises[$key]['logo']  = $images['logo'];
        }
        $franchises->appends(['orden' => $order]);
        return $franchises;
    }

    /**
     * @param $franchise
     * @return mixed
     */
    public function getImagesForFront($franchise)
    {
        $result['image_top'] = '';
        $result['logo'] = 'logo-thumb.jpg';
        $result['right_one'] = 'logo-thumb.jpg';
        $result['left_one'] = '';
        $result['left_two'] = '';
        $result['left_three'] = '';
        $images = $franchise->franchiseAsset()->get()->toArray();
        foreach ($images as $image) {
            $result[$image['position']] = $image['image'];
        }
        return $result;
    }

    public function getLocation(){
        if (empty($ip_address)) {
            $client  = @$_SERVER['HTTP_CLIENT_IP'];
            $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
            $server  = @$_SERVER['SERVER_ADDR'];
            $remote  = @$_SERVER['REMOTE_ADDR'];
            if(!empty($client) && filter_var($client, FILTER_VALIDATE_IP)){
                $ip = $client;
            }elseif(!empty($forward) && filter_var($forward, FILTER_VALIDATE_IP)){
                $ip = $forward;
            }elseif(!empty($server) && filter_var($server, FILTER_VALIDATE_IP)){
                $ip = $server;   
            }else{
                $ip = $remote;
            }
        } else {
            $ip = "$ip_address";
        }
        
        $ip_data = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=".$ip));
        $location  = "null";
    
        if($ip_data && $ip_data['geoplugin_countryCode'] != null){
            $location = $ip_data['geoplugin_countryCode'];
        }
        return $location;
    }

}
