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
        Schema::create('enhancement_resource_combinations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('equipment_type_id');
            $table->unsignedInteger('applied_level');
            $table->unsignedBigInteger('enhancement_resource_id');
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
        Schema::dropIfExists('equipment_resource_combinations');
    }
};
