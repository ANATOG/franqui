<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Franchises;
use App\Models\Meetings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;

class MeetingsController extends Controller
{

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {

        $inputs           = $request->all();
        $validate         = Validator::make($inputs,
            ['days' => 'required', 'hours' => 'required', 'phone' => 'required', 'message_user' => 'required', 'type' => 'required', 'slug_franchise' => 'required']);
        $response['data'] = [];

        if ($validate->fails()) {

            $response['data'] = ['status' => false, 'message' => $validate->errors()];
            return response()->json($response);

        } else {

            $results = $this->storeMeeting($inputs);
            if ($results) {
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
    public function storeMeeting($inputs)
    {

        $optionText = ['', 'facetoface' => 'Presencial', 'skype' => 'Skype'];
        $inputs['option_text'] = $optionText[Purify::clean($inputs['type'])];

        $loggedUser  = $this->getLoggedUser();
        if(empty($loggedUser)) {
            $response['data'] = ['status' => false, 'message' => 'not_login'];
            return response()->json($response);
        }

        $meeting          = new Meetings();
        $meeting->days    = Purify::clean($inputs['days']);
        $meeting->hours   = Purify::clean($inputs['hours']);
        $meeting->phone   = Purify::clean($inputs['phone']);
        $meeting->type    = Purify::clean($inputs['type']);
        $meeting->skype   = Purify::clean($inputs['skype']);
        $meeting->message = Purify::clean($inputs['message_user']);

        if ($meeting->save()) {
            $this->sendEmail($inputs);
            $this->sendUserEmail($inputs);
            return true;
        } else {
            return false;
        }

    }

    /**
     * @param $data
     */
    public function sendEmail($data)
    {
        $franchise         = Franchises::GetItem($data['slug_franchise'])->get();
        $user              = $this->getLoggedUser();
        $data['franchise'] = $franchise;
        $data['user']      = $user;

        Mail::send('frontend.emails.meetings', $data, function ($message) use ($data, $franchise, $user) {
            $message->from('franquiciar@franquiciar.com.ar', 'Franquiciar');
            $message->to('franquiciar@franquiciar.com.ar');
            $message->subject('Consulta recibida | Franquiciar.com.ar');
        });
    }

    /**
     * @param $data
     */
    public function sendUserEmail($data)
    {
        $franchise         = Franchises::GetItem($data['slug_franchise'])->get();
        $user              = $this->getLoggedUser();
        $data['franchise'] = $franchise;
        $data['user']      = $user;

        Mail::send('frontend.emails.meetings_user', $data, function ($message) use ($data, $franchise, $user) {
            $message->from('franquiciar@franquiciar.com.ar', 'Franquiciar');
            $message->to($user->email);
            $message->subject('Consultaste por ' . $franchise[0]->name . ' | Franquiciar.com.ar');
        });
    }

}
