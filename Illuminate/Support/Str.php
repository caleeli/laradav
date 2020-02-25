<?php

namespace Illuminate\Support;

class Str
{
    public static function slug($title, $separator = '-', $language = 'en')
    {
        $title = str_replace('@', ' at ', $title);
        $title = preg_replace('/\W+/', $separator, $title);
        return trim($title, $separator);
    }
}
