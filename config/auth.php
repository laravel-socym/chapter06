<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard'     => 'web-cached',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | here which uses session storage and the Eloquent user provider.
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | Supported: "session", "token"
    |
    */

    'guards' => [
        'web'        => [
            'driver'   => 'session',
            'provider' => 'users',
        ],
        // デフォルトのものを残しているため、書籍内のguard名と異なりますが内容は全く同じです
        'web-cached' => [
            'driver'   => 'session',
            'provider' => 'cached',
        ],
        'api'        => [
            'driver'   => 'token',
            'provider' => 'user_token',
        ],
        // 複数のサンプルコードが混在しているため、書籍と名前を変えています
        'jwt-api' => [
            // jwtドライバを追加
            'driver' => 'jwt',
            'provider' => 'users',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | If you have multiple user tables or models you may configure multiple
    | sources which represent each model / table. These sources may then
    | be assigned to any extra authentication guards you have defined.
    |
    | Supported: "database", "eloquent"
    |
    */

    'providers' => [
        // Laravel デフォルトの認証ドライバ
        'users'  => [
            'driver' => 'eloquent',
            'model'  => App\User::class,
        ],
        // デフォルトのものと異なる拡張ドライバ
        // 書籍とドライバ名が異なりますが、内容は同じです
        'cached' => [
            'driver' => 'cache_eloquent',
            /**
             * モデルクラスはここで指定せずに、
             * \App\Providers/AuthServiceProviderクラスで直接指定しても構いません
             * アプリケーションに合わせた指定方法を導入しましょう
             * @see \App\Providers\AuthServiceProvider
             */
            'model'  => App\User::class,
        ],
        'user_token' => [
            'driver' => 'user_token'
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | You may specify multiple password reset configurations if you have more
    | than one user table or model in the application and you want to have
    | separate password reset settings based on the specific user types.
    |
    | The expire time is the number of minutes that the reset token should be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table'    => 'password_resets',
            'expire'   => 60,
        ],
    ],

];
