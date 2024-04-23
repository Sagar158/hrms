<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('employee_code')->unique();
            $table->integer('department_id');
            $table->integer('designation_id');
            $table->integer('user_type_id')->default(3);
            $table->enum('gender',['male','female','other'])->default('male');
            $table->enum('blood_group',['o+','o-','a+','a-','b+','b-','ab+'])->default('b+');
            $table->string('nid');
            $table->string('contact_number')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('date_of_joining')->nullable();
            $table->string('date_of_leaving')->nullable();
            $table->string('username');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('image')->nullable();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
