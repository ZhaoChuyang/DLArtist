<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table){
           $table->string('avatar_url')->default("/avatar/default_avatar.png");
           $table->string('phone');
           $table->date('birthday')->default("1901-01-01");;
           $table->boolean('gender')->default(0);
           $table->string('bio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table){
            $table->dropColumn('avatar_url');
            $table->dropColumn('phone');
            $table->dropColumn('birthday');
            $table->dropColumn('gender');
            $table->dropColumn('bio');
        });
    }
}
