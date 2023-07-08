<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SuburbResource;
use App\Models\Suburb;
use Illuminate\Http\Request;

class ZipController extends Controller
{
    /**
     * Obtener asentamientos por codigo postal
     * @OA\Get (
     *     path="/cp/{cp}",
     *     tags={"cp"},
     *     @OA\Parameter(
     *         in="path",
     *         name="cp",
     *         required=true,
     *         description="Codigo postal para buscar",
     *         @OA\Schema(type="string")
     *     ),
     * 
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 type="array",
     *                 property="data",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="id",
     *                         type="number",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="cp",
     *                         type="number",
     *                         example=97825
     *                     ),
     *                     @OA\Property(
     *                         property="nombre",
     *                         type="string",
     *                         example="Mukuiche"
     *                     ),
     *                     @OA\Property(
     *                         property="tipo_asentamiento",
     *                         type="object",
     *                              @OA\Property(
     *                              property="id",
     *                              type="number",
     *                              example="1"
     *                          ),
     *                          @OA\Property(
     *                              property="tipo",
     *                              type="string",
     *                              example="Pueblo"
     *                          )
     *                     ),
     *                     @OA\Property(
     *                         property="ciudad",
     *                         type="object",
     *                              @OA\Property(
     *                              property="id",
     *                              type="number",
     *                              example="null"
     *                          ),
     *                          @OA\Property(
     *                              property="nombre",
     *                              type="string",
     *                              example="null"
     *                          )
     *                     ),
     *                     @OA\Property(
     *                         property="municipio",
     *                         type="object",
     *                              @OA\Property(
     *                              property="id",
     *                              type="number",
     *                              example="1"
     *                          ),
     *                          @OA\Property(
     *                              property="nombre",
     *                              type="string",
     *                              example="Abalá"
     *                          ),
     *                         @OA\Property(
     *                         property="estado",
     *                         type="object",
     *                              @OA\Property(
     *                              property="id",
     *                              type="number",
     *                              example="1"
     *                          ),
     *                          @OA\Property(
     *                              property="nombre",
     *                              type="string",
     *                              example="Yucatán"
     *                          ),
     *                          @OA\Property(
     *                              property="abrev",
     *                              type="string",
     *                              example="Yuc."
     *                          ),
     *                     )
     *                          
     *                     ),
     *                     
     *                 )
     *             )
     *         )
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="NOT FOUND",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Recurso Suburb no encontrado, puede que el id no exista en la base de datos"),
     *              @OA\Property(property="code", type="number", example="404"),
     *          )
     *      )
     * )
     */
    public function __invoke(Request $request)
    {
        $cp = $request->cp;
        $suburbs = Suburb::where('cp', $cp)->with(['settlement', 'city', 'municipality', 'municipality.state'])->get();
        return SuburbResource::collection($suburbs);
    }
}
