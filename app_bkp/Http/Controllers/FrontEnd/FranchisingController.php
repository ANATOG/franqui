<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class FranchisingController extends Controller
{
    /**
     * @return mixed
     */
    public function franchising()
    {
        $data               = [];
        $data['frontClass'] = 'franchising';
        $data['loggedUser'] = $this->getLoggedUser();
        return View::make('frontend.franchising')->with($data);
    }

    /**
     * @return mixed
     */
    public function associations()
    {
        $data               = [];
        $data['frontClass'] = 'associations';
        $data['loggedUser'] = $this->getLoggedUser();
        return View::make('frontend.associations')->with($data);
    }

    /**
     * @return mixed
     */
    public function carnival()
    {
        $data               = [];
        $data['frontClass'] = 'carnival';
        $data['loggedUser'] = $this->getLoggedUser();
        return View::make('frontend.carnival')->with($data);
    }

}
