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
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \App\Http\Middleware\MustBeVerified::class,
        'must_own_site' => \App\Http\Middleware\MustOwnSite::class,
        'must_own_grader' => \App\Http\Middleware\MustOwnGrader::class,
        'must_own_grader_or_is_member' => \App\Http\Middleware\MustOwnGraderOrIsMember::class,
        'has_not_accepted' => \App\Http\Middleware\HasNotAccepted::class,
        'grader_has_not_accepted' => \App\Http\Middleware\GraderHasNotAccepted::class,
        'suggestion_made' => \App\Http\Middleware\SuggestionMade::class,
        'suggestion_not_made' => \App\Http\Middleware\SuggestionNotMade::class,
        'edit_and_suggest_self' => \App\Http\Middleware\EditAndSuggestSelf::class,
        'can_create_site' => \App\Http\Middleware\CanCreateSite::class,
        'is_member' => \App\Http\Middleware\IsMember::class,
        'is_grader_b' => \App\Http\Middleware\IsGraderB::class,
        'is_admin' => \App\Http\Middleware\IsAdmin::class,
        'is_ninja' => \App\Http\Middleware\IsNinja::class,
        'site_submissions_open' => \App\Http\Middleware\SiteSubmissionsOpen::class,
        'can_evaluate_a' => \App\Http\Middleware\CanEvaluateA::class,
        'must_own_evaluation_a' => \App\Http\Middleware\MustOwnEvaluationA::class,
        'phase_a' => \App\Http\Middleware\PhaseA::class,
        'can_evaluate_b' => \App\Http\Middleware\CanEvaluateB::class,
        'must_own_evaluation_b' => \App\Http\Middleware\MustOwnEvaluationB::class,
        'phase_b' => \App\Http\Middleware\PhaseB::class,
        'gradings_over' => \App\Http\Middleware\GradingsOver::class,
        'phase_c' => \App\Http\Middleware\PhaseC::class,
        'must_own_evaluation_c' => \App\Http\Middleware\MustOwnEvaluationC::class,
        'survey_ok' => \App\Http\Middleware\Survey_ok::class,       
        'can_see_certificates' => \App\Http\Middleware\CanSeeCertificates::class,       
    ];
}
