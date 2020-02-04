<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactTable extends Migration 
{
    /**
     * Run the migrations.
     */
    public function up(): void 
    {
        Schema::create('contact', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('profile_image');
            $table->timestamps();
        });
        Schema::create('contact_tag', function (Blueprint $table) {
            $table->integer('contact_id')->unsigned()->index();
            $table->foreign('contact_id')->references('id')->on('contact')->onDelete('cascade');
            $table->integer('tag_id')->unsigned()->index();
            $table->foreign('tag_id')->references('id')->on('tag')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void 
    {
        Schema::dropIfExists('contact');
        Schema::dropIfExists('contact_tag');
    }

}