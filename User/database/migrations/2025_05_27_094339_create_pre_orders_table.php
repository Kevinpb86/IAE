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
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity');
            $table->text('notes')->nullable();
            $table->string('address');
            $table->string('phone');
            $table->string('email');
            $table->text('additional_notes')->nullable(); // Tambahkan kolom ini
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pre_orders');
    }
}