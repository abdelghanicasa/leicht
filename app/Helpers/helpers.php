<?php
use Illuminate\Support\Facades\DB;

if (!function_exists('getInstagramToken')) {
    function getInstagramToken()
    {
        return DB::table('settings')->where('key', 'instagram_token')->value('value');
    }
}
