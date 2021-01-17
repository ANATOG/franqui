<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Stevebauman\Purify\Facades\Purify;

class UsersController extends Controller
{

    private $messages = ['password.regex' => 'La contraseña debe ser alfanúmerica y contener 6 caractéres.'];

    /**
     * @param $method
     * @param null $id
     * @return array
     */
    public function rules($method, $id = null)
    {
        switch ($method) {
            case 'create': {
                return [
                    'first_name' => 'required',
                    'email'      => 'required|email|unique:users,email',
                    'password'   => 'required|alpha_num|min:6',
                    'phone'   => 'required',
                    'location'   => 'required'
                ];
            }
            case 'edit': {
                return [
                    'first_name' => 'required',
                    'email'      => 'required|email|unique:users,email,' . $id,
                    'password'   => 'alpha_num|min:6'
                ];
            }
            default:
                break;
        }
    }

    /**
     * @return mixed
     */
    public function create()
    {
        $data               = [];
        $data['frontClass'] = 'register';

        return View::make('frontend.register')->with($data);
    }

    /**
     * @return mixed
     */
    public function item()
    {

        $loggedUser = $this->getLoggedUser();
        if (empty($loggedUser)) {
            return redirect()->to('/');
        }

        $data               = [];
        $loggedUser         = $this->getLoggedUser();
        $user               = User::find($loggedUser->id);
        $data['item']       = $user;
        $data['frontClass'] = 'profile';
        $data['favorites']  = $user->getFavoritesList();
        $data['loggedUser'] = $this->getLoggedUser();

        return View::make('frontend.profile')->with($data);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $inputs           = $request->all();
        $validate         = Validator::make($inputs, $this->rules('create'), $this->messages);
        $response['data'] = [];

        if ($validate->fails()) {
            $response['data'] = ['status' => false, 'message' => $validate->errors()];
            return response(json_encode($response));
        } else {

            $results = $this->storeUser($inputs);
            if (is_numeric($results)) {
                Auth::loginUsingId($results);
                $response['data']['status'] = true;
                return response(json_encode($response));
            } else {
                $response['data'] = ['status' => false, 'message' => 'create_error'];
                return response(json_encode($response));
            }
        }
    }

    /**
     * Create user
     *
     * @param $inputs
     * @return bool
     */
    public function storeUser($inputs)
    {
        $user             = new User;
        $user->first_name = Purify::clean($inputs['first_name']);
        $user->email      = Purify::clean($inputs['email']);
        $user->phone      = Purify::clean($inputs['phone']);
        $user->location      = Purify::clean($inputs['location']);
        $user->role_id    = Purify::clean(4);

        if (!empty($inputs['password'])) {
            $user->password = Hash::make($inputs['password']);
        }
        
        if($user->save()) {
            $this->sendUserEmail($inputs);
            return $user->id;
        } else {
            return false;
        }
    }


    /**
     * @param $data
     */
    public function sendUserEmail($data)
    {
        Mail::send('frontend.emails.user_register', $data, function ($message) use ($data) {
            $message->from('franquiciar@franquiciar.com.ar', 'Franquiciar');
            $message->to($data['email']);
            $message->subject('Registración exitosa | Franquiciar');
        });
    }


    /**
     * @param Request $request
     * @return mixed
     * @internal param $id
     */
    public function update(Request $request)
    {
        $inputs     = $request->all();
        $loggedUser = $this->getLoggedUser();
        $user       = User::find($loggedUser->id);

        $validate = Validator::make($inputs, $this->rules('edit', $user->id), $this->messages);

        if ($validate->fails()) {
            $response['data'] = ['status' => false, 'message' => $validate->errors()];
            return response(json_encode($response));
        } else {
            if ($this->updateUser($user, $inputs)) {
                $response['data']['status'] = true;
                return response(json_encode($response));
            } else {
                $response['data'] = ['status' => false, 'message' => 'create_error'];
                return response(json_encode($response));
            }
        }
    }

    /**
     * Update user
     *
     * @param $user
     * @param $inputs
     * @return mixed
     */
    public function updateUser($user, $inputs)
    {
        $user->first_name = Purify::clean($inputs['first_name']);
        $user->email      = Purify::clean($inputs['email']);

        if (!empty($inputs['password'])) {
            $user->password = Hash::make($inputs['password']);
        }
        return $user->save();
    }

    /**
     * @return mixed
     */
    public function forgot()
    {
        $data               = [];
        $data['frontClass'] = 'forgot';

        return View::make('frontend.forgot')->with($data);
    }

    /**
     * @return mixed
     */
    public function reset()
    {
        $data               = [];
        $data['frontClass'] = 'reset';

        return View::make('frontend.reset')->with($data);
    }

    public function addDeleteFavorites(Request $request)
    {
        $loggedUser = $this->getLoggedUser();
        if (empty($loggedUser)) {
            $response['data'] = ['status' => false, 'message' => 'not_login'];
            return response()->json($response);
        }

        $inputs = $request->all();
        $user   = User::find($loggedUser->id);

        if (empty($user)) {
            $response['data'] = ['status' => false];
            return response()->json($response);
        }

        $result = $user->favorites()->toggle($inputs['franchise']);

        $message = "detached";
        if (count($result['attached']) > 0) {
            $message = "attached";
        }

        $response['data'] = ['status' => true, 'message' => $message];
        return response()->json($response);

    }

}
