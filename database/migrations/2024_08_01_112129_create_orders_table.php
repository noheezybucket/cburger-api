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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('burger_id')->unsigned();
            $table->string('client_firstname');
            $table->string('client_lastname');
            $table->string('client_phonenumber');
            $table->string('client_address');
            $table->enum('status', ['En cours', 'Terminer', 'Annuler', 'Payer'])->default('En cours');
            $table->boolean('payed')->default(false);

            $table->timestamps();

            $table->foreign('burger_id')->references('id')->on('burgers')->cascadeOnUpdate()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
