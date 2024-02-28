<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePublicationRequest;
use App\Http\Requests\UpdatePublicationRequest;
use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicationApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:edit publications')->only('store', 'update', 'destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publicaciones = Publication::all();

        return response()->json([
            'status' => true,
            'data' => $publicaciones,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePublicationRequest $request)
    {
        try {
            $publicacion = Publication::create($request->all());
            $publicacion->user()->attach(Auth::user()->id);
            return response()->json([
                'status' => true,
                'message' => "Añadido correctamente",
                'creado' => $publicacion,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => true,
                'message' => "Ha ocurrido un error",
                'error' => $th->getMessage(),
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $publicacion = Publication::find($id);
            return response()->json([
                'status' => true,
                'data' => $publicacion,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => true,
                'message' => "No encontrado",
                'error' => $th->getMessage(),
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePublicationRequest  $request, string $id)
    {
        $publicacion = Publication::find($id);
        if(Auth::user()->id = $publicacion->users[0]) {
            $publicacion->update($request->all());
            return response()->json([
                'status' => true,
                'message' => "Cambiado correctamente",
                'cambios' => $publicacion,
            ], 201);
        }else {
            return response()->json([
                'status' => true,
                'message' => "No tienes permiso para editar esta publicación",
            ], 403);
        }            
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Publication::find($id)->delete();
            return response()->json([
                'status' => true,
                'message' => "Eliminado correctamente"
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => "Ha ocurrido un error",
                'error' => $th
            ], 400);
        }
    }
}
