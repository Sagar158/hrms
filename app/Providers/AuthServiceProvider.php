<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\UserType' => 'App\Policies\UserTypePolicy',
        'App\Models\Department' => 'App\Policies\DepartmentPolicy',
        'App\Models\Designation' => 'App\Policies\DesignationPolicy',
        'App\Models\Holidays' => 'App\Policies\HolidayPolicy',
        'App\Models\LeaveType' => 'App\Policies\LeaveTypePolicy',
        'App\Models\LeaveApplication' => 'App\Policies\LeaveApplicationPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        app()->setLocale(session('locale', config('app.fallback_locale')));
    }
}
