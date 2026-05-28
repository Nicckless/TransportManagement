<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('warehouse_manager', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warehouse_id')
                    ->constrained('warehouses')
                    ->cascadeOnDelete();

            $table->foreignId('workers_id')
                    ->constrained('workers')
                    ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouse_manager');
    }
};
