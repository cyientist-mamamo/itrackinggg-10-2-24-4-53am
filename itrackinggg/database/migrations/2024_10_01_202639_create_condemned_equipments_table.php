<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCondemnedEquipmentsTable extends Migration
{
    public function up()
    {
        Schema::create('condemned_equipments', function (Blueprint $table) {
            $table->id();
            $table->string('accounting_officer');
            $table->string('operating_unit_project');
            $table->string('pn_code');
            $table->foreignId('responsible_person_id')->constrained('personnels');
            $table->integer('quantity');
            $table->string('unit');
            $table->text('description');
            $table->date('date_acquired');
            $table->string('fund');
            $table->string('ppe_class')->nullable();
            $table->integer('est_useful_life')->nullable();
            $table->decimal('unit_price', 15, 2);
            $table->decimal('total_amount', 15, 2);
            $table->string('status')->default('condemned'); // Default to 'condemned'
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('condemned_equipments');
    }
}
