<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateLocationsTable
 */
class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        // The fields email, phone_number are not required in here.
        // Because they will taken from the coordinator data.

        Schema::create('locations', static function (Blueprint $table): void {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('coordinator_id');
            $table->string('name');
            $table->string('address');
            $table->string('postal');
            $table->string('city');
            $table->timestamps();

            // Foreign keys and indexes.
            $table->foreign('coordinator_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
}
