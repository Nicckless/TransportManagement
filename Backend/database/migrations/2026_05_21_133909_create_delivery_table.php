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
        Schema::create('delivery', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->nullable()->constrained('trucks')->cascadeOnDelete();

            $table->string('pickup_location');
            $table->decimal('pickup_longitude',10,7);
            $table->decimal('pickup_latitude',10,7);

            $table->string('dropoff_location');
            $table->decimal('dropoff_longitude',10,7);
            $table->decimal('dropoff_latitude',10,7);

            $table->string('status');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery');
    }
};
