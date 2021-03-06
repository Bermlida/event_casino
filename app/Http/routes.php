<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'IndexController@index');

Route::get('/400', function () {
    return view('errors.400');
});

Route::get('/403', function () {
    return view('errors.403');
});

Route::get('/404', function () {
    return view('errors.404');
});

Route::group([
    'as' => 'visit::'
], function () {
    Route::group([
        'prefix' => '/activities'
    ], function () {
        Route::get('/', 'ActivityController@index')->name('activities');

        Route::group([
            'prefix' => '/{activity}',
            'middleware' => ['exist-activity', 'judge-was-launched']
        ], function () {
            Route::get('/', 'ActivityController@info')->name('activity');
            Route::get('/logs/{log}', 'ActivityController@log')
                ->middleware('exist-log')
                ->name('activity::log');
        });        
    });    

    Route::get('/organizers', 'OrganizerController@index')->name('organizers');
    Route::get('/organizers/{organizer}', 'OrganizerController@info')
        ->middleware('exist-organizer')
        ->name('organizer');
});

Route::auth();

Route::group([
    'prefix' => '/register',
    'namespace' => 'Auth',
    'as' => 'register::'
], function () {
    Route::get('/user', 'AuthController@showRegisterUser')->name('user');
    Route::get('/organizer', 'AuthController@showRegisterOrganizer')->name('organizer');
    
    Route::post('/user', 'AuthController@registerUser')->name('user::store');
    Route::post('/organizer', 'AuthController@registerOrganizer')->name('organizer::store');
});


Route::group([
    'prefix' => '/social-auth/{social_provider}',
    'namespace' => 'Auth',
    'middleware' => 'verify-social-provider',
    'as' => 'social-auth::'
], function () {
    Route::get('/register', 'AuthController@redirectToRegister')->name('register');
    
    Route::group([
        'prefix' => '/register/{role}',
        'where' => ['role' => '(organizer|user)'],
        'as' => 'register::'
    ], function () {
        Route::get('/', 'AuthController@askForRegister')->name('ask');
        Route::get('/callback', 'AuthController@replyForRegister')->name('reply');
    });
    
    Route::group([
        'prefix' => '/login',
        'as' => 'login::'
    ], function () {
        Route::get('/', 'AuthController@askForLogin')->name('ask');
        Route::get('/callback', 'AuthController@replyForLogin')->name('reply');
    });
});

Route::group([
    'namespace' => 'Account',
    'middleware' => 'auth'
], function () {
    Route::group([
        'prefix' => '/account',
        'as' => 'account::'
    ], function () {
        Route::get('/setting', 'SettingController@index')->name('setting');
        Route::post('/setting', 'SettingController@save')->name('setting::save');
    
        Route::get('/info', 'InfoController@index')->name('info');
        Route::post('/info', 'InfoController@save')->name('info::save');

        Route::group([
            'prefix' => '/refund-setting',
            'middleware' => 'judge-role:1',
            'as' => 'refund-setting'
        ], function () {
            Route::get('/', 'SettingController@showRefundSetting');
            Route::post('/', 'SettingController@saveRefundSetting')->name('::save');
        });

        Route::group([
            'prefix' => '/receipt-setting',
            'middleware' => 'judge-role:2',
            'as' => 'receipt-setting'
        ], function () {
            Route::get('/', 'SettingController@showReceiptSetting');
            Route::post('/', 'SettingController@saveReceiptSetting')->name('::save');
        });
    });
});

Route::group([
    'prefix' => '/participate/records',
    'namespace' => 'Participate',
    'middleware' => ['auth', 'judge-role:1'],
    'as' => 'participate::record::'
], function () {
    Route::get('/', 'RecordController@index')->name('list');

    Route::group([
        'prefix' => '/{record}',
        'middleware' => 'exist-participate-record'
    ], function () {
        Route::get('/view', 'RecordController@info')->name('view');

        Route::get('/register', 'RegisterController@index')->name('register-certificate');

        Route::get('/cancel', 'RecordController@showCancel')->name('cancel::confirm');
        Route::put('/cancel', 'RecordController@cancel')->name('cancel');
        
        Route::get('/refund', 'RecordController@showRefund')->name('refund::confirm');
        Route::put('/refund', 'RecordController@refund')->name('refund');
    });
});

