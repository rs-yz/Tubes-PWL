<?php

namespace App\Providers;

use App\Models\congratulation;
use App\Models\invitation;
use App\Models\invitationTheme;
use App\Policies\CongratulationPolicy;
use App\Policies\InvitationPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        congratulation::class => CongratulationPolicy::class,
        invitation::class => InvitationPolicy::class,
        invitationTheme::class => invitationTheme::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
