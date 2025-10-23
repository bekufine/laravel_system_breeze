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
        Schema::create('old_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->integer('hotel_id'); 
            $table->integer('dep_id');   
            $table->integer('coor_id');
            $table->date('event_date');
            $table->time('work_start_time');
            $table->time('work_end_time');
            $table->string('workers_number');
            $table->string('venue_name');
            $table->time('event_start_time');
            $table->time('event_end_time');
            $table->string('position');
            $table->text('duty_content');
            $table->string('guests_number');
            $table->text('comments')->nullable();
            $table->timestamps();

            $table->foreign('order_id')
                  ->references('id')
                  ->on('orders')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('new_old_orders');
    }
};
