<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('setting_id'); //this column will only store positive integers or zero but will not store negative integers.
            $table->string('locale');
            $table->longText('value');
            $table->unique(['setting_id','locale','value']);
            $table->foreign('setting_id')->references('id')-> on('settings')->onUpdate('cascade');
            $table->timestamps();
            // onUpdate means: when the referenced column (id column in the settings table) is updated,
            // the changes will be cascaded to the foreign key column (setting_id column in the current table).
            // This means that if the value of the id column in the settings table is updated,
            // the corresponding rows in the setting_id column in the current table will also be updated to maintain referential integrity.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setting_translations');
    }
}
