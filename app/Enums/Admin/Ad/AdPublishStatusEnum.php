<?php

namespace App\Enums\Admin\Ad;
// https://www.itsolutionstuff.com/post/how-to-use-enum-in-laravelexample.html
// https://enversanli.medium.com/how-to-use-enums-with-laravel-9-d18f1ee35b56
// https://www.youtube.com/watch?v=uEBHJVK-Ibg
enum AdPublishStatusEnum: int
{
    case Drafted = 1;
    case Published = 2;

    public function toString(): string
    {
        return match ($this) {
            self::Drafted => "پیش‌نویس",
            self::Published => "انتشار یافته",
        };
    }
}
