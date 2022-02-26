<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogselectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogselects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('blog_id');
            $table->string('description')->nullable();
            $table->integer('money')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('deleted')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogselects');
    }
}
