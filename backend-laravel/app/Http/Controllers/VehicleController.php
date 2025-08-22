<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        // 🔹 retorna apenas veículos do usuário autenticado
        return $request->user()->vehicles;
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'placa' => 'required|unique:vehicles',
            'modelo' => 'required',
            'fabricante' => 'required',
            'ano' => 'required|integer',
        ]);

        // 🔹 cria o veículo já vinculado ao usuário logado
        $vehicle = $request->user()->vehicles()->create($data);

        return response()->json($vehicle, 201);
    }

    public function show(Request $request, Vehicle $vehicle)
    {
        // 🔹 garante que só o dono consegue acessar
        if ($vehicle->user_id !== $request->user()->id) {
            return response()->json(['error' => 'Não autorizado'], 403);
        }

        return response()->json([$vehicle], 200);
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        if ($vehicle->user_id !== $request->user()->id) {
            return response()->json(['error' => 'Não autorizado'], 403);
        }

        $vehicle->update($request->all());
        return $vehicle;
    }

    public function destroy(Request $request, Vehicle $vehicle)
    {
        if ($vehicle->user_id !== $request->user()->id) {
            return response()->json(['error' => 'Não autorizado'], 403);
        }

        $vehicle->delete();
        return response()->noContent();
    }
}
