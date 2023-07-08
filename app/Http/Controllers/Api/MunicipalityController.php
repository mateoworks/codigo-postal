<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MunicipalityResource;
use App\Http\Resources\SuburbResource;
use App\Models\Municipality;
use App\Models\Suburb;
use Illuminate\Http\Request;

class MunicipalityController extends Controller
{
    /**
     * Listado de todo los municipios de la republica mexicana
     * @OA\Get (
     *     path="/municipios",
     *     tags={"municipios"},
     *     @OA\Parameter(
     *         in="query",
     *         name="filter[name]",
     *         required=false,
     *         description="Buscar por nombre del municipio",
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
     *                         example="Abalá"
     *                     ),
     *                     @OA\Property(
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
     *                     ),
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {
        $municipalities = Municipality::with('state')->filter()
            ->sort()
            ->paginate(15);
        return MunicipalityResource::collection($municipalities);
    }

    /**
     * Obtener datos de un municipio por el id
     * @OA\Get (
     *     path="/municipios/{id}",
     *     tags={"municipios"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         description="Obtener un municipio por id",
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
     *              @OA\Property(property="nombre", type="string", example="Abalá"),
     *              @OA\Property(
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
     *                     ),
     *              ),
     *         )
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="NOT FOUND",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Recurso Municipality no encontrado, puede que el id no exista en la base de datos"),
     *              @OA\Property(property="code", type="number", example=404),
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        $municipality = Municipality::findOrFail($id);
        $municipality->load('state');
        return MunicipalityResource::make($municipality);
    }

    /**
     * Obtener los asentamientos de un municipio
     * @OA\Get (
     *     path="/municipios/{id}/asentamientos",
     *     tags={"municipios"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         description="Obtener la lista de asentamientos por municipio",
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
     *                  @OA\Property(property="nombre", type="string", example="Abalá"),
     *                  @OA\Property(
     *                      type="array",
     *                      property="asentamientos",
     *                      @OA\Items(
     *                          type="object",
     *                          @OA\Property(
     *                              property="id",
     *                              type="number",
     *                              example="1"
     *                          ),
     *                          @OA\Property(
     *                              property="cp",
     *                              type="number",
     *                              example=97825
     *                          ),
     *                          @OA\Property(
     *                              property="nombre",
     *                              type="string",
     *                              example="Mukuiche"
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
     *              @OA\Property(property="message", type="string", example="Recurso Municipality no encontrado, puede que el id no exista en la base de datos"),
     *              @OA\Property(property="code", type="number", example="404"),
     *          )
     *      )
     * )
     */
    public function suburbs($id)
    {
        $municipality = Municipality::find($id);
        $municipality->load('suburbs');
        return MunicipalityResource::make($municipality);
    }
}
