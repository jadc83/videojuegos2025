<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVideojuegoRequest;
use App\Http\Requests\UpdateVideojuegoRequest;
use App\Models\Desarrolladora;
use App\Models\Videojuego;
use Illuminate\Support\Facades\Auth;

class VideojuegoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videojuegos = Auth::user()->videojuegos;

        return view('videojuegos.index', ['videojuegos' => $videojuegos ]);
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
}
