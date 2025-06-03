<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddServicioToCitasTable extends Migration
{
    public function up()
    {
        Schema::table('citas', function (Blueprint $table) {
            $table->string('servicio')->nullable()->after('hora');
        });
    }

    public function down()
    {
        Schema::table('citas', function (Blueprint $table) {
            $table->dropColumn('servicio');
        });
    }
}
