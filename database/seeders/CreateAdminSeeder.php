<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuario admin si no existe
        $admin = User::where('email', 'admin@yachay.dev')->first();
        
        if (!$admin) {
            User::create([
                'name' => 'Administrador',
                'lastname' => 'YachayCusco',
                'email' => 'admin@yachay.dev',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]);
            
            echo "\n✓ Administrador creado:\n";
            echo "  Email: admin@yachay.dev\n";
            echo "  Contraseña: admin123\n";
            echo "  Rol: admin\n\n";
        } else {
            echo "\n✓ El administrador ya existe\n\n";
        }
    }
}
