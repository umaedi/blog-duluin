<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCareersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('careers', function (Blueprint $table) {
            $table->uuid('id')->primary();
			$table->string('position');
			$table->string('slug');
			$table->string('description')->nullable();
			$table->enum('type', ['penuh_waktu', 'purna_waktu', 'magang'])->nullable();
			$table->enum('experience', ['magang', 'tingkat_pemula', 'senior', 'eksekutif'])->nullable();
			$table->enum('status', ['publish', 'unpublish'])->nullable();
			$table->timestamp('expired_at')->nullable();
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
        Schema::dropIfExists('careers');
    }
}
