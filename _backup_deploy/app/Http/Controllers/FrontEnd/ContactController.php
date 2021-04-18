<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;

class ContactController extends Controller
{

    private $messages = ['option.required' => 'Debes seleccionar una de las opciones.'];

    /**
     * @return mixed
     */
    public function listAction()
    {
        $data               = [];
        $data['frontClass'] = 'contact';
        $data['loggedUser'] = $this->getLoggedUser();
        return View::make('frontend.contact')->with($data);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {

        $inputs           = $request->all();
        $validate         = Validator::make($inputs,
            ['name' => 'required', 'email' => 'required', 'phone' => 'required', 'option' => 'required', 'message_user' => 'required', 'country'=>'required' ], $this->messages);
        $response['data'] = [];

        if ($validate->fails()) {

            $response['data'] = ['status' => false, 'message' => $validate->errors()];
            return response()->json($response);

        } else {

            $results = $this->storeContact($inputs);
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
    public function storeContact($inputs)
    {

        $optionText = ['', 'busco una franquicia', 'quiero anunciar mi marca en franquiciar', 'quiero franquiciar mi negocio', 'otras consultas'];
        $inputs['option_text'] = $optionText[Purify::clean($inputs['option'])];

        $contact          = new Contact();
        $contact->name    = Purify::clean($inputs['name']);
        $contact->email   = Purify::clean($inputs['email']);
        $contact->phone   = Purify::clean($inputs['phone']);
        $contact->country = Purify::clean($inputs['country']);
        $contact->message = Purify::clean($inputs['message_user']);
        $contact->option  = Purify::clean($inputs['option']);

        if ($contact->save()) {
            $data                   = $inputs;
            $this->sendEmail($data);
            $this->sendUserEmail($data);
            $response['data']['status'] = true;
            return response()->json($response);
        } else {
            $response['data'] = ['status' => false, 'message' => 'create_error'];
            return response()->json($response);
        }

    }

    /**
     * @param $data
     */
    public function sendEmail($data)
    {
        Mail::send('frontend.emails.contact', $data, function ($message) use ($data) {
            $message->from('anitatorrez1924@gmail.com', 'Franquiciar');
            $message->to('anitatorrez1924@gmail.com');
            $message->subject('Consulta recibida | Franquiciar.com.ar');
        });
    }

    /**
     * @param $data
     */
    public function sendUserEmail($data)
    {
        Mail::send('frontend.emails.contact_user', $data, function ($message) use ($data) {
            $message->from('franquiciar@franquiciar.com.ar', 'Franquiciar');
            $message->to($data['email']);
            $message->subject('Consultaste por la web | Franquiciar.com.ar');
        });
    }
}
