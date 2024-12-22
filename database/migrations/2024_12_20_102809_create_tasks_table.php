<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->json('subtask')->nullable();
            $table->timestamps(); // Tự động tạo createdAt và updatedAt
            $table->unsignedBigInteger('userId');
            $table->unsignedBigInteger('listId')->nullable();

            // Khóa ngoại
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('listId')->references('id')->on('lists')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
