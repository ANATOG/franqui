<?php

namespace App\Http\Controllers;

use App\Models\Banners;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->getBanner();
    }

    /**
     * @return mixed
     */
    public function getLoggedUser()
    {
        $user = Auth::user();
        if (!empty($user)) {
            return $user;
        }else{
            return false;
        }
    }

    public function getBanner(){
        $frontBanners = [];
        $banners = Banners::ListAllBannersFront()->inRandomOrder()->get()->toArray();


        foreach($banners as $banner){
            if($banner['position'] == 'banner_top_home'){
                $frontBanners[$banner['position']][] = $banner['image'];
                $frontBanners[$banner['position'].'_url'][] = $banner['url'];
            }else{
                if($banner['position'] == 'banner_top_home_mobile'){
                    $frontBanners[$banner['position']][] = $banner['image'];
                    $frontBanners[$banner['position'].'_url'][] = $banner['url'];
                }else{
                    $frontBanners[$banner['position']] = $banner['image'];
                    $frontBanners[$banner['position'].'_url'] = $banner['url'];
                }
            }
        }
        View::share('frontBanners', $frontBanners);
    }
}
