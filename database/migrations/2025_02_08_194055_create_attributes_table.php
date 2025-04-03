<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributes', function (Blueprint $table) {  
            $table->increments('id');  
            $table->timestamps();  
        });

        Schema::create('attribute_translations', function (Blueprint $table) {  
            $table->increments('id');  
            $table->unsignedInteger('attribute_id'); // Use unsignedInteger for foreign keys  
            $table->string('locale');  
            $table->string('name');  
            $table->unique(['attribute_id', 'locale']);  
            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');  
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attributes');
    }
}
