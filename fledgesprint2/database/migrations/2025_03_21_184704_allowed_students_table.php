<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('allowed_students', function (Blueprint $table) {
        $table->id();
        $table->string('student_id')->unique();
        $table->string('first_name')->nullable();
        $table->string('last_name')->nullable();
        $table->boolean('is_registered')->default(false);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allowed_students');
    }
};
