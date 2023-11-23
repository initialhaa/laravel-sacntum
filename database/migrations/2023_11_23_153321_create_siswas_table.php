<?php

use App\Models\Siswa;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nim')->unique();
            $table->string('email');
            $table->timestamps();
        });
        // $faker = \Faker\Factory::create();
        // for($i=0;$i<10;$i++)
        // {
        //     Siswa::create(
        //         [
        //             'name' => $faker->sentence(25, true),
        //             'nim' => $faker->sentence(12, true),
        //             'email' => $faker->sentence(5, true)
        //         ]
        //         );
        // }
    }

    


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
