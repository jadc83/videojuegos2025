<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVideojuegoRequest;
use App\Http\Requests\UpdateVideojuegoRequest;
use App\Models\Desarrolladora;
use App\Models\Videojuego;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VideojuegoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $consulta = Videojuego::query()
            ->join('desarrolladoras', 'videojuegos.desarrolladora_id', '=', 'desarrolladoras.id')
            ->join('distribuidoras', 'desarrolladoras.distribuidora_id', '=', 'distribuidoras.id')
            ->join('posesiones', 'videojuegos.id', '=', 'posesiones.videojuego_id')
            ->where('posesiones.user_id', Auth::id());

        if ($busqueda = $request->input('busqueda')) {
            $consulta->where('videojuegos.titulo', 'ilike', "%{$busqueda}%");
        }

        $orden = $request->input('orden', 'desarrolladora_asc');
        $criterios = [
            'desarrolladora_asc' => ['desarrolladoras.nombre', 'asc'],
            'desarrolladora_desc' => ['desarrolladoras.nombre', 'desc'],
            'distribuidora_asc' => ['distribuidoras.nombre', 'asc'],
            'distribuidora_desc' => ['distribuidoras.nombre', 'desc'],
            'salida_asc' => ['salida', 'asc'],
            'salida_desc' => ['salida', 'desc'],
        ];

        $consulta->orderBy(...($criterios[$orden] ?? $criterios['desarrolladora_asc']));

        $videojuegos = $consulta->select('videojuegos.*', 'desarrolladoras.nombre as desarrolladora_nombre', 'distribuidoras.nombre as distribuidora_nombre')
            ->paginate(20);

        return view('videojuegos.index', compact('videojuegos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $desarrolladoras = Desarrolladora::all();
        return view('videojuegos.create', ['desarrolladoras' => $desarrolladoras]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVideojuegoRequest $request)
    {

        $videojuego = new Videojuego();
        $videojuego->fill($request->validated());
        $videojuego->save();

        session()->flash('exito', 'Los cambios se guardaron correctamente.');
        return redirect()->route('videojuegos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Videojuego $videojuego)
    {
        return view('videojuegos.show', ['videojuego' => $videojuego]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Videojuego $videojuego)
    {
        $desarrolladoras = Desarrolladora::all();
        return view('videojuegos.edit', ['desarrolladoras' => $desarrolladoras, 'videojuego' => $videojuego]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVideojuegoRequest $request, Videojuego $videojuego)
    {
        $videojuego->update($request->validated());

        session()->flash('exito', 'Los cambios se guardaron correctamente.');
        return redirect()->route('videojuegos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Videojuego $videojuego)
    {
        $videojuego->delete();
        return redirect()->route('videojuegos.index');
    }

    public function poseo()
    {
        // Código para mostrar la lista desplegable de videojuegos y los botones
        $videojuegos = Videojuego::all(); // Obtener todos los videojuegos

        return view('videojuegos.poseo', compact('videojuegos'));
    }

    public function comprar(Request $request)
    {
        $videojuego = $request->videojuego_id;
        $user = Auth::id();

        $existe = DB::table('posesiones')->where('videojuego_id', $videojuego)->where('user_id', $user)->exists();

        if ($existe){

            return abort(403, 'Ya posees este videojuego');
        }

        DB::table('posesiones')->insert([
            'videojuego_id' => $videojuego,
            'user_id' => $user,
        ]);

        return redirect()->route('videojuegos.index');
    }

    public function vender(Request $request)
    {
        $videojuego = $request->videojuego_id; // Obtener solo el ID del videojuego
        $userId = Auth::id(); // Obtener el ID del usuario autenticado
        dd($videojuego);
        // Verificar si la posesión existe
        $existe = DB::table('posesiones')
                    ->where('videojuego_id', $videojuego)
                    ->where('user_id', $userId)
                    ->exists();

        if ($existe) {
            DB::table('posesiones')
                ->where('videojuego_id', $videojuego)
                ->where('user_id', $userId)
                ->delete();

            return redirect()->route('videojuegos.index');
        }

        return abort(403, 'No posees este videojuego');
    }

}
