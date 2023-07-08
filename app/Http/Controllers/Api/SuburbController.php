<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SuburbResource;
use App\Models\Suburb;
use Illuminate\Http\Request;

class SuburbController extends Controller
{
    /**
     * Listado de todos los asentamientos, con paginación 15 por página
     * @OA\Get (
     *     path="/asentamientos",
     *     tags={"asentamientos"},
     *     @OA\Parameter(
     *         in="query",
     *         name="filter[name]",
     *         required=false,
     *         description="Buscar por nombre del asentamiento",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="sort",
     *         required=false,
     *         description="Ordenar por 'name', '-name'",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="perPage",
     *         required=false,
     *         description="Cantidad de registros por consulta",
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="page",
     *         required=false,
     *         description="Si esta activada la paginación, indica a que página desea ir",
     *         @OA\Schema(type="number")
     *     ),
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
     *     )
     * )
     */
    public function index()
    {
        $suburbs = Suburb::with(['settlement', 'city', 'municipality', 'municipality.state'])
            ->filter()
            ->sort()
            ->paginate(15);
        return SuburbResource::collection($suburbs);
    }

    /**
     * Obtener datos de un asentamiento por el id
     * @OA\Get (
     *     path="/asentamientos/{id}",
     *     tags={"asentamientos"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         description="Obtener un asentamiento por id",
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
     *     @OA\Response(
     *          response=404,
     *          description="NOT FOUND",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Recurso Suburb no encontrado, puede que el id no exista en la base de datos"),
     *              @OA\Property(property="code", type="number", example="404"),
     *          )
     *      )
     * )
     */
    public function show(Suburb $suburb)
    {
        $suburb->load(['settlement', 'city', 'municipality', 'municipality.state']);
        return SuburbResource::make($suburb);
    }
}
