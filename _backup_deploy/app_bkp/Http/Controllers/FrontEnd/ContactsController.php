<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Contacts;
use App\Models\Franchises;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;

class ContactsController extends Controller
{

    /**
     * @param Request $request
     * @return mixed
     */
    public function storeInSession(Request $request)
    {
        $inputs   = $request->all();
        $validate = Validator::make($inputs, ['slug_franchise' => 'required']);

        if ($validate->fails()) {
            $response['data'] = ['status' => false, 'message' => $validate->errors()];
            return response()->json($response);

        } else {

            $slugInfo = Session::get('slugs');
            if (empty($slugInfo)) {
                $slugInfo[] = $inputs['slug_franchise'];
                Session::put('slugs', $slugInfo);
            } else {
                if (!in_array($inputs['slug_franchise'], $slugInfo)) {
                    Session::forget('slugs');
                    $slugInfo[] = $inputs['slug_franchise'];
                    Session::put('slugs', $slugInfo);
                } else {
                    Session::forget('slugs');
                    $result = array_values(array_diff($slugInfo, [$inputs['slug_franchise']]));
                    Session::put('slugs', $result);
                }
            }

            $response['data']['status']   = true;
            $response['data']['quantity'] = count(Session::get('slugs'));
            $response['data']['slugs']    = implode(",", Session::get('slugs'));
            return response()->json($response);
        }

    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function clearInSession(Request $request)
    {
        Session::forget('slugs');
        $response['data'] = ['status' => true];
        return response()->json($response);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {

        $inputs           = $request->all();
        $validate         = Validator::make($inputs,
            ['slug_franchise' => 'required', 'phone' => 'required', 'message_user' => 'required']);
        $response['data'] = [];

        if ($validate->fails()) {

            $response['data'] = ['status' => false, 'message' => $validate->errors()];
            return response()->json($response);

        } else {

            $results = $this->storeContact($inputs);
            if ($results) {
                Session::forget('slugs');
                $response['data']['status'] = true;
                return response()->json($response);
            } else {
                $response['data'] = ['status' => false, 'message' => 'create_error'];
                return response()->json($response);
            }

        }
    }

    /**
     * Create meeting
     *
     * @param $inputs
     * @return bool
     */
    public function storeContact($inputs)
    {
        $loggedUser = $this->getLoggedUser();
        if (empty($loggedUser)) {
            $response['data'] = ['status' => false, 'message' => 'not_login'];
            return response()->json($response);
        }

        $franchisesForm = explode(",", Purify::clean($inputs['slug_franchise']));
        foreach ($franchisesForm as $franchiseForm) {
            $contacts          = new Contacts();
            $contacts->name    = $loggedUser->first_name . ' ' . $loggedUser->last_name;
            $contacts->email   = $loggedUser->email;
            $contacts->phone   = Purify::clean($inputs['phone']);
            $contacts->message = Purify::clean($inputs['message_user']);
            if ($contacts->save()) {
                $data                   = $inputs;
                $data['slug_franchise'] = trim($franchiseForm);
                $this->sendEmail($data);
                $this->sendUserEmail($data);
            } else {
                return false;
            }
        }
        return true;

    }

    /**
     * @param $data
     */
    public function sendEmail($data)
    {
        $franchise = Franchises::GetItem($data['slug_franchise'])->get();
        if ($franchise->count() > 0) {
            $user              = $this->getLoggedUser();
            $data['user']      = $user;
            $data['franchise'] = $franchise;

            Mail::send('frontend.emails.contacts', $data, function ($message) use ($data, $franchise, $user) {
                $message->from('franquiciar@franquiciar.com.ar', 'Franquiciar');
                $message->to('franquiciar@franquiciar.com.ar');
                $message->subject('Consulta recibida | Franquiciar.com.ar');
            });

            Mail::send('frontend.emails.contacts', $data, function ($message) use ($data, $franchise, $user) {
                $message->from('franquiciar@franquiciar.com.ar', 'Franquiciar');
                $message->to($franchise[0]->email);
                $message->subject('Consulta recibida | Franquiciar.com.ar');
            });


        }
    }

    /**
     * @param $data
     */
    public function sendUserEmail($data)
    {
        $franchise = Franchises::GetItem($data['slug_franchise'])->get();
        if ($franchise->count() > 0) {
            $user              = $this->getLoggedUser();
            $data['user']      = $user;
            $data['franchise'] = $franchise;

            Mail::send('frontend.emails.contacts_user', $data, function ($message) use ($data, $franchise, $user) {
                $message->from('franquiciar@franquiciar.com.ar', 'Franquiciar');
                $message->to($user->email);
                $message->subject('Consultaste por ' . $franchise[0]->name . ' | Franquiciar.com.ar');
            });
        }
    }

}
