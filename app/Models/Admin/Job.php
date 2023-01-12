<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Job extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['user_id', 'job_title', "requirements"];
    /**
     * Get the ads for the job.
     */
    public function ads()
    {
        return $this->hasMany(Ad::class);
    }

    /**
     * Get the jobs's requirement.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     * https://codedine.com/laravel-accessors-mutators-example/#full-example-code
     * https://medium.com/the-new-way-of-defining-eloquent-accessors-and/the-new-way-of-defining-eloquent-accessors-and-mutators-in-laravel-9-x-12897269d371
     */
    // protected function requirements(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => $value === null ? "ندارد" : $value,
    //     );
    // }
}
