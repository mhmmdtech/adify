<?php

namespace App\Enums\Admin\Ad;
// https://www.itsolutionstuff.com/post/how-to-use-enum-in-laravelexample.html
// https://enversanli.medium.com/how-to-use-enums-with-laravel-9-d18f1ee35b56
// https://www.youtube.com/watch?v=uEBHJVK-Ibg
enum AdWorkTypeEnum: int
{
    case Unknown = 1;
    case InPerson = 2;
    case Remote = 3;
    case Hybrid = 4;

    public function toString(): string
    {
        return match ($this) {
            self::Unknown => "نامشخص",
            self::InPerson => "حضوری",
            self::Remote => "دورکاری",
            self::Hybrid => "حضوری/دورکاری",
        };
    }
}
