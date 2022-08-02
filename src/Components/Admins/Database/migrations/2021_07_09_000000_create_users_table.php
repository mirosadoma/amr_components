<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('gender')->nullable()->default("male");// male | female
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id')->references('id')->on('cities')->onUpdate('cascade')->onDelete('cascade');
            $table->string('image')->nullable();
            $table->string('cover')->nullable();
            $table->tinyInteger('is_active')->default(0);
            $table->string('verification_code')->nullable();
            $table->string('api_token')->nullable();
            $table->string('type')->default('client');
            $table->text('description')->nullable();
            $table->bigInteger('points')->default(0);
            $table->bigInteger('parent_id')->default(0);
            $table->tinyInteger('finished_cource')->default(0);
            $table->integer('code')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->string('fcm_token')->nullable();
            $table->tinyInteger('is_dark')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('users');
        Schema::dropIfExists('qualifications');
        Schema::dropIfExists('programs');
        Schema::dropIfExists('qualifications_translations');
        Schema::dropIfExists('programs_translations');
        Schema::dropIfExists('programs_images');
        \DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
