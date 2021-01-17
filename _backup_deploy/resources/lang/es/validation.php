<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'   => 'El campo :attribute debe ser aceptado.',
    'active_url' => 'El campo :attribute no es una URL válida.',
    'after'      => 'El campo :attribute debe ser una fecha posterior a :date.',
    'alpha'      => 'El campo :attribute sólo puede contener letras.',
    'alpha_dash' => 'El campo :attribute sólo puede contener letras, números y guiones (a-z, 0-9, -_).',
    'alpha_num'  => 'El campo :attribute sólo puede contener letras y números.',
    'array'      => 'El campo :attribute debe ser un array.',
    'before'     => 'El campo :attribute debe ser una fecha anterior a :date.',

    'between'              => [
        'numeric' => 'El campo :attribute debe ser un valor entre :min y :max.',
        'file'    => 'El archivo :attribute debe pesar entre :min y :max kilobytes.',
        'string'  => 'El campo :attribute debe contener entre :min y :max caracteres.',
        'array'   => 'El campo :attribute debe contener entre :min y :max elementos.',
    ],
    'boolean'              => 'El campo :attribute debe ser verdadero o falso.',
    'confirmed'            => 'El campo confirmación de :attribute no coincide.',
    'country'              => 'El campo :attribute no es un país válido.',
    'date'                 => 'El campo :attribute no corresponde con una fecha válida.',
    'date_format'          => 'El campo :attribute no corresponde con el formato de fecha :format.',
    'different'            => 'Los campos :attribute y :other han de ser diferentes.',
    'digits'               => 'El campo :attribute debe ser un número de :digits dígitos.',
    'digits_between'       => 'El campo :attribute debe contener entre :min y :max dígitos.',
    'distinct'             => 'El campo :attribute tiene un valor duplicado.',
    'email'                => 'El campo :attribute no corresponde con una dirección de e-mail válida.',
    'filled'               => 'El campo :attribute es obligatorio.',
    'exists'               => 'El campo :attribute no existe.',
    'image'                => 'El campo :attribute debe ser una imagen.',
    'in'                   => 'El campo :attribute debe ser igual a alguno de estos valores :values',
    'in_array'             => 'El campo :attribute no existe en :other.',
    'integer'              => 'El campo :attribute debe ser un número entero.',
    'ip'                   => 'El campo :attribute debe ser una dirección IP válida.',
    'json'                 => 'El campo :attribute debe ser una cadena de texto JSON válida.',
    'max'                  => [
        'numeric' => 'El campo :attribute debe ser :max como máximo.',
        'file'    => 'El archivo :attribute debe pesar :max kilobytes como máximo.',
        'string'  => 'El campo :attribute debe contener :max caracteres como máximo.',
        'array'   => 'El campo :attribute debe contener :max elementos como máximo.',
    ],
    'mimes'                => 'El campo :attribute debe ser un archivo de tipo :values.',
    'dimensions'           => 'El campo :attribute no tiene el tamaño permitido.',
    'min'                  => [
        'numeric' => 'El campo :attribute debe tener al menos :min.',
        'file'    => 'El archivo :attribute debe pesar al menos :min kilobytes.',
        'string'  => 'El campo :attribute debe contener al menos :min caracteres.',
        'array'   => 'El campo :attribute no debe contener más de :min elementos.',
    ],
    'not_in'               => 'El campo :attribute seleccionado es invalido.',
    'numeric'              => 'El campo :attribute debe ser un numero.',
    'present'              => 'El campo :attribute debe estar presente.',
    'regex'                => 'El formato del campo :attribute es inválido.',
    'required'             => 'El campo :attribute es obligatorio',
    'required_if'          => 'El campo :attribute es obligatorio cuando el campo :other es :value.',
    'required_unless'      => 'El campo :attribute es requerido a menos que :other se encuentre en :values.',
    'required_with'        => 'El campo :attribute es obligatorio cuando :values está presente.',
    'required_with_all'    => 'El campo :attribute es obligatorio cuando :values está presente.',
    'required_without'     => 'El campo :attribute es obligatorio cuando :values no está presente.',
    'required_without_all' => 'El campo :attribute es obligatorio cuando ningún campo :values están presentes.',
    'same'                 => 'Los campos :attribute y :other deben coincidir.',
    'size'                 => [
        'numeric' => 'El campo :attribute debe ser :size.',
        'file'    => 'El archivo :attribute debe pesar :size kilobytes.',
        'string'  => 'El campo :attribute debe contener :size caracteres.',
        'array'   => 'El campo :attribute debe contener :size elementos.',
    ],
    'state'                => 'El estado no es válido para el país seleccionado.',
    'string'               => 'El campo :attribute debe contener solo caracteres.',
    'timezone'             => 'El campo :attribute debe contener una zona válida.',
    'unique'               => 'El elemento :attribute ya está en uso.',
    'url'                  => 'El formato de :attribute no corresponde con el de una URL válida.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'question'               => 'pregunta',
        'title'                  => 'título',
        'name'                   => 'nombre',
        'user_name'              => 'nombre de usuario',
        'password'               => 'contraseña',
        'first_name'             => 'nombre',
        'answer'                 => 'respuesta',
        'image'                  => 'imagen',
        'image_top'              => 'imagen superior',
        'right_one'              => 'imagen derecha',
        'left_one'               => 'imagen izquierda 1',
        'left_two'               => 'imagen izquierda 2',
        'left_three'             => 'imagen izquierda 3',
        'thematic_id'            => 'temática',
        'lat'                    => 'latitud',
        'lng'                    => 'longitud',
        'role_id'                => 'role',
        'days'                   => 'dias',
        'hours'                  => 'horarios',
        'adviser'                => 'asesor',
        'message_adviser'        => 'mensaje',
        'message_user'           => 'mensaje',
        'position'               => 'posición',
        'subject'                => 'rubro',
        'author'                 => 'autor',
        'phone'                  => 'teléfono',
        'location'               => 'ubicación',
        'business_name'          => 'razón social',
        'vat_condition'          => 'condición de IVA',
        'contact_address'        => 'dirección',
        'authorizes_recruitment' => 'persona que autoriza la contratación',
        'contrac_phone'          => 'teléfono de contacto',
        'contact_email'          => 'email de contacto',
        'contracting_period'     => 'período de contratación',
        'way_pay'                => 'forma de pago',
        'contact_name'           => 'nombre y cargo del contacto',
        'web_site'               => 'sitio web',
        'subject_id'             => 'rubro',
        'options'                => 'opciones',
        'option'                 => 'opción',
        'total_investment'       => 'Inversión total',
        'fee'                    => 'Canon/Fee de ingreso',
        'canon_advertising'      => 'Canon de publicidad',
        'franchises_total'       => 'Locales Franquiciados',
        'franchises_local'       => 'Locales Propios',
        'grand_open'             => 'Año de inicio de la empresa',
        'average_annual'         => 'Facturación promedio anual por local',
        'franchises_first_open'  => 'Apertura primera franquicia',
        'contact_email'          => 'email de contacto',
        'first_reasons'          => 'primera razón',
        'second_reasons'         => 'segunda razón',
        'third_reasons'          => 'tercera razón',
        'fourth_reasons'         => 'cuarta razón',
        'fifth_reasons'          => 'quinta razón',
        'website'                => 'sitio web',
        'description_red'        => 'descripción rubro'
    ],

];
