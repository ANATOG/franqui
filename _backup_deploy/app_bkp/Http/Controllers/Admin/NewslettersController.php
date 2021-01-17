<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Models\Newsletters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;

class NewslettersController extends BaseAdminController
{

    public function __construct()
    {
        parent::__construct();
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
            trans('custom.breadcrumbs_newsletters'),
            trans('custom.breadcrumbs_list')
        ];

        $data['items'] = Newsletters::ListAllNewsletters($search, $order, $orderBy)->paginate($limit);

        return View::make('admin.newsletters.list')->with($data);
    }

    public function export()
    {
        //$filename = uniqid("newsletters_");
        $filename = 'newsletters_'.date('d_m_Y_H_i_s');
        Excel::create( $filename, function ($excel) {
            $excel->sheet('Sheetname', function ($sheet) {
                $newsletters = Newsletters::where('visible', true)->get(['email']);
                $sheet->fromModel($newsletters);
            });
        })->download('xls');
    }

    /**
     * @param Newsletters $newsletter
     * @return mixed
     * @internal param null $id
     */
    public function delete(Newsletters $newsletter)
    {
        $data                = [];
        $data['item']        = $newsletter;
        $data['loggedUser']  = $this->getLoggedUser();
        $data['breadcrumbs'] = [
            trans('custom.breadcrumbs_web_content'),
            trans('custom.breadcrumbs_newsletters'),
            trans('custom.breadcrumbs_delete')
        ];

        return View::make('admin.newsletters.delete')->with($data);
    }

    /**
     * @param Newsletters $newsletter
     * @return mixed
     * @internal param Request $request
     */
    public function destroy(Newsletters $newsletter)
    {
        if ($newsletter->delete()) {
            return Redirect()->route('newsletters.list')->with('message_success',
                trans('custom.data_deleted_correctly'));
        } else {
            return Redirect::back()->withErrors(trans('custom.data_deleted_failed'));
        }
    }

    /**
     * Set the item like visible or not
     *
     * @param Newsletters $newsletter
     * @return
     * @internal param null $id
     */
    public function changeVisible(Newsletters $newsletter)
    {
        if ($newsletter->visible) {
            $newsletter->visible = false;
        } else {
            $newsletter->visible = true;
        }

        if ($newsletter->save()) {
            return Redirect()->route('newsletters.list')->with('message_success',
                trans('custom.data_change_visibility_correctly'));
        } else {
            return Redirect::back()->withErrors(trans('custom.data_change_visibility_failed'));
        }
    }
}