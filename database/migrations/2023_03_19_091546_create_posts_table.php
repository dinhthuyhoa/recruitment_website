<?php

use App\Enums\PostCategory;
use Carbon\Carbon;
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
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('post_title')->nullable();
            $table->longText('post_content')->nullable();
            $table->date('post_date')->default(Carbon::now());
            $table->date('post_date_update')->default(Carbon::now());
            $table->integer('post_view')->default(0);
            $table->string('post_status')->default('draft');
            $table->string('post_type')->default(PostCategory::Recruitment);
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
