<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;

class EventController extends Controller
{
    public function listUsers(Event $event)
    {
        $users = $event->users;
        return response()->json(['message' => null, 'data' => $users], 200);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events= Event::all();
        return response()->json(['message'=>null,'data'=>$events],status: 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Realiza las validaciones según tus requerimientos
        // Ejemplo: Valida que el título sea obligatorio y tenga un máximo de 255 caracteres
        $this->validate($request, [
            'title' => 'required|max:255',
            // Agrega más reglas de validación según tus necesidades
        ]);

        // Crea un nuevo evento con los datos proporcionados en la solicitud
        $event = new Event([
            'title' => $request->input('title'),
            // Agrega más campos según tu modelo Event
        ]);

        // Guarda el evento en la base de datos
        if ($event->save()) {
            return response()->json(['message' => 'Evento creado', 'data' => $event], 201);
        }

        return response()->json(['message' => 'Fallo al crear el evento', 'data' => null], 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
