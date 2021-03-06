<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table-> foreign("student_id")-> references("id")-> on("users")-> onDelete("cascade")->onUpdate("cascade");
            $table->integer('school_id')->unsigned();
            $table-> foreign("school_id")-> references("id")-> on("schools")-> onDelete("cascade")->onUpdate("cascade");
            
            $table->unique(['student_id', 'school_id']); 
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
        Schema::dropIfExists('school_user');
    }
}
