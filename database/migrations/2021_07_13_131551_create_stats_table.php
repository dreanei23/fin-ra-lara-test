<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stats', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->bigInteger('views')->default(0);
            $table->bigInteger('clicks')->default(0);
            $table->string('cost', 256)->default(0);
            $table->float('CPC', 100, 2)->default(0);
            $table->float('CPM', 100, 2)->default(0);
            $table->float('CTR', 100, 2)->default(0);
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
        Schema::dropIfExists('stats');
    }
}
