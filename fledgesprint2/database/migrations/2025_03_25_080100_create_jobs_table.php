<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category'); // IT, Management, etc.
            $table->string('job_type'); // in-office, remote
            $table->string('working_hours'); // morning, evening, night
            $table->string('location');
            $table->string('pay_rate'); // Weekly, Monthly, Hourly
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jobs');
    }
};
