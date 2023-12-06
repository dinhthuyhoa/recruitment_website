<?php
use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('package_payment_id')->nullable();
            $table->string('checkout_type');
            $table->longText('post_content')->nullable();
            $table->date('checkout_date')->default(Carbon::now());
            $table->date('checkout_expired_time')->default(Carbon::now());
            $table->integer('value_checkout')->default(0);
            $table->string('checkout_status')->default('Paid');
            // $table->dropTimestamps();
            $table->foreign('package_payment_id')->references('id')->on('package_payments');
            $table->foreign('user_id')
                ->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('checkouts');
    }
};
