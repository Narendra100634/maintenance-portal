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
        Schema::create('event_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('request_type')->nullable();
            $table->string('req_email')->nullable();
            $table->string('req_name')->nullable();
            $table->string('req_phone')->nullable();
            $table->string('req_region')->nullable();
            $table->integer('resv_id')->nullable();
            $table->string('priority')->nullable();
            $table->string('subject')->nullable();
            $table->string('status')->nullable();
            $table->text('description')->nullable();
            $table->string('attachment')->nullable();
            $table->integer('rating')->nullable();
            $table->text('feedback')->nullable();
            $table->timestamp('tentative_date')->nullable();
            $table->timestamp('handover_date')->nullable();
            $table->timestamp('closer_date')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_requests');
    }
};
