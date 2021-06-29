<?php

use Topdot\Core\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Topdot\Core\Models\Role;

function setting($key, $default = null, $userId = null, $returnModel = false)
{
    $userId = $userId ? $userId : Auth::id();

    $setting = Setting::byUser($userId)->byKey(strtoupper($key))->first();

    if ($returnModel) {
        return $setting ? $setting : new Setting();
    }

    if (!$setting || !$setting->value) {
        return $default;
    }

    return $setting->value;
}

function saveSetting($key, $value, $userId = null)
{
    $userId = $userId ? $userId : Auth::id();
    return Setting::saveByKey($key, $value, $userId);
}

function getGeneralSetting($key, $default = null, $model = false)
{
    return \setting($key, $default, Setting::SITE_SETTING_ID, $model);
}

function saveGeneralSetting($key, $value)
{
    return saveSetting($key, $value, Setting::SITE_SETTING_ID);
}

function apiResponse($success = true, $message = '', $data = [], $code = 200)
{
    return response()->json([
        'success' => $success,
        'message' => $message,
        'data' => $data
    ], $code);
}


function applyValidationRuleto(array $inputs, $rule): array
{
    $rules = [];

    foreach ($inputs as $key => $value) {
        $rules[$key] = $rule;
    }

    return $rules;
}

function isActive($route, $activeClass = 'active')
{
    if (is_array($route)) {
        foreach ($route as $r) {
            if (request()->routeIs($r)) {
                return $activeClass;
            }
        }

        return '';
    }

    return request()->routeIs($route) ? $activeClass : '';
}


function hasRoute($route)
{
    return Route::has($route) && hasPermissionTo($route);
}

function hasPermissionTo($route)
{
    return (Auth::user()->hasRole([Role::ROLE_SUPER_ADMIN]) || Auth::user()->hasPermissionTo($route));
}

function core_root($path='')
{
    return (__DIR__."/../../".$path);
}