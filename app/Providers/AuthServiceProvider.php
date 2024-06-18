<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Customer;
use App\Policies\UserPolicy;
use App\Policies\CustomerPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        User::class => UserPolicy::class,
        Customer::class => CustomerPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}