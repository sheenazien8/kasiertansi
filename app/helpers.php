<?php
if (!function_exists('auth_cache')) {
    function auth_cache()
    {
        return Illuminate\Support\Facades\Cache::get('owner-cache');
    }
}
