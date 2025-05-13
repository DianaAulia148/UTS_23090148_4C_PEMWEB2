<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // BIGINT, UNSIGNED, PRIMARY KEY, AUTO_INCREMENT
            $table->foreignId('customer_id') // BIGINT UNSIGNED NOT NULL
                  ->constrained('customers') // FOREIGN KEY
                  ->onDelete('cascade');

            $table->date('order_date'); // NOT NULL
            $table->decimal('total_amount', 10, 2)->default(0.00); // DECIMAL(10,2)
            $table->enum('status', ['pending', 'processing', 'completed', 'cancelled'])->default('pending'); // ENUM

            $table->timestamps(); // created_at, updated_at nullable by default
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
}
