<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class ResetPasswordCustomController extends ResetPassword
{

    // Overriding the function
    public function toMail($notifiable)
    {
        $path = \Request::route()->getPath();
        if (strpos($path, Config::get('app.admin_directory')) !== false) {
            return (new MailMessage)->subject('Restablecer Contraseña | Franquiciar.com.ar')->action('Restablecer Contraseña', url(Config::get('app.admin_directory').'/password/reset', $this->token));
        }
        return (new MailMessage)->subject('Restablecer Contraseña | Franquiciar.com.ar')->action('Restablecer Contraseña', url('/password/reset', $this->token));

    }

}
