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
        Schema::create('landlord_residence', function (Blueprint $table) {
            $table->id();

			$table->unsignedBigInteger('residence_id');
			$table->unsignedBigInteger('landlord_id');

			$table->foreign('residence_id')->references('id')->on('residences');
			$table->foreign('landlord_id')->references('id')->on('users');

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
        Schema::dropIfExists('landlord_residence');
    }
};
