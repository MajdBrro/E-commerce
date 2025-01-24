<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllProductsRelatedTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()  
    {  
        // Create the products table  
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->decimal('price', 18, 4)->unsigned()->nullable();
            $table->decimal('special_price', 18, 4)->unsigned()->nullable();
            $table->string('special_price_type')->nullable();
            $table->date('special_price_start')->nullable();
            $table->date('special_price_end')->nullable();
            $table->decimal('selling_price', 18, 4)->unsigned()->nullable();
            $table->string('sku')->nullable();
            $table->boolean('manage_stock')->nullable();
            $table->integer('qty')->nullable();
            $table->boolean('in_stock')->nullable();
            $table->integer('viewed')->unsigned()->default(0);
            $table->boolean('is_active');
            $table->integer('brand_id')->unsigned()->nullable();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->timestamps();
        }); 

        // Create the product_categories table  
        Schema::create('product_categories', function (Blueprint $table) {
            $table->integer('product_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->primary(['product_id', 'category_id']);
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });  

        // Create the product_tags table  
        Schema::create('product_tags', function (Blueprint $table) {
            $table->integer('product_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->primary(['product_id', 'tag_id']);
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });  

        // Create the product_images table  
        Schema::create('product_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->string('photo');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->timestamps();
        });  

        // Create the product_translations table  
        Schema::create('product_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->string('locale');
            $table->string('name');
            $table->longText('description');
            $table->text('short_description')->nullable();
            $table->unique(['product_id', 'locale']);
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });  
    }  

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
