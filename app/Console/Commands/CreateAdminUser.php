<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-admin-user {email?} {password?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crear un usuario administrador para la plataforma';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email') ?? $this->ask('¿Correo del administrador?');
        $name = $this->ask('¿Nombre del administrador?');
        $lastname = $this->ask('¿Apellido del administrador?', '');
        $password = $this->argument('password') ?? $this->secret('¿Contraseña del administrador?');

        // Verificar si el usuario ya existe
        if (User::where('email', $email)->exists()) {
            $this->error("El correo $email ya existe en el sistema.");
            return 1;
        }

        // Crear el usuario
        $admin = User::create([
            'name' => $name,
            'lastname' => $lastname,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'admin',
        ]);

        $this->info("✓ Administrador creado exitosamente");
        $this->line("Correo: $email");
        $this->line("Nombre: $name $lastname");
        $this->line("Rol: Admin");
        
        return 0;
    }
}
