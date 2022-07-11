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

        /*
        CREATE TABLE cities (
            id BIGINT(8) UNSIGNED AUTO_INCREMENT,
            name_en VARCHAR(100) NOT NULL,
            name_ar VARCHAR(100) NOT NULL,
            active BOOLEAN default false NOT NULL,
            PRIMARY KEY(id)
            ); 
*/
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->String('name_en',100);
            $table->String('name_ar',100);
            $table->boolean('active')->default(false);
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
        Schema::dropIfExists('cities');
    }
};
