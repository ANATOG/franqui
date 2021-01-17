<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Newsletters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;

class NewslettersController extends Controller
{

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $inputs           = $request->all();
        $validate         = Validator::make($inputs, ['email' => 'required|email|unique:newsletters,email']);
        $response['data'] = [];

        if ($validate->fails()) {

            $response['data'] = ['status' => false, 'message' => $validate->errors()];
            return response()->json($response);

        } else {

            if ($this->storeNewsletter($inputs)) {
                $response['data'] = ['status' => true];
                return response()->json($response);
            } else {
                $response['data'] = ['status' => false, 'message' => 'create_error'];
                return response()->json($response);
            }

        }
    }

    /**
     * Create email in newsletter
     *
     * @param $inputs
     * @return bool
     */
    public function storeNewsletter($inputs)
    {
        $newsletter        = new Newsletters;
        $newsletter->email = Purify::clean($inputs['email']);

        return $newsletter->save();
    }

}
