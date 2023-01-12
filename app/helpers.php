<?php

// https://laravel-news.com/creating-helpers
// https://readerstacks.com/create-custom-helper-functions-in-laravel-8/
// https://stackoverflow.com/questions/28290332/how-to-create-custom-helper-functions-in-laravel


if (!function_exists('georgianToJalaliDate')) {
    function georgianToJalaliDate($date)
    {
        // https://vrgl.ir/tyfGL
        // https://pourbahrami.medium.com/a-simple-way-to-work-with-jalali-date-in-laravel-using-carbon-and-jdf-php-42379c7c49e2
        // https://stackoverflow.com/a/63760776/12580861
        return \Morilog\Jalali\Jalalian::fromCarbon($date)->format('%A, %d %B %Y');
    }
}
if (!function_exists('handleLongString')) {
    function handleLongString($string, $start, $end,  $extra = "...")
    {
        return strlen($string) > $end ?  substr($string, $start, $end) . $extra : $string;
    }
}
if (!function_exists('ConcatAndConvertArrayToString')) {
    function ConcatAndConvertStringToString($initialString, $initialDelimiter, $finalDelimiter)
    {
        return implode($finalDelimiter, explode($initialDelimiter, $initialString));
    }
}
