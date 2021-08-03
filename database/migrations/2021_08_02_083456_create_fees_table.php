<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeesTable extends Migration
{
    /**
     * Run the migrations.
     * is the table to be used by accounts when clearing candidates
     * @return void
     */
    public function up()
    {
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->foreignId('user_id');
            $table->timestamp('cleared_at')->default(null)->nullable();
            $table->foreignId('clearer_id')->nullable();
            $table->foreignId('intake_id')->nullable();
            $table->boolean('is_cleared')->default(false);
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
        Schema::dropIfExists('fees');
    }
}
