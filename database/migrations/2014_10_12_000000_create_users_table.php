<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('city_id')->nullable()->index();
            $table->unsignedBigInteger('package_id')->nullable()->index();
            $table->date('subscribe_to')->nullable();
            $table->string('name');
            $table->string('country_code')->nullable();
            $table->string('mobile')->nullable();
            $table->string('whatsapp_mobile')->nullable();
            $table->text('trading_certification')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->string('type')->nullable();
            $table->string('status')->nullable();
            $table->boolean('is_dark')->default(false);
            $table->text('remember_token')->nullable();
            $table->text('device_token')->nullable();
            $table->date('block_date')->nullable()->comment('Block date until');
            $table->boolean('suspend')->default(false)->comment('0 is active - 1 is block');

            $table->timestamps();
        });

         DB::table('users')->insert([
             'name' => 'fadellabanie',
             'mobile' => '011315200',
             'email' => 'admin@admin.com',
             'password' => Hash::make('12345678'),
             'type' => 'admin',
             'created_at' => now(),
         ]);
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
}
