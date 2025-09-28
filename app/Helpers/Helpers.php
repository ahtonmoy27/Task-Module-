<?php

use Carbon\Carbon;
use App\Utils\AppStatic;
use App\Utils\ResponseCode;
use Illuminate\Support\Str;
use Carbon\Traits\Localization;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Nwidart\Modules\Facades\Module;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use Lunaweb\RecaptchaV3\Facades\RecaptchaV3;
use Illuminate\Http\Exceptions\HttpResponseException;
/**
 * Beware of changes, Because it's using as API Error Response
 * */
// Pagination footer
if (!function_exists("paginationFooter")) {
    function paginationFooter($dataModel, $colspan)
    {
        return view('common.page-info-footer', ['dataModel' => $dataModel, 'colspan' => $colspan]);
    }
}

if (!function_exists("paginationFooterDiv")) {
    function paginationFooterDiv($dataModel)
    {
        return view('common.page-info-footer-div', ['dataModel' => $dataModel]);
    }
}

# Get Logged in User ID
if (!function_exists("isLoggedIn")) {
    function isLoggedIn()
    {
        return auth()->check();
    }
}

# Authorize User
if (!function_exists("user")) {
    function user()
    {
        return isLoggedIn() ? auth()->user() : null;
    }
}

if (!function_exists("responseCode")) {
    function responseCode()
    {
        return new ResponseCode();
    }
}
# Max Paginate No
if (!function_exists("maxPaginateNo")) {
    function maxPaginateNo($max = null)
    {
        // Max Paginate numbers override the default
        return request('perPage', appStatic()::PER_PAGE_DEFAULT);
    }
}

if (!function_exists('isFileExists')) {
    function isFileExists($file)
    {
        return file_exists(public_path($file));
    }
}

if (!function_exists("appStatic")) {
    function appStatic()
    {
        return new AppStatic();
    }
}