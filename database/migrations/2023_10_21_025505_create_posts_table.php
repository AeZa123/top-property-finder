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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('หัวข้อโพส');
            $table->text('body')->comment('เนื้อหาโพส');
            $table->string('price')->comment('ราคา');
            $table->string('amount')->comment('จํานวน');
            $table->string('property_name')->comment('ชื่ออสังหา');
            $table->integer('category_id')->comment('หมวดหมู่โพส')->nullable();
            $table->string('image_id')->comment('รูปโพส')->nullable();
            $table->integer('user_id')->comment('ผู้โพส');
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
        Schema::dropIfExists('posts');
    }
};
