<?php

namespace App\Helpers;

if (! function_exists('insert_subdomain')) {
    function insert_subdomain($url, $subdomain): string
    {

        str_contains($url, 'www') ?
            $url_parts = explode('://www',$url):
            $url_parts = explode('://',$url);

        return $url_parts[0].'://'.$subdomain.'.'.$url_parts[1];
    }
}
