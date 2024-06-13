<?php

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
        if (DB::table('users')->where('email', 'admin@example.com')->doesntExist()) {
            DB::table('users')->insert([
                'id' => 100,
                'name' => 'Admin Name',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('12345678a!'), 
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'admin' => 1
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('users')->where('email', 'admin@example.com')->delete();
    }
};
