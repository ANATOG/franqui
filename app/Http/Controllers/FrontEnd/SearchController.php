<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Franchises;
use App\Models\Subjects;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Stevebauman\Purify\Facades\Purify;

class SearchController extends Controller
{
     
    /**
     * @param Request $request
     * @return mixed
     */

    public function index(Request $request)
    {
        $search  = ($request->get('buscar')) ? $request->get('buscar') : null;
        $subject = ($request->get('rubro')) ? $request->get('rubro') : null;
        $price   = ($request->get('precio')) ? $request->get('precio') : null;
        $order   = ($request->get('orden')) ? $request->get('orden') : null;
        $data    = [];

        $QSubject = Subjects::GetItem($subject)->get();

        if ($QSubject->count() > 0) {
            $rSubject = $QSubject[0];
            $id       = $rSubject->id;
        } else {
            $rSubject = null;
            $id       = null;
        }

        $data['loggedUser'] = $this->getLoggedUser();
        $data['favorites']  = [];
        if ($data['loggedUser']) {
            $user              = User::find($data['loggedUser']->id);
            $data['favorites'] = $user->getListFavorites();
        }

        if (Session::has('slugs')) {
            $data['slugSession'] = Session::get('slugs');
        } else {
            $data['slugSession'] = [];
        }

        $data['frontUrl']        = Config::get('app.url') . 'resultados?buscar=' . $search . '&rubro=' . $subject . '&precio=' . $price . '&orden=';
        $data['frontClass']      = 'search';
        $data['selectedSubject'] = $rSubject;
        $data['order'] = $order;
        $data['subjects']        = Subjects::GetFrontInfo()->limit(8)->get();
        $data['franchises']      = $this->getSearch($id, $search, $price, $order, $subject);
        $data['pais'] =$this->getIP();
        return View::make('frontend.search')->with($data);
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

    /**
     * @param $id
     * @param $search
     * @param $price
     * @param $order
     * @param $subject
     * @return mixed 
     */
    public function getSearch($id, $search, $price, $order, $subject)
    {
        $limit      = 12; 
        $pais= $this->getLocation();
        //$franchises = Franchises::ListSearchFront($order, $id, $search, $price)->paginate($limit);
        $franchises = Franchises::ListSearchFront($order, $id, $search, $price, $pais)->paginate($limit);
        foreach ($franchises as $key => $franchise) {
            $images                    = $this->getImagesForFront($franchise);
            $franchises[$key]['image'] = $images['right_one'];
            $franchises[$key]['logo']  = $images['logo'];
        }

        $franchises->appends(['buscar' => $search, 'rubro' => $subject, 'precio' => $price, 'orden' => $order]);
        return $franchises;
    }

    public function getIP(){
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
        
        return $ip;
    }
    

    public function getLocation(){

        $ip=$this->getIP();        
        $ip_data = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=".$ip));
        //$location  = "null";
    
        if($ip_data && $ip_data['geoplugin_countryCode'] != null){
            $location = $ip_data['geoplugin_countryCode'];
        }
        return $location;
    }

}
