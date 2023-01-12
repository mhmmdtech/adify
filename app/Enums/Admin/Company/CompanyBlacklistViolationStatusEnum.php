<?php

namespace App\Enums\Admin\Company;
// https://www.itsolutionstuff.com/post/how-to-use-enum-in-laravelexample.html
// https://enversanli.medium.com/how-to-use-enums-with-laravel-9-d18f1ee35b56
// https://www.youtube.com/watch?v=uEBHJVK-Ibg
enum CompanyBlacklistViolationStatusEnum: int
{
    case Pending = 1;
    case Processing = 2;
    case Confirmed = 3;

    public function toString(): string
    {
        return match ($this) {
            self::Pending => "در انتظار بررسی",
            self::Processing => "در حال بررسی",
            self::Confirmed => "تخلف تائید شده",
        };
    }
}
