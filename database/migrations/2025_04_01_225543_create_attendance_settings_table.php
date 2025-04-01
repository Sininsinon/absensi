<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   // database/migrations/xxxx_xx_xx_xxxxxx_create_attendance_settings_table.php

public function up()
{
    Schema::create('attendance_settings', function (Blueprint $table) {
        $table->id();
        $table->time('start_time')->default('08:00:00');
        $table->time('check_in_deadline')->default('12:00:00');
        $table->time('end_time')->default('15:00:00');
        $table->time('check_out_deadline')->default('21:00:00');
        $table->integer('late_limit')->default(60);
        $table->json('holidays');  // Menggunakan json dan default nilai kosong
        $table->json('holiday_days');  // Menggunakan json dan default hari Minggu
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('attendance_settings');
}

};
