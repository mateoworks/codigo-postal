<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StateResource;
use App\Models\State;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *  title="API para consulta de codigos postales", 
 *  version="1.0",
 *  description="Busca de codigos postales, información de estados, municipios y sus asentamientos"
 * )
 *
 * @OA\Server(url=L5_SWAGGER_CONST_HOST)
 */
class StateController extends Controller
{
    /**
     * Listado de todo los estados de la republica mexicana
     * @OA\Get (
     *     path="/estados",
     *     tags={"estados"},
     *     @OA\Parameter(
     *         in="query",
     *         name="filter[name]",
     *         required=false,
     *         description="Buscar por nombre del estado",
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
     *                         property="nombre",
     *                         type="string",
     *                         example="Oaxaca"
     *                     ),
     *                     @OA\Property(
     *                         property="abrev",
     *                         type="string",
     *                         example="Oax."
     *                     ),
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {
        $states = State::included()
            ->filter()
            ->sort()
            ->getOrPaginate();
        return StateResource::collection($states);
    }

    /**
     * Obtener datos de un estado por el id
     * @OA\Get (
     *     path="/estados/{id}",
     *     tags={"estados"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         description="Obtener un estado por id",
     *         @OA\Schema(type="string")
     *     ),
     * 
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *              @OA\Property(
     *              type="object",
     *              property="data",
     *              @OA\Property(property="id", type="number", example=21),
     *              @OA\Property(property="nombre", type="string", example="Puebla"),
     *              @OA\Property(property="abrev", type="string", example="Pue."),
     *              ),
     *         )
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="NOT FOUND",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Recurso State no encontrado, puede que el id no exista en la base de datos"),
     *              @OA\Property(property="code", type="number", example=404),
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        $state = State::included()->findOrFail($id);
        return StateResource::make($state);
    }

    /**
     * Obtener los municipios de un estado
     * @OA\Get (
     *     path="/estados/{id}/municipios",
     *     tags={"estados"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         description="Obtener la lista de municipios por estado",
     *         @OA\Schema(type="string")
     *     ),
     * 
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *              @OA\Property(
     *              type="object",
     *              property="data",
     *                  @OA\Property(property="id", type="number", example=1),
     *                  @OA\Property(property="nombre", type="string", example="Aguascalientes"),
     *                  @OA\Property(property="abrev", type="string", example="Ags."),
     *                  @OA\Property(
     *                      type="array",
     *                      property="municipios",
     *                      @OA\Items(
     *                          type="object",
     *                          @OA\Property(
     *                              property="id",
     *                              type="number",
     *                              example="43"
     *                          ),
     *                          @OA\Property(
     *                              property="nombre",
     *                              type="string",
     *                              example="Aguascalientes"
     *                          ),
     *                      )
     *                  )
     *              )
     *         )
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="NOT FOUND",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Recurso State no encontrado, puede que el id no exista en la base de datos"),
     *              @OA\Property(property="code", type="number", example="404"),
     *          )
     *      )
     * )
     */
    public function municipalities($id)
    {
        $state = State::findOrFail($id);
        $state->load('municipalities');
        return StateResource::make($state);
    }
}
