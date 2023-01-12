<?php

namespace App\Models\Admin;

use App\Enums\Admin\Company\CompanyPopulationEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id', 'deleted_at'];

    /**
     * Get the ads for the company.
     */
    public function ads()
    {
        return $this->hasMany(Ad::class);
    }
    /**
     * Get the company's crowd.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     * https://codedine.com/laravel-accessors-mutators-example/#full-example-code
     * https://medium.com/the-new-way-of-defining-eloquent-accessors-and/the-new-way-of-defining-eloquent-accessors-and-mutators-in-laravel-9-x-12897269d371
     */
    public function officePopulation(): string
    {
        return CompanyPopulationEnum::tryFrom($this->office_population)->toString();
    }
}
