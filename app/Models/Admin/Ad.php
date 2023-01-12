<?php

namespace App\Models\Admin;

use App\Enums\Admin\Ad\AdSalaryEnum;
use App\Enums\Admin\Ad\AdSeniorityEnum;
use App\Enums\Admin\Ad\AdWorkTypeEnum;
use App\Enums\Admin\Ad\AdPublishStatusEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ad extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id', 'deleted_at'];

    /**
     * Get the company associated with the ad.
     */
    public function company()
    {
        return $this->belongsTo(company::class);
    }
    /**
     * Get the job associated with the ad.
     */
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    /**
     * Get the ad's seniority.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     * https://codedine.com/laravel-accessors-mutators-example/#full-example-code
     * https://medium.com/the-new-way-of-defining-eloquent-accessors-and/the-new-way-of-defining-eloquent-accessors-and-mutators-in-laravel-9-x-12897269d371
     */
    public function seniority(): string
    {
        return AdSeniorityEnum::tryFrom($this->seniority)->toString();
    }
    /**
     * Get the ad's salary.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     * https://codedine.com/laravel-accessors-mutators-example/#full-example-code
     * https://medium.com/the-new-way-of-defining-eloquent-accessors-and/the-new-way-of-defining-eloquent-accessors-and-mutators-in-laravel-9-x-12897269d371
     */
    public function salary(): string
    {
        return AdSalaryEnum::tryFrom($this->salary)->toString();
    }
    /**
     * Get the ad's work type.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     * https://codedine.com/laravel-accessors-mutators-example/#full-example-code
     * https://medium.com/the-new-way-of-defining-eloquent-accessors-and/the-new-way-of-defining-eloquent-accessors-and-mutators-in-laravel-9-x-12897269d371
     */
    public function workType(): string
    {
        return AdWorkTypeEnum::tryFrom($this->work_type)->toString();
    }
    /**
     * Get the ad's publish status.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     * https://codedine.com/laravel-accessors-mutators-example/#full-example-code
     * https://medium.com/the-new-way-of-defining-eloquent-accessors-and/the-new-way-of-defining-eloquent-accessors-and-mutators-in-laravel-9-x-12897269d371
     */
    public function publishStatus(): string
    {
        return AdPublishStatusEnum::tryFrom($this->publish_status)->toString();
    }
    /**
     * Get the ad's publish status.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     * https://codedine.com/laravel-accessors-mutators-example/#full-example-code
     * https://medium.com/the-new-way-of-defining-eloquent-accessors-and/the-new-way-of-defining-eloquent-accessors-and-mutators-in-laravel-9-x-12897269d371
     */
    // protected function requirements(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => implode(', ', explode(',', $value)),
    //     );
    // }
}
