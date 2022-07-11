<?php

use App\Models\City;
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

        
       
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('email',50) ->unique();
            $table->string('password',100);
            $table->enum('gender',['M','F'])->default('M');
            $table->boolean('active')->default(true);
            $table->timestamps();

            // $table->foreignId('city_id');
            // // $table->foreignIdFor(City::class);
            // $table->foreign('citiy_id')->on('cities')->refernces('id');

            $table->foreignId('city_id')->constrained();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
};
