<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelephoneNumberTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('telephone_number', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number');
            $table->integer('contact_id')->unsigned()->index();
            $table->foreign('contact_id')->references('id')->on('contact')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('telephone_number');
    }

}
