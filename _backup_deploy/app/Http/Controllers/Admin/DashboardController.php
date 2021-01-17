<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class DashboardController extends BaseAdminController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function dashboard()
    {
        $this->getLoggedUser();
        $data                = [];
        $data['breadcrumbs'] = [trans('custom.breadcrumbs_dashboard')];
        return View::make('admin.dashboard')->with($data);
    }

}
