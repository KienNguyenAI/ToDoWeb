<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration
{
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userId');
            $table->string('name');
            $table->string('color')->nullable();
            $table->timestamps();

            // Khóa ngoại
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('tags', function (Blueprint $table) {
            // Xóa khóa ngoại và cột listId
            $table->dropForeign(['listId']);
            $table->dropColumn('listId');
        });
    }
}
