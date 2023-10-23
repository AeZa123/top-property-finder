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
        Schema::create('users', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('fname')->comment('ชื่อ');
            $table->string('lname')->comment('นามสกุล');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('tel')->comment('เบอร์โทร')->nullable();
            $table->string('gender')->comment('เพศ')->nullable();
            $table->string('avatar')->comment('รูปโปรไฟล์')->nullable();
            $table->string('role')->comment('สิทธิ์การใช้งาน');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
