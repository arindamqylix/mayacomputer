<?php

use Illuminate\Support\Facades\DB;

if (!function_exists('site_settings')) {
    function site_settings() {
        return DB::table('site_settings')->where('id', 1)->first();
    }
}

if (!function_exists('breadcrumb_image')) {
    function breadcrumb_image() {
        $data = site_settings();
        return $data ? asset($data->breadcumb_image) : '';
    }
}
