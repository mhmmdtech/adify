<?php

namespace App\Enums\Admin\Company;
// https://www.itsolutionstuff.com/post/how-to-use-enum-in-laravelexample.html
// https://enversanli.medium.com/how-to-use-enums-with-laravel-9-d18f1ee35b56
// https://www.youtube.com/watch?v=uEBHJVK-Ibg
enum CompanyPopulationEnum: int
{
    case Unknown = 1;
    case LessThan10People = 2;
    case Between10And100People = 3;
    case Between100And1000People = 4;
    case MoreThan1000People = 5;

    public function toString(): string
    {
        return match ($this) {
            self::Unknown => "نامشخص",
            self::LessThan10People => "کمتر از ۱۰ نفر",
            self::Between10And100People => "بین ۱۰ تا ۱۰۰ نفر",
            self::Between100And1000People => "بین ۱۰۰ تا ۱۰۰۰ نفر",
            self::MoreThan1000People => "بیش از ۱۰۰۰ نفر",
        };
    }
}
