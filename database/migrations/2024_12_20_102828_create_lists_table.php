<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListsTable extends Migration
{
    public function up()
    {
        Schema::create('lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userId');
            $table->string('name');
            $table->timestamps();

            // // Khóa ngoại
            // $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('lists');
    }
}
