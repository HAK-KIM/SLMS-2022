<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaverequests', function (Blueprint $table) {
            $table->id();
            $table->string('leave_type');
            $table->string('date_start');
            $table->string('end_date');
            // $table->dateTimeTz('date_start', $precision = 0);
            // $table->dateTimeTz('end_date', $precision = 0);
            $table->string('start_time');
            $table->string('end_time');
            $table->string('reason');
            $table->integer('duration');
            $table->boolean('status')->nullable();
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
        Schema::dropIfExists('leaverequests');
    }
};
