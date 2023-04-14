<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('page_view_logs', function (Blueprint $table) {
            $table->uuid('ulid')->primary();
            $table->string('url');
            $table->unsignedInteger('views_count')->default(0);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->uuid('page_view_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('page_view_id')->references('ulid')->on('page_views')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_view_logs');
    }
};
