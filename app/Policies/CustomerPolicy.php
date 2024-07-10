<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Customer $customer)
    {
        return $user->id === $customer->user_id;
    }

    public function delete(User $user, Customer $customer)
    {
        return $user->id === $customer->user_id;
    }
}