<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trabajador>
 */
class TrabajadorFactory extends Factory
{
    public $departamentos_instituto = [
        "Dirección",
        "Secretaría",
        "Administración",
        "Orientación Académica",
        "Recursos Humanos",
        "Departamento de Matemáticas",
        "Departamento de Ciencias",
        "Departamento de Lengua y Literatura",
        "Departamento de Idiomas",
        "Departamento de Educación Física",
        "Departamento de Tecnología",
        "Departamento de Artes",
        "Departamento de Historia y Geografía",
        "Departamento de Psicopedagogía",
        "Biblioteca",
    ];

    public $cargos = [
        "Jefe",
        "Secretario",
        "Coordinador",
        "Supervisor"
    ];


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $dep = $this->departamentos_instituto[array_rand($this->departamentos_instituto)];
        $fecha_nacimiento = fake()->date('Y-m-d', now()->subYears(28));

        $cargo = [$this->cargos[array_rand($this->cargos)], $this->cargos[array_rand($this->cargos)]];

        return [
            'nombre' => fake()->name(),
            'apellidos' => fake()->lastName(),
            'telefono' => fake()->phoneNumber(),
            'email' => fake()->email(),
            'foto' => 'trabajadores/default.jpg',
            'departamento' => $dep,
            'cargos' => $cargo,
            'fecha_nacimiento' => $fecha_nacimiento,
            'sustituto' => fake()->boolean(),
            'mayor55' => now()->diffInYears($fecha_nacimiento) > 55 ? 1 : 0
        ];
    }
}
