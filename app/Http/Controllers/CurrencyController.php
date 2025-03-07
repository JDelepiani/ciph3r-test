<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="API de Divisas",
 *     version="1.0.0",
 *     description="API para gestionar divisas"
 * )
 */

/**
 * @OA\Tag(
 *     name="Divisas",
 *     description="Operaciones relacionadas con divisas"
 * )
 */
class CurrencyController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/currencies",
     *     summary="Obtener todas las divisas",
     *     tags={"Divisas"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de divisas",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Currency")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $currencies = Currency::all();
        return response()->json($currencies);
    }

    /**
     * @OA\Post(
     *     path="/api/currencies",
     *     summary="Crear una nueva divisa",
     *     tags={"Divisas"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CurrencyRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Divisa creada",
     *         @OA\JsonContent(ref="#/components/schemas/Currency")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error de validación"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'symbol' => 'required|string|max:10',
            'exchange_rate' => 'required|numeric',
        ]);

        $currency = Currency::create($request->all());
        return response()->json($currency, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/currencies/{id}",
     *     summary="Obtener una divisa por ID",
     *     tags={"Divisas"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la divisa",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalles de la divisa",
     *         @OA\JsonContent(ref="#/components/schemas/Currency")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Divisa no encontrada"
     *     )
     * )
     */
    public function show($id)
    {
        $currency = Currency::findOrFail($id);
        return response()->json($currency);
    }

    /**
     * @OA\Put(
     *     path="/api/currencies/{id}",
     *     summary="Actualizar una divisa existente",
     *     tags={"Divisas"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la divisa",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CurrencyRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Divisa actualizada",
     *         @OA\JsonContent(ref="#/components/schemas/Currency")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Divisa no encontrada"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error de validación"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'symbol' => 'sometimes|string|max:10',
            'exchange_rate' => 'sometimes|numeric',
        ]);

        $currency = Currency::findOrFail($id);
        $currency->update($request->all());

        return response()->json($currency);
    }

    /**
     * @OA\Delete(
     *     path="/api/currencies/{id}",
     *     summary="Eliminar una divisa",
     *     tags={"Divisas"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la divisa",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Divisa eliminada"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Divisa no encontrada"
     *     )
     * )
     */
    public function destroy($id)
    {
        $currency = Currency::findOrFail($id);
        $currency->delete();

        return response()->json(null, 204);
    }
}
