<?php

namespace App\Enums\Admin\Ad;
// https://www.itsolutionstuff.com/post/how-to-use-enum-in-laravelexample.html
// https://enversanli.medium.com/how-to-use-enums-with-laravel-9-d18f1ee35b56
// https://www.youtube.com/watch?v=uEBHJVK-Ibg
enum AdSeniorityEnum: int
{
    case Unknown = 1;
    case Intern = 2;
    case Junior = 3;
    case MidLevel = 4;
    case Senior = 5;

    public function toString(): string
    {
        return match ($this) {
            self::Unknown => "نامشخص",
            self::Intern => "کارآموز",
            self::Junior => "تازه‌کار",
            self::MidLevel => "میانی",
            self::Senior => "ارشد",
        };
    }
}
