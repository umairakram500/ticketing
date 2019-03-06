<?php
/*
 * Secret key and Site key get on https://www.google.com/recaptcha
 * */
return [
    'secret' => env('CAPTCHA_SECRET', '6LcEc34UAAAAAPB3PIHPgAETlK2mTOhxxK8TB-nR'),
    'sitekey' => env('CAPTCHA_SITEKEY', '6LcEc34UAAAAABqFlzZNO_D9edR9LkyhniTMSkug'),
    /**
     * @var string|null Default ``null``.
     * Custom with function name (example customRequestCaptcha) or class@method (example \App\CustomRequestCaptcha@custom).
     * Function must be return instance, read more in folder ``examples``
     */
    'request_method' => null,
    'options' => [
        'multiple' => false,
        'lang' => app()->getLocale(),
    ],
    
    'attributes' => [
        'theme' => 'light'
    ],
];