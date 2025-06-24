<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('questions_and_answers', function (Blueprint $table) {
        $table->unsignedBigInteger('user_id'); // thêm dòng này
$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->id();
        $table->text('question');
        $table->text('answer');
        $table->string('image_path');
        $table->timestamps(); // created_at, updated_at
});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions_and_answers');
    }
};
