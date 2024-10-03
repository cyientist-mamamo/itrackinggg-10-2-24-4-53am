<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserLogsTable extends Migration
{
    public function up()
    {
        Schema::create('user_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Assuming users table exists
            $table->string('action'); // e.g., 'added', 'deleted', 'edited', 'borrowed'
            $table->string('model'); // e.g., 'Equipment', 'Item'
            $table->unsignedBigInteger('model_id'); // ID of the affected model
            $table->string('category')->nullable(); // e.g., 'Personnel Equipment', 'Item'
            $table->text('details')->nullable(); // Additional details (if needed)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_logs');
    }
}