Route::group([
    'prefix' => '/organise/activities',
    'namespace' => 'Organise',
    'middleware' => ['auth', 'judge-role:2'],
    'as' => 'organise::activity::'
], function () {
    Route::get('/', 'ActivityController@index')->name('list');
    Route::get('/new', 'ActivityController@edit')->name('create');
    Route::post('/new', 'ActivityController@create')->name('store');
        
    Route::group([
        'prefix' => '/{activity}',
        'middleware' => 'exist-organise-activity'
    ], function () {
        Route::get('/info', 'ActivityController@info')->name('info');
        Route::get('/preview', 'ActivityController@preview')->name('preview');
        Route::get('/edit', 'ActivityController@edit')->name('modify');
        Route::put('/update', 'ActivityController@update')->name('update');
        Route::put('/publish', 'ActivityController@publish')->name('publish');
        Route::put('/launch', 'ActivityController@launch')->name('launch');
        Route::put('/discontinue', 'ActivityController@discontinue')->name('discontinue');
        Route::delete('/delete', 'ActivityController@delete')->name('delete');

        Route::group([
            'prefix' => '/register-certificates',
            'as' => 'register-certificate::'
        ], function () {
            Route::get('/scan', 'ActivityRegisterController@scan')->name('scan');

            Route::group([
                'prefix' => '/{certificate}',
                'middleware' => 'exist-register-certificate'
            ], function () {
                Route::put('/use', 'ActivityRegisterController@use')->name('use');
                Route::get('/info', 'ActivityRegisterController@info')->name('info');
            });
        });

        Route::group([
            'prefix' => '/applicants',
            'as' => 'applicant::'
        ], function () {
            Route::get('/', 'ActivityApplicantController@index')->name('list');
        });
        

        Route::group([
            'prefix' => '/messages',
            'as' => 'message::'
        ], function () {
            Route::get('/', 'ActivityMessageController@index')->name('list');
            Route::get('/new', 'ActivityMessageController@edit')->name('create');
            Route::post('/new', 'ActivityMessageController@save')->name('store');

            Route::group([
                'prefix' => '/{message}',
                'middleware' => 'exist-message'
            ], function () {
                Route::get('/edit', 'ActivityMessageController@edit')->name('modify');
                Route::put('/update', 'ActivityMessageController@save')->name('update');
                Route::put('/cancel', 'ActivityMessageController@cancel')->name('cancel');
                Route::delete('/delete', 'ActivityMessageController@delete')->name('delete');
            });
        });

        Route::group([
            'prefix' => '/logs',
            'as' => 'log::'
        ], function () {
            Route::get('/', 'ActivityLogController@index')->name('list');
            Route::get('/new', 'ActivityLogController@edit')->name('create');
            Route::post('/new', 'ActivityLogController@save')->name('store');

            Route::group([
                'prefix' => '/{log}',
                'middleware' => 'exist-log'
            ], function () {
                Route::get('/edit', 'ActivityLogController@edit')->name('modify');
                Route::put('/update', 'ActivityLogController@save')->name('update');
                Route::put('/publish', 'ActivityLogController@publish')->name('publish');
                Route::put('/cancel-publish', 'ActivityLogController@cancelPublish')->name('cancel-publish');
                Route::delete('/delete', 'ActivityLogController@delete')->name('delete');
            });
        });
    });
});

Route::group([
    'prefix' => '/sign-up/{activity}',
    'namespace' => 'SignUp',
    'middleware' => ['exist-activity', 'judge-was-launched'],
    'as' => 'sign-up::'
], function () {
    Route::group([
        'prefix' => '/apply',
        'as' => 'apply::'
    ], function () {
        Route::get('/', 'StepController@showApply')
            ->middleware('judge-during-apply-period')
            ->name('new');
        Route::get('/{record}', 'StepController@showApply')
            ->middleware(['judge-during-apply-period', 'exist-participate-record'])
            ->name('edit');

        Route::post('/', 'ActionController@postOrder')->name('store');
        Route::put('/{record}', 'ActionController@putOrder')
            ->middleware('exist-participate-record')
            ->name('update');
    });

    Route::group([
        'prefix' => '/payment',
        'as' => 'payment::'
    ], function () {
        Route::get('/', 'StepController@showPayment')
            ->middleware('check-session-existed:serial_number')
            ->name('confirm');

        Route::post('/', 'ActionController@postTransaction')
            ->middleware('check-session-existed:serial_number')
            ->name('deal');
        Route::post('/deal-info', 'ActionController@savePaymentInfo')->name('deal-info');
        Route::post('/deal-result', 'ActionController@savePaymentResult')->name('deal-result');
        Route::post('/deal-result-delay', 'ActionController@savePaymentResultDelay')->name('deal-result-delay');
    });
    
    Route::get('/confirm', 'StepController@showConfirm')
        ->middleware('check-session-existed:serial_number')
        ->name('confirm');
});
