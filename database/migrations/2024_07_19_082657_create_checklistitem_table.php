<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChecklistitemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checklistitem', function (Blueprint $table) {
            $table->id('checklistItemId');
            $table->unsignedBigInteger('checklistId');
            $table->string('itemName');
            $table->boolean('status')->default(false);
            $table->timestamps();

            $table->foreign('checklistId')->references('checklistId')->on('checklist')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checklistitem');
    }
}
