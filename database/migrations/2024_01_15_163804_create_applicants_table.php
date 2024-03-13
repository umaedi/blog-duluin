<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->uuid('id')->primary();
			$table->string('career_id', 36);
            $table->string('name');
            $table->string('email');
			$table->string('phone', 13)->nullable();
			$table->string('address', 225)->nullable();
			$table->date('birthday_date')->nullable();
			$table->enum('graduated', ['S2', 'S1', 'D4', 'D3', 'SMA'])->nullable();
			$table->enum('gender', ['pria', 'wanita'])->nullable();
			$table->string('document');
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
        Schema::dropIfExists('applicants');
    }
}
