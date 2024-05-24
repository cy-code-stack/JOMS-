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
        Schema::create('job_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('technician_id')->nullable();
            $table->string('job_type');
            $table->string('job_description');
            $table->string('address');
            $table->string('job_status'); 
            $table->string('remarks');

            $table->timestamp('created_at')->nullable();
            $table->timestamp('assigned_at')->nullable();
       
            $table->foreign('customer_id')
            ->references('id')->on('customers_lists')->onDelete('cascade');

            $table->foreign('technician_id')
            ->references('id')->on('technician_lists')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_requests');
    }
};
