<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateItemsTable
 */
class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('items', static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('item_code')->nullable(); // Because the item code will be generated when the item is stored
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('location_id')->nullable();
            $table->string('name');
            $table->integer('quantity');
            $table->text('extra_information')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('category_id')->references('id')
                ->on('categories')->onDelete('set null');

            $table->foreign('location_id')->references('id')
                ->on('locations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
}
