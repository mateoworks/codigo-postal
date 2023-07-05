<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SuburbResource;
use App\Models\Suburb;
use Illuminate\Http\Request;

class SuburbController extends Controller
{
    /**
     * Display a listing of the resource.
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
     * Display the specified resource.
     */
    public function show(Suburb $suburb)
    {
        $suburb->load(['settlement', 'city', 'municipality', 'municipality.state']);
        return SuburbResource::make($suburb);
    }
}
