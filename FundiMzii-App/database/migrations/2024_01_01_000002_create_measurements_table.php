<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('measurements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->decimal('chest', 8, 2)->nullable();
            $table->decimal('waist', 8, 2)->nullable();
            $table->decimal('hip', 8, 2)->nullable();
            $table->decimal('length', 8, 2)->nullable();
            $table->decimal('sleeve_length', 8, 2)->nullable();
            $table->decimal('shoulder_width', 8, 2)->nullable();
            $table->decimal('inseam', 8, 2)->nullable();
            $table->longText('notes')->nullable();
            $table->date('measurement_date');
            $table->string('photo_path')->nullable();
            $table->timestamps();
            $table->index('client_id');
            $table->index('measurement_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('measurements');
    }
};
?>
