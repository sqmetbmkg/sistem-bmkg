<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\StasiunResources;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StasiunAPI extends Controller
{
    public function index()
    {
        $data = DB::table('stasiun')->get(['id', 'wmo_id', 'nama_stasiun', 'longitude', 'latitude']);
        
        return response()->json(StasiunResources::collection($data), 200);
    }
}
