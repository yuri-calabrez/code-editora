<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRestFieldsToBooks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->text('dedication');
            $table->text('description');
            $table->string('website')->nullable();
            $table->integer('percent_complete');
            $table->boolean('published')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->removeColumn('dedication');
            $table->removeColumn('description');
            $table->removeColumn('website');
            $table->removeColumn('percent_complete');
            $table->removeColumn('published');
        });
    }
}
