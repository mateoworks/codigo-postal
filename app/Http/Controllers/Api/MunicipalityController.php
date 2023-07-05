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
     * Display a listing of the resource.
     */
    public function index()
    {
        $municipalities = Municipality::with('state')->filter()
            ->sort()
            ->paginate(15);
        return MunicipalityResource::collection($municipalities);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $municipality = Municipality::findOrFail($id);
        $municipality->load('state');
        return MunicipalityResource::make($municipality);
    }

    public function suburbs($id)
    {
        $municipality = Municipality::find($id);
        $municipality->load('suburbs');
        return MunicipalityResource::make($municipality);
    }
}
