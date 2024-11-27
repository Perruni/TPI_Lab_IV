<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\evento;
use App\Models\User_roles;
use Illuminate\Support\Facades\Hash;
use App\Models\Categoria;

class eventos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

     $organizador = User::create([
        'name' => 'UsuarioOrganizador',
        'email' => 'organizador@ejemplo.com',
        'password' => Hash::make('organizador'),
        'rol' =>'organizador',
    ]);
    


    $invitado = User::create([
        'name' => 'UsuarioInvitado',
        'email' => 'invitado@ejemplo.com',
        'password' => Hash::make('invitado'),
        'rol' =>'invitado'
    ]);
    
    $categoria = Categoria::find(1);




    Evento::create([
        'user_id' => $organizador->id,
        'nombreEvento' => 'Coldplay en Buenos Aires',
        'descripcion' => 'Concierto en vivo de la banda Coldplay.',
        'fechaInicio' => '2024-12-10 20:00',
        'fechaFin' => '2024-12-10 23:00',
        'publico' => true,
        'direccion' => 'Estadio Monumental, Av. Figueroa Alcorta 7597, Buenos Aires, Argentina',
        'categoria_id' => $categoria->id,
        'latitude' => -34.5541,
        'longitude' => -58.4431,
    ]);


    Evento::create([
        'user_id' => $organizador->id,
        'nombreEvento' => 'La Renga en Rosario',
        'descripcion' => 'Concierto de la banda argentina de rock La Renga.',
        'fechaInicio' => '2024-12-20 22:00',
        'fechaFin' => '2024-12-20 01:00',
        'publico' => true,
        'direccion' => 'Estadio de Newells Old Boys, Bv. Oroño 3650, Rosario, Santa Fe, Argentina',
        'categoria_id' => $categoria->id,
        'latitude' => -32.9733,
        'longitude' => -60.6876,
    ]);

        Evento::create([
            'user_id' => $organizador->id,
            'nombreEvento' => 'Los Auténticos Decadentes en Mendoza',
            'descripcion' => 'Los Auténticos Decadentes se presentan en Mendoza con su espectáculo único.',
            'fechaInicio' => '2024-12-18 21:00',
            'fechaFin' => '2024-12-18 23:30',
            'publico' => true,
            'direccion' => 'Arena Maipú, Av. Jorge A. Calle 100, Mendoza, Argentina',
            'categoria_id' => $categoria->id,
            'latitude' => -32.9446,
            'longitude' => -68.8766,
        ]);

