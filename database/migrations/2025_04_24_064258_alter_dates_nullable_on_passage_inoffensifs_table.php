<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterDatesNullableOnPassageInoffensifsTable extends Migration
{
    public function up()
    {
        Schema::table('passage_inoffensifs', function (Blueprint $table) {
            // rend les deux champs date_entree et date_sortie acceptant NULL
            $table->date('date_entree')->nullable()->change();
            $table->date('date_sortie')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('passage_inoffensifs', function (Blueprint $table) {
            // remet les colonnes en NOT NULL
            $table->date('date_entree')->nullable(false)->change();
            $table->date('date_sortie')->nullable(false)->change();
        });
    }
}
