<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Franchises;
use App\Models\Subjects;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class SubjectsController extends Controller
{
    /**
     * @return mixed
     */
    public function listAction()
    {
        $data               = [];
        $data['frontClass'] = 'subjects';
        $data['loggedUser'] = $this->getLoggedUser();
        $data['subjects']   = Subjects::where('visible', true)->orderBy('order', 'ASC')->get();
        return View::make('frontend.subjects_list')->with($data);
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
        $data['frontClass'] = 'subjects-item';
        $data['loggedUser'] = $this->getLoggedUser();
        $data['favorites']  = [];
        if ($data['loggedUser']) {
            $user              = User::find($data['loggedUser']->id);
            $data['favorites'] = $user->getListFavorites();
        }

        $subject = Subjects::GetItem($slug)->get();
        if (!isset($subject[0])) {
            return redirect("/");
        }

        if (Session::has('slugs')) {
            $data['slugSession'] = Session::get('slugs');
        } else {
            $data['slugSession'] = [];
        }

        $data['frontUrl']        = Config::get('app.url') . 'rubro/' . $slug . '?orden=';
        $data['selectedSubject'] = $subject[0];
        $data['subjects']        = Subjects::GetFrontInfo()->limit(8)->get();
        $data['franchises']      = $this->getInfo($subject[0]->id, $order);
        $data['pais'] =$this->getIP();
        return View::make('frontend.subjects_item')->with($data);
    }

    /**
     * @param $subject
     * @param $order
     * @return mixed
     */
    public function getInfo($subject, $order)
    {
        $limit      = 16;
        $pais= $this->getLocation();
        $franchises = Franchises::ListAllFranchisesFront($order, $subject, $pais)->paginate($limit);
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
    public function getIP(){
        if (empty($ip_address)) {
           // $client  = @$_SERVER['HTTP_CLIENT_IP'];
           // $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
           // $server  = @$_SERVER['SERVER_ADDR'];
            $remote  = @$_SERVER['REMOTE_ADDR'];
            //if(!empty($client) && filter_var($client, FILTER_VALIDATE_IP)){
              //  $ip = $client;
            //}//elseif(!empty($forward) && filter_var($forward, FILTER_VALIDATE_IP)){
                //$ip = $forward;
            //}
            //elseif(!empty($server) && filter_var($server, FILTER_VALIDATE_IP)){
                //$ip = $server;   
           // }
            //else{
                $ip = $remote;
           // }
        } else {
            //$ip = "$ip_address";
        }
        return $ip;
    }
    

    public function getLocation(){

        $ip=$this->getIP();        
        $ip_data = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=".$ip));
        $location  = "null";
    
        if($ip_data && $ip_data['geoplugin_countryCode'] != null){
            $location = $ip_data['geoplugin_countryCode'];
        }
        return $location;
    }    

}
