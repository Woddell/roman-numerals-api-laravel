<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRomanNumeralConversionsTable extends Migration
{
    public function up()
    {
        Schema::create('roman_numeral_conversions', function (Blueprint $table) {
            $table->id();
            $table->integer('input');
            $table->string('output');
            $table->timestamp('last_converted_at');
            $table->integer('total_conversions');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('roman_numeral_conversions');
    }
}
