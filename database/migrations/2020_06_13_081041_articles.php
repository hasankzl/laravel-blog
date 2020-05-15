<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Articles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('maker_id');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('architect_id');
            $table->unsignedBigInteger('padisah_id');
            $table->unsignedBigInteger('seyhulislam_id');
            $table->unsignedBigInteger('century_id');
            $table->unsignedBigInteger('country_id');
            $table->string('year');
            $table->string('fullAddress');
            $table->string('image');
            $table->longText('content');
            $table->integer('hit')->default(0);
            $table->integer('status')->default(1)->comment('0:pasif 1:aktif');
            $table->string('slug');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('category_id')
              ->references('id')
              ->on('categories');

            $table->foreign('maker_id')
            ->references('id')
            ->on('makers');

            $table->foreign('city_id')
            ->references('id')
            ->on('cities');

            $table->foreign('architect_id')
            ->references('id')
            ->on('architects');

            $table->foreign('century_id')
            ->references('id')
            ->on('centuries');

            $table->foreign('padisah_id')
            ->references('id')
            ->on('padisahs');

            $table->foreign('seyhulislam_id')
            ->references('id')
            ->on('seyhulislams');

            $table->foreign('country_id')
            ->references('id')
            ->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
