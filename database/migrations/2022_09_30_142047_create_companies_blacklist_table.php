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
        Schema::create('companies_blacklist', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->unsignedSmallInteger('company_id')->unique();
            $table->unsignedSmallInteger('user_id');
            $table->text('explanation');
            $table->tinyInteger('violation_status')->default(1)->comment("1 => Pending, 2=> Processing, 3=> Confirmed");
            $table->timestamps();
            $table->foreign('company_id')->references('id')->on('companies');
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
        Schema::dropIfExists('companies_blacklist');
    }
};
