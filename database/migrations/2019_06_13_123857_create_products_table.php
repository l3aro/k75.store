<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('product_code', 50)->nullable();
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->decimal('price', 24, 0)->nullable()->default(0);
            $table->boolean('is_highlight')->nullable();
            $table->integer('quantity')->unsigned()->nullable()->default(0);
            $table->string('avatar')->nullable();
            $table->string('description')->nullable();
            $table->text('detail')->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->bigInteger('updated_by')->unsigned()->nullable();
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
        Schema::dropIfExists('products');
    }
}
