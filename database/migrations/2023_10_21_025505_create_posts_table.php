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
            $table->id()->autoIncrement();
            $table->string('title')->comment('หัวข้อโพส');
            $table->text('body')->comment('เนื้อหาโพส');
            $table->string('price')->comment('ราคา');
            $table->string('amount')->comment('จํานวน');
            $table->string('property_name')->comment('ชื่ออสังหา');
            $table->integer('category_id')->comment('หมวดหมู่โพส')->nullable();
            $table->integer('image_id')->comment('ไอดีรูปโพส')->nullable();
            $table->integer('sale_type_id')->comment('ไอดีประเภทการขาย');
            $table->integer('property_type_id')->comment('ไอดีประเภทอสังหา');
            $table->integer('user_id')->comment('ไอดีผู้โพส');
            $table->string('delete_post')->comment('สถานะการลบโพส');
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