//Conferencias

    $categoria2 = Categoria::find(10);

    Evento::create([
        'user_id' => $organizador->id,
        'nombreEvento' => 'Conferencia de Cloud Computing',
        'descripcion' => 'Conferencia sobre tecnologías de la nube, con oradores internacionales y expertos en cloud.',
        'fechaInicio' => '2024-12-10 08:30',
        'fechaFin' => '2024-12-10 18:00',
        'publico' => true,
        'direccion' => 'Centro de Convenciones Córdoba, Av. Cardeñosa 2000, Córdoba, Argentina',
        'categoria_id' => $categoria2->id,
        'latitude' => -31.3980,
        'longitude' => -64.1839,
    ]);

    Evento::create([
        'user_id' => $organizador->id,
        'nombreEvento' => 'Conferencia sobre Inteligencia Artificial',
        'descripcion' => 'Conferencia dedicada a los avances y aplicaciones de la inteligencia artificial.',
        'fechaInicio' => '2024-12-12 10:00',
        'fechaFin' => '2024-12-12 16:00',
        'publico' => true,
        'direccion' => 'Auditorio Fundación Astengo, Sarmiento 2601, Rosario, Santa Fe, Argentina',
        'categoria_id' => $categoria2->id,
        'latitude' => -32.9529,
        'longitude' => -60.6603,
    ]);


    Evento::create([
        'user_id' => $organizador->id,
        'nombreEvento' => 'Conferencia de Blockchain',
        'descripcion' => 'Conferencia sobre el futuro de Blockchain, criptomonedas y tecnología descentralizada.',
        'fechaInicio' => '2024-12-18 09:00',
        'fechaFin' => '2024-12-18 18:00',
        'publico' => true,
        'direccion' => 'Buenos Aires Convention Center, Av. Figueroa Alcorta 8000, Buenos Aires, Argentina',
        'categoria_id' => $categoria2->id,
        'latitude' => -34.5520,
        'longitude' => -58.4412,
    ]);


    $categoria3 = Categoria::find(6);


    Evento::create([
        'user_id' => $organizador->id,
        'nombreEvento' => 'Superclásico Boca Juniors vs River Plate',
        'descripcion' => 'El partido más esperado del fútbol argentino, Boca Juniors vs River Plate en la Bombonera.',
        'fechaInicio' => '2024-12-06 20:00',
        'fechaFin' => '2024-12-06 22:00',
        'publico' => true,
        'direccion' => 'La Bombonera, Brandsen 805, Buenos Aires, Argentina',
        'categoria_id' => $categoria3->id,
        'latitude' => -34.6341,
        'longitude' => -58.3657,
    ]);

    // Crear el segundo evento (Maratón Internacional de Buenos Aires)
    Evento::create([
        'user_id' => $organizador->id,
        'nombreEvento' => 'Maratón Internacional de Buenos Aires',
        'descripcion' => 'Maratón de 42 km, considerado uno de los eventos deportivos más importantes en Sudamérica.',
        'fechaInicio' => '2024-09-27 07:30',
        'fechaFin' => '2024-09-27 14:00',
        'publico' => true,
        'direccion' => 'Av. 9 de Julio y Av. Corrientes, Buenos Aires, Argentina',
        'categoria_id' => $categoria3->id,
        'latitude' => -34.6037,
        'longitude' => -58.3816,
    ]);

    // Crear el tercer evento (Copa Argentina Final 2024)
    Evento::create([
        'user_id' => $organizador->id,
        'nombreEvento' => 'Copa Argentina Final 2024',
        'descripcion' => 'La final de la Copa Argentina 2024, donde los mejores equipos del país se enfrentan por el título.',
        'fechaInicio' => '2024-12-14 19:00',
        'fechaFin' => '2024-12-14 21:00',
        'publico' => true,
        'direccion' => 'Estadio Monumental, Av. Figueroa Alcorta 7597, Buenos Aires, Argentina',
        'categoria_id' => $categoria3->id,
        'latitude' => -34.5837,
        'longitude' => -58.4431,
    ]);

    $categoria4 = Categoria::find(7);

    Evento::create([
        'user_id' => $organizador->id,
        'nombreEvento' => 'La Casa de Bernarda Alba',
        'descripcion' => 'Una de las obras más emblemáticas de Federico García Lorca, protagonizada por las tensiones familiares dentro de una casa rural.',
        'fechaInicio' => '2024-12-10 20:00',
        'fechaFin' => '2024-12-10 22:00',
        'publico' => true,
        'direccion' => 'Teatro Colón, Cerrito 628, Buenos Aires, Argentina',
        'categoria_id' => $categoria4->id,
        'latitude' => -34.6037,
        'longitude' => -58.3816,
    ]);


    Evento::create([
        'user_id' => $organizador->id,
        'nombreEvento' => 'El Juego de la Silla',
        'descripcion' => 'Una obra contemporánea que reflexiona sobre los conflictos generacionales y las relaciones personales en tiempos modernos.',
        'fechaInicio' => '2024-12-15 21:00',
        'fechaFin' => '2024-12-15 23:00',
        'publico' => true,
        'direccion' => 'Teatro Maipo, Esmeralda 443, Buenos Aires, Argentina',
        'categoria_id' => $categoria4->id,
        'latitude' => -34.6060,
        'longitude' => -58.3804,
    ]);

    Evento::create([
        'user_id' => $organizador->id,
        'nombreEvento' => 'Coriolano',
        'descripcion' => 'Una obra de Shakespeare que explora la política, la venganza y la ambición a través del personaje de Coriolano, un héroe romano.',
        'fechaInicio' => '2024-12-20 20:30',
        'fechaFin' => '2024-12-20 22:30',
        'publico' => true,
        'direccion' => 'Teatro San Martín, Av. Corrientes 1530, Buenos Aires, Argentina',
        'categoria_id' => $categoria4->id,
        'latitude' => -34.6073,
        'longitude' => -58.3847,
    ]);



    }
}
