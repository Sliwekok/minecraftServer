<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Servers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('online'); // statusy mogą być online, offline, banned, wip
            $table->string('owner');
            $table->string('ip')->default('localhost');
            $table->string('port')->default('25565');
            $table->string('name');
            $table->string('version');
            $table->string('description')->nullable();
            $table->string('motd')->nullable();
            $table->string('maxPlayers')->default('8');
            $table->string('difficulty')->default('medium');
            $table->string('seed')->nullable();
            $table->string('nether')->default('true');
            $table->string('hardcore')->default('false');
            $table->string('pvp')->default('true');
            $table->string('premium')->default('false');
            $table->string('autokick')->default('5');
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
        Schema::dropIfExists('servers');
    }
}