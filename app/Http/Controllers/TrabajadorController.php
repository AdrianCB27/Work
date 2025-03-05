<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Trabajador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrabajadorController extends Controller
{

    public $departamentos_instituto = [
        "direccion" => "Dirección",
        "secretaria" => "Secretaría",
        "administracion" => "Administración",
        "orientacion_academica" => "Orientación Académica",
        "recursos_humanos" => "Recursos Humanos",
        "departamento_de_matematicas" => "Departamento de Matemáticas",
        "departamento_de_ciencias" => "Departamento de Ciencias",
        "departamento_de_lengua_y_literatura" => "Departamento de Lengua y Literatura",
        "departamento_de_idiomas" => "Departamento de Idiomas",
        "departamento_de_educacion_fisica" => "Departamento de Educación Física",
        "departamento_de_tecnologia" => "Departamento de Tecnología",
        "departamento_de_artes" => "Departamento de Artes",
        "departamento_de_historia_y_geografia" => "Departamento de Historia y Geografía",
        "departamento_de_psicopedagogia" => "Departamento de Psicopedagogía",
        "biblioteca" => "Biblioteca",
    ];
    
    public $cargos = [
        "jefe" => "Jefe",
        "secretario" => "Secretario",
        "coordinador" => "Coordinador",
        "supervisor" => "Supervisor",
    ];

    public $colors = ['jefe' => 'amber', 'secretario' =>  'rose',  'coordinador' => 'indigo', 'supervisor' => 'lime'];


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trabajadores = Trabajador::orderBy('fecha_nacimiento', 'desc')->get();
        $colors = $this->colors;
        
        return view('trabajadores.index', compact('trabajadores', 'colors'));
    }
    

    /**
     * Display a listing of the resource.
     */
    public function filter(Request $request)
    {
        $buscar = $request->buscar;
        $consulta = Trabajador::query();
    
        if ($buscar) {
            $consulta->where('nombre', 'LIKE', "%$buscar%")
            ->orWhere('apellidos', 'LIKE', "%$buscar%")
            ->orWhere('departamento', 'LIKE', "%$buscar%")
            ->orWhere('cargos', 'LIKE', "%$buscar%");
        }
    
        if ($request->has('sustituto')) {
            $consulta->where('sustituto', 1);
        }
    
        if ($request->has('mayor')) {
            $consulta->where('mayor55', 1);
        }
    
        $trabajadores = $consulta->get();
        $colors = $this->colors;
        
        return view('trabajadores.index', compact('trabajadores', 'colors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $deps = $this->departamentos_instituto;
        $cargos = $this->cargos;

        return view('trabajadores.create', compact('deps', 'cargos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required',
            'apellidos' => 'required',
            'telefono' => 'required',
            'email' => 'required',
            'foto' => 'nullable',
            'departamento' => 'required',
            'fecha_nacimiento' => 'required'
        ]);

        $validated['sustituto'] = $request->sustituto? 1 : 0;
        // print_r($request->cargos);
        $validated['cargos'] = array_map(fn($cargo) => $this->cargos[$cargo], $request->cargos);
        $validated['departamento'] = $this->departamentos_instituto[$request->departamento];
        // \print_r($request->fecha_nacimiento);

        $nacimiento = Carbon::createFromFormat('Y-m-d', $request->fecha_nacimiento);
        $hoy = Carbon::now();
            
        $validated['mayor55'] = $nacimiento->diffInYears($hoy) >= 55 ? 1 : 0;

        if($request->hasFile('foto')) {
            $path = $request->file('foto')->store('trabajadores', 'public');

            $validated['foto'] = $path;
        }

        Trabajador::create($validated);

        return redirect()->route('trabajadores.index')->with('success', 'Se ha añadido ' . $request->nombre . ' exitosamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $trabajador = Trabajador::find($id);

        return view('trabajadores.show', compact('trabajador'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $trabajador = Trabajador::find($id);
        $deps = $this->departamentos_instituto;
        $cargos = $this->cargos;
    

        return view('trabajadores.edit', compact('trabajador', 'deps', 'cargos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'nombre' => 'required',
            'apellidos' => 'required',
            'telefono' => 'required',
            'email' => 'required',
            'foto' => 'nullable|image|max:2048',
            'departamento' => 'required',
            'fecha_nacimiento' => 'required'
        ]);

        $trabajador = Trabajador::find($id);

        $validated['sustituto'] = $request->sustituto? 1 : 0;
        $validated['cargos'] = array_map(fn($cargo) => $this->cargos[$cargo], $request->cargos);
        $validated['departamento'] = $this->departamentos_instituto[$request->departamento];

        $nacimiento = Carbon::createFromFormat('Y-m-d', $request->fecha_nacimiento);
        $hoy = Carbon::now();
            
        $validated['mayor55'] = $nacimiento->diffInYears($hoy) >= 55 ? 1 : 0;

        if($request->hasFile('foto')) {

            if($trabajador->foto) {
                Storage::disk('public')->delete($trabajador->foto);
            }

            $path = $request->file('foto')->store('trabajadores', 'public');

            $validated['foto'] = $path;
        }

        $trabajador->update($validated);

        return redirect()->route('trabajadores.index')->with('success', 'Se ha actualizado ' . $request->nombre . ' exitosamente.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $trabajador = Trabajador::find($id);
        $trabajador->delete();
        
        return redirect()->route('trabajadores.index')->with('success', 'Trabajador eliminado correctamente');
    }
}
