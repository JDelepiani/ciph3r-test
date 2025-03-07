<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Models\Product;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Precios",
 *     description="Operaciones relacionadas con los precios de los productos"
 * )
 */
class PriceController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/products/{productId}/prices",
     *     summary="Obtener todos los precios de un producto",
     *     tags={"Precios"},
     *     @OA\Parameter(
     *         name="productId",
     *         in="path",
     *         required=true,
     *         description="ID del producto",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lista de precios del producto",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Price")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Producto no encontrado"
     *     )
     * )
     */
    public function index($productId)
    {
        $prices = Price::where('product_id', $productId)->with('currency')->get();
        return response()->json($prices);
    }

    /**
     * @OA\Post(
     *     path="/api/products/{productId}/prices",
     *     summary="Crear un nuevo precio para un producto",
     *     tags={"Precios"},
     *     @OA\Parameter(
     *         name="productId",
     *         in="path",
     *         required=true,
     *         description="ID del producto",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/PriceRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Precio creado",
     *         @OA\JsonContent(ref="#/components/schemas/Price")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Producto no encontrado"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error de validación"
     *     )
     * )
     */
    public function store(Request $request, $productId)
    {
        $request->validate([
            'currency_id' => 'required|exists:currencies,id',
            'price' => 'required|numeric',
        ]);

        $price = Price::create([
            'product_id' => $productId,
            'currency_id' => $request->currency_id,
            'price' => $request->price,
        ]);

        return response()->json($price, 201);
    }
}
