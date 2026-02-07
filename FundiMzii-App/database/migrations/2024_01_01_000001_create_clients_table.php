<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone_number')->unique();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();
            $table->index('name');
            $table->index('phone_number');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
?>
