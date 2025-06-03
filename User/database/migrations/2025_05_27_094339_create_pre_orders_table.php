<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('pre_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('product');
            $table->integer('quantity');
            $table->string('address', 500);
            $table->string('phone_number', 15);
            $table->string('email');
            $table->text('additional_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pre_orders');
    }
}
