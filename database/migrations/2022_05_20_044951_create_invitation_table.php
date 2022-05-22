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
            $table->string('ref')->unique();
            $table->string('bride_name');
            $table->string('bride_nickname');
            $table->string('bride_father');
            $table->string('bride_mother');
            $table->integer('bride_child_nth');
            $table->string('bride_photo_url');
            $table->string('groom_name');
            $table->string('groom_nickname');
            $table->string('groom_father');
            $table->string('groom_mother');
            $table->integer('groom_child_nth');
            $table->string('groom_photo_url');
            $table->string('thumbnail_url')->nullable();
            $table->string('quote');
            $table->dateTime('main_event_datetime');
            $table->string('main_event_location');
            $table->boolean('bride_first')->default(true);
            $table->boolean('is_release')->default(false);
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
