<?php

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Container\BindingResolutionException;

/**
 *
 * @return Authenticatable|App\Models\User|null
 * @throws BindingResolutionException
 */
function current_user()
{
    return auth()->user();
}
