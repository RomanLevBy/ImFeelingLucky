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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('score')->nullable(false);
            $table->unsignedBigInteger('link_id');
            $table->string('result')->nullable(false);
            $table->float('win_amount', precision: 6)->nullable(false);
            $table->string('source')->nullable(false);
            $table->timestamps();

            $table->foreign('link_id')
                ->references('id')
                ->on('links')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
