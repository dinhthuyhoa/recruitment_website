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
        Schema::create('volunteer_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); // Khóa ngoại liên kết với bảng users
            $table->string('position');
            $table->string('organization_name');
            $table->string('location');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->text('achievements')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('volunteer_activities');
    }
};
