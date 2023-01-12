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
        Schema::create('companies', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->unsignedSmallInteger('user_id');
            $table->string('company_name', 100);
            $table->tinyInteger('office_population')->default(1)->comment("1 => Unknown, 2 => LessThan10People, 3=> Between10And100People, 4=> Between100And1000People, 5=> MoreThan1000People");
            $table->string('company_url', 100);
            $table->string('central_office', 100);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
};
