<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\evento;
use Illuminate\Support\Facades\Hash;

class eventos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

     $user = User::create([
        'name' => 'Usuario Ejemplo',
        'email' => 'ejemplo@ejemplo.com',
        'password' => Hash::make('pass123'),
    ]);


    $evento = evento::create([
        'user_id' => $user->id,  
        'nombreEvento' => 'Fiesta de Fin de Año',
        'descripcion' => 'Una fiesta para celebrar el fin de año',
        'fechaInicio' => now()->addDays(2), 
        'fechaFin' => now()->addDays(2)->addHours(4), 
        'color' => '#ff5733',
        'allDay' => false,  
        'latitude' => 30.5130, 
        'longitude' => 59.2600, 
    ]);
    }
}
