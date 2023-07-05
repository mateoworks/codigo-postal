<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StateResource;
use App\Models\State;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *  title="API estados de la republica mexicana", 
 *  version="1.0",
 *  description="Lista de estados de la republica mexicana"
 * )
 *
 * @OA\Server(url="http://puntoventa.test/api")
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
     *         name="filter[description]",
     *         required=false,
     *         description="Buscar por nombre del estado",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 type="array",
     *                 property="rows",
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

    public function show($id)
    {
        $state = State::included()->findOrFail($id);
        return StateResource::make($state);
    }

    public function municipalities($id)
    {
        $state = State::findOrFail($id);
        $state->load('municipalities');
        return StateResource::make($state);
    }
}
