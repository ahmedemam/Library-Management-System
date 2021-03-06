<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('description');
            $table->string('author');
            $table->string('image')->nullable();
            $table->decimal('copiesNumber');
            $table->float('leaseFee');
            $table->float('rate')->nullable();
            $table->unsignedBigInteger('category_id');
         
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('books', function (Blueprint $table) {
           
           
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
