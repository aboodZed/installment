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
        Schema::create('restrictions', function (Blueprint $table) {
            $table->integer('price_id')->unsigned()->primary();
            $table->integer('installment_id')->unsigned();
            $table->boolean('is_credit');
            $table->boolean('paid');
            $table->date('pay_date');
            $table->timestamps();

            $table->foreign('price_id')->references('id')->on('prices')->onDelete('cascade');
            $table->foreign('installment_id')->references('id')->on('installments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restrictions');
    }
};
