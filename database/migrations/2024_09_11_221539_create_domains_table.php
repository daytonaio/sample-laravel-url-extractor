<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domains', function (Blueprint $table) {
            $table->id();
            $table->string('domain_name')->unique();
            $table->string('scheme')->nullable(); // Scheme (e.g., http, https)
            $table->string('path')->nullable(); // Path (e.g., /some/path)
            $table->string('query')->nullable(); // Query (e.g., ?param=value)
            $table->string('fragment')->nullable(); // Fragment (e.g., #section1)
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
        Schema::dropIfExists('domains');
    }
}