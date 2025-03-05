<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Trabajador extends Model
{
    use HasFactory;

    public $table = 'trabajadores';
    protected $fillable = ['nombre', 'apellidos', 'telefono', 'email', 'foto', 'departamento', 'cargos', 'fecha_nacimiento', 'sustituto', 'mayor55'];

    protected function cargos():Attribute {
        return Attribute::make(
            get: fn($value) => json_decode($value, true),
            set: fn($value) => json_encode($value, JSON_UNESCAPED_UNICODE)
        );
    }

}
