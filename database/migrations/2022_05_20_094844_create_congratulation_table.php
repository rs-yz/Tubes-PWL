<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCongratulationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('congratulation', function (Blueprint $table) {
            $table->id();
            $table->char('nama');
            $table->char('alamat')->nullable();
            $table->char('pesan');
            $table->foreignId('invitation_id')->constrained('invitation');
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
        Schema::dropIfExists('congratulation');
    }
}
