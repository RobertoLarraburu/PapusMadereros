<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('/dashboard', 'DashboardController@show');
});
