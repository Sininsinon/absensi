<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // database/migrations/xxxx_xx_xx_xxxxxx_create_divisions_table.php

public function up()
{
    Schema::create('divisions', function (Blueprint $table) {
        $table->id();
        $table->string('name_divisions');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('divisions');
}

};
