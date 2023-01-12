<?php

namespace App\Enums\Admin\Ad;
// https://www.itsolutionstuff.com/post/how-to-use-enum-in-laravelexample.html
// https://enversanli.medium.com/how-to-use-enums-with-laravel-9-d18f1ee35b56
// https://www.youtube.com/watch?v=uEBHJVK-Ibg
enum AdSalaryEnum: int
{
    case Unknown = 1;
    case Adaptive = 2;
    case LessThan10Million = 3;
    case Between10And20Million = 4;
    case Between20And50Million = 5;
    case MoreThan50Million = 6;

    public function toString(): string
    {
        return match ($this) {
            self::Unknown => "نامشخص",
            self::Adaptive => "توافقی",
            self::LessThan10Million => "کمتر از ۱۰ میلیون تومان",
            self::Between10And20Million => "بین ۱۰ تا ۲۰ میلیون تومان",
            self::Between20And50Million => "بین ۲۰ تا ۵۰ میلیون تومان",
            self::MoreThan50Million => "بیش از ۵۰ میلیون تومان",
        };
    }
}
