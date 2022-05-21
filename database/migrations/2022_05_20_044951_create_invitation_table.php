<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap_pria');
            $table->string('nama_lengkap_wanita');
            $table->string('nama_panggilan_pria');
            $table->string('nama_panggilan_wanita');
            $table->string('nama_lengkap_ayah_pria');
            $table->string('nama_lengkap_ibu_pria');
            $table->string('nama_lengkap_ayah_wanita');
            $table->string('nama_lengkap_ibu_wanita');
            $table->integer('anak_ke_pria', false, true);
            $table->integer('anak_ke_wanita', false, true);
            $table->string('alamat_acara');
            $table->dateTime('tanggal_acara');
            $table->string('photo_pria');
            $table->string('photo_wanita');
            $table->foreignId('user_id')->constrained('users');
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
        Schema::dropIfExists('invitations');
    }
}
