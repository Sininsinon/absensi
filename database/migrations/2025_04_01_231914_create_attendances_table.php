<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
// database/migrations/xxxx_xx_xx_xxxxxx_create_attendances_table.php

public function up()
{
    Schema::create('attendances', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->date('date');
        $table->time('check_in')->nullable();
        $table->time('check_out')->nullable();
        $table->boolean('is_cancelled')->default(0);
        $table->enum('status', ['present', 'late', 'leave']);
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('attendances');
}
};
