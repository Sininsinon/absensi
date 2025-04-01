<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   // database/migrations/xxxx_xx_xx_xxxxxx_create_users_table.php

public function up()
{
    Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->string('password');
        $table->string('phone');
        $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
        $table->string('institution');
        $table->foreignId('division_id')->constrained()->onDelete('cascade');
        $table->string('profile_picture')->nullable();
        $table->enum('role', ['admin', 'intern'])->default('intern');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('users');
}

};
