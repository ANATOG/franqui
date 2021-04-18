<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\AdviserContacts;
use App\Models\Consultants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Stevebauman\Purify\Facades\Purify;

class AdviserController extends Controller
{
    /**
     * @return mixed
     */
    public function listAction()
    {
        $data                = [];
        $data['frontClass']  = 'adviser';
        $data['loggedUser']  = $this->getLoggedUser();
        $data['consultants'] = Consultants::ListAllConsultantsFront()->get();
        return View::make('frontend.adviser')->with($data);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $loggedUser  = $this->getLoggedUser();
        if(empty($loggedUser)) {
            $response['data'] = ['status' => false, 'message' => 'not_login'];
            return response()->json($response);
        }

        $inputs           = $request->all();
        $validate         = Validator::make($inputs, ['adviser' => 'required', 'message_adviser' => 'required']);
        $response['data'] = [];

        if ($validate->fails()) {

            $response['data'] = ['status' => false, 'message' => $validate->errors()];
            return response()->json($response);

        } else {

            $results = $this->storeAdviserContact($inputs);
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
    public function storeAdviserContact($inputs)
    {

        $optionText = ['', 'Asesoramiento sin cargo en la búsqueda de franquicias', 'Presupuesto para desarrollar la franquicia de mi negocio', 'Asesoramiento legal en contratos, registro de marca, cuestiones laborales.', 'Otro tipo de asesoramiento'];
        $inputs['option_text'] = $optionText[Purify::clean($inputs['adviser'])];

        $adviserContacts          = new AdviserContacts();
        $adviserContacts->adviser = Purify::clean($inputs['adviser']);
        $adviserContacts->message = Purify::clean($inputs['message_adviser']);

        if ($adviserContacts->save()) {
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
        $user         = $this->getLoggedUser();
        $data['user'] = $user;
        Mail::send('frontend.emails.adviser', $data, function ($message) use ($data, $user) {
            $message->from('anitatorrez1924@gmail.com', 'Franquiciar');
            $message->to('anitatorrez1924@gmail.com');
            $message->subject('Consulta por asesoramiento recibida | Franquiciar.com.ar');
        });
    }

    /**
     * @param $data
     */
    public function sendUserEmail($data)
    {
        $user         = $this->getLoggedUser();
        $data['user'] = $user;
        Mail::send('frontend.emails.adviser_user', $data, function ($message) use ($data, $user) {
            $message->from('anitatorrez1924@gmail.com', 'Franquiciar');
            $message->to($user->email);
            $message->subject('Consultaste por asesoramiento | Franquiciar.com.ar');
        });
    }

}
