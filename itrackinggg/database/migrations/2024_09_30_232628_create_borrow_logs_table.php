<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorrowLogsTable extends Migration
{
    public function up()
    {
        Schema::create('borrow_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipment_id')->constrained('equipments')->onDelete('cascade'); // Make sure table name matches
            $table->string('name');
            $table->string('office');
            $table->string('no');
            $table->date('date_borrowed');
            $table->date('date_returned');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('borrow_logs');
    }
}
