<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBreedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('breeds', function (Blueprint $table) {
            $table->bigIncrements('cat_id');
            $table->string('id');
            $table->string('name');
            $table->string('temperament')->nullable();
            $table->string('life_span')->nullable();
            $table->string('alt_names')->nullable();
            $table->string('wikipedia_url')->nullable();
            $table->string('origin')->nullable();
            $table->string('weight_imperial')->nullable();
            $table->string('weight_metric')->nullable();
            $table->string('country_code')->nullable();
            $table->string('country_codes')->nullable();
            $table->string('cfa_url')->nullable();
            $table->string('vetstreet_url')->nullable();
            $table->string('vcahospitals_url')->nullable();
            $table->string('description')->nullable();
            $table->tinyInteger('experimental')->nullable();
            $table->tinyInteger('cat_friendly')->nullable();
            $table->tinyInteger('hairless')->nullable();
            $table->tinyInteger('indoor')->nullable();
            $table->tinyInteger('lap')->nullable();
            $table->tinyInteger('natural')->nullable();
            $table->tinyInteger('rare')->nullable();
            $table->tinyInteger('rex')->nullable();
            $table->tinyInteger('suppress_tail')->nullable();
            $table->tinyInteger('short_legs')->nullable();
            $table->tinyInteger('hypoallergenic')->nullable();
            $table->tinyInteger('adaptability')->nullable();
            $table->tinyInteger('affection_level')->nullable();
            $table->tinyInteger('child_friendly')->nullable();
            $table->tinyInteger('dog_friendly')->nullable();
            $table->tinyInteger('energy_level')->nullable();
            $table->tinyInteger('grooming')->nullable();
            $table->tinyInteger('health_issues')->nullable();
            $table->tinyInteger('intelligence')->nullable();
            $table->tinyInteger('shedding_level')->nullable();
            $table->tinyInteger('social_needs')->nullable();
            $table->tinyInteger('stranger_friendly')->nullable();
            $table->tinyInteger('vocalisation')->nullable();
            $table->tinyInteger('suppressed_tail')->nullable();
            $table->unique('cat_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('breeds');
    }
}
