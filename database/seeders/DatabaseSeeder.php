<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Resource;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Crear docente 1
        $teacher1 = User::create([
            'name' => 'Rosa',
            'lastname' => 'Mamani',
            'email' => 'rosa@yachay.pe',
            'password' => Hash::make('password'),
            'role' => 'teacher',
        ]);

        // Crear docente 2
        $teacher2 = User::create([
            'name' => 'Julio',
            'lastname' => 'Condori',
            'email' => 'julio@yachay.pe',
            'password' => Hash::make('password'),
            'role' => 'teacher',
        ]);

        // Crear estudiante
        $student = User::create([
            'name' => 'Estudiante',
            'lastname' => 'Prueba',
            'email' => 'estudiante@yachay.pe',
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);

        // Crear recursos educativos
        $resources = [
            [
                'title' => 'Geometría en los Tokapus Incas',
                'description' => 'Aprende geometría a través de los símbolos incas',
                'subject' => 'Matematica',
                'level' => 'Secundaria',
                'lang' => 'Castellano',
                'type' => 'video',
                'status' => 'approved',
                'views' => 890,
                'downloads' => 234,
                'author_id' => $teacher1->id,
            ],
            [
                'title' => 'Rimaykuna - Vocabulario Quechua',
                'description' => 'Aprende palabras básicas en quechua',
                'subject' => 'Quechua',
                'level' => 'Primaria',
                'lang' => 'Bilingue',
                'type' => 'pdf',
                'status' => 'approved',
                'views' => 456,
                'downloads' => 123,
                'author_id' => $teacher1->id,
            ],
            [
                'title' => 'La Papa y su Historia',
                'description' => 'Historia y cultivo de la papa en los Andes',
                'subject' => 'Historia',
                'level' => 'Secundaria',
                'lang' => 'Castellano',
                'type' => 'video',
                'status' => 'approved',
                'views' => 234,
                'downloads' => 89,
                'author_id' => $teacher2->id,
            ],
            [
                'title' => 'Sumaq Kawsay - Vivir Bien',
                'description' => 'Filosofía andina del buen vivir',
                'subject' => 'Ciencia',
                'level' => 'Secundaria',
                'lang' => 'Quechua',
                'type' => 'audio',
                'status' => 'approved',
                'views' => 567,
                'downloads' => 145,
                'author_id' => $teacher2->id,
            ],
            [
                'title' => 'Lectura y Escritura en Quechua',
                'description' => 'Aprende a leer y escribir en quechua',
                'subject' => 'Comunicacion',
                'level' => 'Primaria',
                'lang' => 'Bilingue',
                'type' => 'pdf',
                'status' => 'approved',
                'views' => 345,
                'downloads' => 98,
                'author_id' => $teacher1->id,
            ],
            [
                'title' => 'Números y Cantidades',
                'description' => 'Matemática básica para primaria',
                'subject' => 'Matematica',
                'level' => 'Primaria',
                'lang' => 'Castellano',
                'type' => 'pdf',
                'status' => 'approved',
                'views' => 678,
                'downloads' => 201,
                'author_id' => $teacher1->id,
            ],
            [
                'title' => 'Animales de los Andes',
                'description' => 'Conoce la fauna andina',
                'subject' => 'Ciencia',
                'level' => 'Primaria',
                'lang' => 'Quechua',
                'type' => 'video',
                'status' => 'pending',
                'views' => 0,
                'downloads' => 0,
                'author_id' => $teacher2->id,
            ],
        ];

        foreach ($resources as $resource) {
            Resource::create($resource);
        }

        // Estudiante guarda algunos recursos
        $student->savedResources()->sync([1, 2, 4]);
    }
}