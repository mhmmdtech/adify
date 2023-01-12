<?php

namespace App\Models\Admin;

use App\Enums\Admin\Company\CompanyBlacklistViolationStatusEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyBlacklist extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'companies_blacklist';

    protected $guarded = ['id'];

    /**
     * Get the companies associated with the blacklist companies.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    /**
     * Get the blacklist companies' publish status.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     * https://codedine.com/laravel-accessors-mutators-example/#full-example-code
     * https://medium.com/the-new-way-of-defining-eloquent-accessors-and/the-new-way-of-defining-eloquent-accessors-and-mutators-in-laravel-9-x-12897269d371
     */
    public function getviolationStatusLabelAttribute(): string
    {
        return CompanyBlacklistViolationStatusEnum::tryFrom($this->violation_status)->toString();
    }
}
