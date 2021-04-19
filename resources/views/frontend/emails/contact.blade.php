<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <style>
        p {
            font-family: Arial, sans-serif;
            font-size: 16px;
            color: #515151;
            display: inline-block;
            margin-top: 0;
            line-height: 1.4;
        }
        .container {
            display: table;
            margin: 0 auto;
            width: 100%;
            max-width: 480px;
        }
    </style>

</head>
<body>
<div style="width: 100%; max-width: 600px; display: table; margin: 0 auto;">
    <div style="background-image:url({{ Config::get('app.url') }}public/uploads/mails/heading-bg.jpg); background-repeat:no-repeat; background-color:#131927; padding: 0 50px;">
        <div class="container" style="padding: 30px 0;display: table;margin: 0 auto;width: 100%;max-width: 480px;">
            <img src="{{ Config::get('app.url') }}public/uploads/mails/logo-clear.png">
        </div>
        <div class="container" style="display: table;margin: 0 auto;width: 100%;max-width: 480px;">
            <div style="background-color:#FFFFFF; padding: 70px 30px 95px;margin-bottom: -35px;position: relative;">
                <p style="font-family: Arial, sans-serif;font-size: 16px;color: #515151;display: inline-block;margin-top: 0;line-height: 1.4;">Ha recibido una consulta a través de nuestra multiplataforma www.franquiciar.com.ar.</p>
                <p style="font-family: Arial, sans-serif;font-size: 16px;color: #515151;display: inline-block;margin-top: 0;line-height: 1.4;">
                    <b>Nombre</b>: {{ $name }}<br>
                    <b>Mail</b>: {{ $email }}<br>
                    <b>Teléfono</b>: {{ $phone }}<br>
                    <b>País</b>: {{ $country }}<br>
                    <b>Opción</b>: {{ $option_text }}<br>
                    <b>Mensaje</b>: {{ $message_user }}

                </p>
                <p style="font-family: Arial, sans-serif;font-size: 16px;color: #515151;display: inline-block;margin-top: 0;line-height: 1.4;"><b>Muchas gracias por ser parte de nuestra multiplataforma.</b></p>
            </div>
        </div>
    </div>
    <div style="background-color:#193285; padding: 60px 50px 30px;">
        <div class="container" style="display: table;margin: 0 auto;width: 100%;max-width: 480px;">
            <img src="{{ Config::get('app.url') }}public/uploads/mails/logo-blue.jpg" style="margin-right: 50px; margin-bottom: 20px;">
            <p style="color: #FFFFFF;vertical-align: bottom;font-weight: bold;font-size: 12px;margin-bottom: 25px;font-family: Arial, sans-serif;display: inline-block;margin-top: 0;line-height: 1.4;">
                <a href="mailto:franquiciar@franquiciar.com.ar" style="color:#FFFFFF; text-decoration: none;">franquiciar@franquiciar.com.ar</a><br>
                <a href="franquiciar.com.ar" style="color:#FFFFFF; text-decoration: none;">www.franquiciar.com.ar</a>
            </p>
        </div>
    </div>
</div>
</body>
</html>