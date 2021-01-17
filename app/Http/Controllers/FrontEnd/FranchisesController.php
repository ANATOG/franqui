<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Franchises;
use App\Models\Subjects;
use App\Models\Thematics;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class FranchisesController extends Controller
{
    /**
     * @return mixed
     */
    public function listAction()
    {
        $data               = [];
        $data['frontClass'] = 'franchise';
        $data['franchises'] = $this->getInfo();
        $data['loggedUser'] = $this->getLoggedUser();
        $data['favorites']  = [];
        $user               = User::find($data['loggedUser']->id);
        if ($user) {
            $data['favorites'] = $user->getListFavorites();
        }
        return View::make('frontend.franchise_list')->with($data);
    }

    /**
     * @return mixed
     */
    public function getInfo()
    {
        $limit      = 16;
        $franchises = Franchises::ListAllFranchisesFront()->paginate($limit);
        foreach ($franchises as $key => $franchise) {
            $images                    = $this->getImagesForFront($franchise);
            $franchises[$key]['image'] = $images['right_one'];
            $franchises[$key]['logo']  = $images['logo'];
        }
        return $franchises;
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function itemAction($slug)
    {
        $data               = [];
        $data['frontClass'] = 'franchise-item';
        $franchise          = Franchises::GetItem($slug)->get();
        if ($franchise->count() == 0) {
            return redirect()->to('/');
        }
        $subject            = Subjects::find($franchise[0]->subject_id);
        $data['franchise']  = $franchise;
        $data['loggedUser'] = $this->getLoggedUser();
        $data['favorites']  = [];
        if ($data['loggedUser']) {
            $user              = User::find($data['loggedUser']->id);
            $data['favorites'] = $user->getListFavorites();
        }
        $data['franchisesAreas']  = $franchise[0]->franchiseAreas()->orderBy('order', 'ASC')->get();
        $data['franchiseImages']  = $this->getImagesForFront($franchise[0]);
        $data['franchiseOffices'] = $franchise[0]->franchiseOffice()->orderBy('order', 'ASC')->get();
        $data['suggested']        = [];

        if (!empty($franchise[0]->first_suggested)) {
            $data['suggested'][] = $this->suggested($franchise[0]->first_suggested);
        }

        if (!empty($franchise[0]->second_suggested)) {
            $data['suggested'][] = $this->suggested($franchise[0]->second_suggested);
        }

        if (!empty($franchise[0]->third_suggested)) {
            $data['suggested'][] = $this->suggested($franchise[0]->third_suggested);
        }

        return View::make('frontend.franchise_item')->with($data);
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function previewAction($slug)
    {
        $data               = [];
        $data['frontClass'] = 'franchise-item';
        $franchise          = Franchises::GetItem($slug, true)->get();
        if ($franchise->count() == 0) {
            return redirect()->to('/');
        }
        $subject            = Subjects::find($franchise[0]->subject_id);
        $data['franchise']  = $franchise;
        $data['loggedUser'] = $this->getLoggedUser();
        $data['favorites']  = [];
        if ($data['loggedUser']) {
            $user              = User::find($data['loggedUser']->id);
            $data['favorites'] = $user->getListFavorites();
        }
        $data['franchisesAreas']  = $franchise[0]->franchiseAreas()->orderBy('order', 'ASC')->get();
        $data['franchiseImages']  = $this->getImagesForFront($franchise[0]);
        $data['franchiseOffices'] = $franchise[0]->franchiseOffice()->orderBy('order', 'ASC')->get();
        $data['suggested']        = [];

        if (!empty($franchise[0]->first_suggested)) {
            $data['suggested'][] = $this->suggested($franchise[0]->first_suggested);
        }

        if (!empty($franchise[0]->second_suggested)) {
            $data['suggested'][] = $this->suggested($franchise[0]->second_suggested);
        }

        if (!empty($franchise[0]->third_suggested)) {
            $data['suggested'][] = $this->suggested($franchise[0]->third_suggested);
        }

        return View::make('frontend.franchise_item')->with($data);
    }

    /**
     * @param
     * @return mixed
     */
    public function showCompare()
    {
        $data                    = [];
        $data['data']['status']  = true;
        $data['data']['message'] = $this->getInfoCompare();
        return response()->json($data);
    }

    /**
     * @return mixed
     */
    public function getInfoCompare()
    {
        $franchisesInfo = Franchises::ListAllFranchisesFront()->get();
        $franchises     = [];
        $i              = 0;
        foreach ($franchisesInfo as $franchise) {
            $images                 = $this->getImagesForFront($franchise);
            $franchises[$i]['name'] = $franchise->name;
            $franchises[$i]['slug'] = $franchise->slug;
            $franchises[$i]['logo'] = $images['logo'];
            $i++;
        }
        return $franchises;
    }

    /**
     * @param $slug1
     * @param $slug2
     * @param $slug3
     * @return mixed
     */
    public function compareAction($slug1 = null, $slug2 = null, $slug3 = null)
    {
        $data = [];

        if ($slug1 != null) {
            $franchiseOne = Franchises::GetItem($slug1)->get();
            if ($franchiseOne) {
                $data[0] = $this->toArray($franchiseOne[0]);
            }
        } else {
            $response['data']['status'] = false;
            return response()->json($response);
        }

        if ($slug2 != null) {
            $franchiseTwo = Franchises::GetItem($slug2)->get();
            if ($franchiseTwo) {
                $data[1] = $this->toArray($franchiseTwo[0]);
            }
        }

        if ($slug3 != null) {
            $franchiseThree = Franchises::GetItem($slug3)->get();
            if ($franchiseThree) {
                $data[2] = $this->toArray($franchiseThree[0]);
            }
        }

        $response['data']['status']  = true;
        $response['data']['message'] = $data;
        return response()->json($response);
    }

    public function toArray($franchise)
    {
        $image = $franchise->franchiseAsset()->where('position', 'logo')->get();
        $logo  = $image[0]->image;

        $result = [
            "name"                  => $franchise->name,
            "country"               => $franchise->country,
            "country_in"            => $franchise->country_in,
            "grand_open"            => $franchise->grand_open,
            "franchises_first_open" => $franchise->franchises_first_open,
            "franchises_local"      => $franchise->franchises_local,
            "franchises_this_year"  => $franchise->franchises_this_year,
            "franchises_total"      => $franchise->franchises_total,
            "partners"              => $franchise->partners,
            "fee"                   => $franchise->fee,
            "royalty"               => $franchise->royalty,
            "total_investment"      => $franchise->total_investment,
            "corporate_advertising" => $franchise->corporate_advertising,
            "canon_advertising"     => $franchise->canon_advertising,
            "financing_available"   => $franchise->financing_available,
            "average_annual"        => $franchise->average_annual,
            "recover_estimated"     => $franchise->recover_estimated,
            "premises_size"         => $franchise->premises_size,
            "employees"             => $franchise->employees,
            "contract_term"         => $franchise->contract_term,
            "exportable_franchise"  => $franchise->exportable_franchise,
            "logo"                  => $logo
        ];

        return $result;
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
     * @return mixed
     */
    public function suggested($id)
    {
        $franchises = Franchises::where('id', $id)->get();
        foreach ($franchises as $key => $franchise) {
            $images                    = $this->getImagesForFront($franchise);
            $franchises[$key]['image'] = $images['right_one'];
        }
        return $franchises;
    }
}
