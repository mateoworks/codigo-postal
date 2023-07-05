<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SuburbResource;
use App\Models\Suburb;
use Illuminate\Http\Request;

class ZipController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $cp = $request->cp;
        $suburbs = Suburb::where('cp', $cp)->with(['settlement', 'city', 'municipality', 'municipality.state'])->get();
        return SuburbResource::collection($suburbs);
    }
}
