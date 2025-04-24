<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('bilan_sars', function (Blueprint $table) {
            $table->text('type_d_intervention')->nullable()->change();
        });
    }
    public function down()
    {
        Schema::table('bilan_sars', function (Blueprint $table) {
            $table->string('type_d_intervention', 255)->nullable()->change();
        });
    }
    
};
