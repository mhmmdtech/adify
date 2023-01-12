<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->unsignedSmallInteger('user_id');
            $table->unsignedSmallInteger('company_id');
            $table->unsignedSmallInteger('job_id');
            $table->tinyInteger('salary')->comment("1 => Unknown, 2 => Adaptive, 3 => LessThan10Million, 4 => Between10And20Million, 5 => Between20And50Million, 6 => MoreThan50Million");
            $table->tinyInteger('work_type')->comment("1 => Unknown, 2 => InPerson, 3 => Remote, 4 => Hybrid");
            $table->tinyInteger('seniority')->comment("1 => Unknown, 2 => Intern, 3 => Junior, 4 => MidLevel, 5 => Senior");
            $table->tinyInteger('publish_status')->default(1)->comment("1 => Drafted, 2=> Published");
            $table->string('ad_url', 255);
            $table->string('requirements');
            $table->text('explanation')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('job_id')->references('id')->on('jobs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads');
    }
};
