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
        Schema::create('msgraph_messages', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('subject');
            $table->string('from_name');
            $table->string('from_email_address');
            $table->boolean('has_attachments')->default(false);
            $table->boolean('is_read')->default(false);
            $table->dateTime('received_date_time');
            $table->foreignId('responsible_id')->constrained('users')->restrictOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('msgraph_messages');
    }
};
