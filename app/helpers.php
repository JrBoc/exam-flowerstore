<?php

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Container\BindingResolutionException;

/**
 * Returns current logged user
 *
 * @return App\Models\User|null
 * @throws BindingResolutionException
 */
function current_user()
{
    return auth()->user();
}
