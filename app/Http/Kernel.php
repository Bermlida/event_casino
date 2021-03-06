<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
        ],

        'api' => [
            'throttle:60,1',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'can' => \Illuminate\Foundation\Http\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,

        'check-session-existed' => \App\Http\Middleware\CheckSessionExisted::class,
        'exist-activity' => \App\Http\Middleware\ExistResource\Activity::class,
        'exist-log' => \App\Http\Middleware\ExistResource\Log::class,
        'exist-message' => \App\Http\Middleware\ExistResource\Message::class,
        'exist-organizer' => \App\Http\Middleware\ExistResource\Organizer::class,
        'exist-organise-activity' => \App\Http\Middleware\ExistResource\OrganiseActivity::class,
        'exist-participate-record' => \App\Http\Middleware\ExistResource\ParticipateRecord::class,
        'exist-register-certificate' => \App\Http\Middleware\ExistResource\RegisterCertificate::class,
        'judge-during-apply-period' => \App\Http\Middleware\JudgeDuringApplyPeriod::class,
        'judge-role' => \App\Http\Middleware\JudgeRole::class,
        'judge-was-launched' => \App\Http\Middleware\JudgeWasLaunched::class,
        'verify-social-provider' => \App\Http\Middleware\VerifySocialProvider::class,
    ];
}
