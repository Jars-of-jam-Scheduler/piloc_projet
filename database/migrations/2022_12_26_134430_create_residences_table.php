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
        Schema::create('residences', function (Blueprint $table) {
            $table->id();

			$table->string('label')->nullable();
			$table->string('street')->nullable();
			$table->string('city')->nullable();
			$table->string('zipcode')->nullable();
			$table->double('lng')->nullable();
			$table->double('lat')->nullable();
			$table->unsignedDecimal('surface')->nullable();
			$table->unsignedDecimal('monthly_price')->nullable();
			$table->enum('status', ['rented', 'available'])->nullable();

            $table->timestamps();
			$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('residences');
    }
};
