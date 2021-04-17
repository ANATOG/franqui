<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Newsletters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
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
                \Session::flash('message', 'Suscripción realizada con éxito.'); 
                \Session::flash('alert-class', 'alert-success');
                return response()->json($response);

            } else {
                $response['data'] = ['status' => false, 'message' => 'create_error'];
                \Session::flash('message', 'Algo salio mal.'); 
                \Session::flash('alert-class', 'alert-warning');
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

        $data['email'] = $newsletter->email;
        $this->sendEmail($data);


        return $newsletter->save();
    }

    /**
     * @param $data
     */
    public function sendEmail($data)
    {
        Mail::send('frontend.emails.newsletter', $data, function ($message) use ($data) {
            $message->from('anitatorrez1924@gmail.com', 'Franquiciar');
            $message->to($data['email']);
            $message->subject('Suscripción a Newsletter | Franquiciar');
        });
    }

}
