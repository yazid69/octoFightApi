<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSpotifyColumnsToRappersTable extends Migration
{
    public function up()
    {
        Schema::table('rappers', function (Blueprint $table) {
            // Ajoute la colonne id_spotify
            $table->string('id_spotify')->nullable();
            // Ajoute la colonne followers
            $table->integer('followers')->nullable();
            // Ajoute la colonne popularity
            $table->integer('popularity')->nullable();
        });
    }

    public function down()
    {
        Schema::table('rappers', function (Blueprint $table) {
            // Supprime les colonnes si la migration est annulée
            $table->dropColumn('id_spotify');
            $table->dropColumn('followers');
            $table->dropColumn('popularity');
        });
    }
}
