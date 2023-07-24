<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Merchant;
use DB;

class MerchantController extends Controller
{
    /**
     * Get nearby merchants.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function nearby(Request $request)
    {
        // Get request data
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $radius = $request->input('radius');

        // Calculate max - min lat / long for radius bounding box
        $latN = $latitude + $radius / 111;
        $latS = $latitude - $radius / 111;
        $lonE = $longitude + $radius / (111 * cos($latitude));
        $lonW = $longitude - $radius / (111 * cos($latitude));

        // Query using bounding box first (indexed), then refine using Haversine (not indexed)
        $merchants = Merchant::select(DB::raw("*, 
        ( 6371 * acos( cos( radians(?) ) *
        cos( radians( latitude ) )
        * cos( radians( longitude ) - radians(?)
        ) + sin( radians(?) ) *
        sin( radians( latitude ) ) )
        ) AS distance", [$latitude, $longitude, $latitude]))
        ->whereRaw("longitude BETWEEN ? AND ?", [$lonW, $lonE])
        ->whereRaw("latitude BETWEEN ? AND ?", [$latS, $latN])
        ->having("distance", "<", $radius)
        ->orderBy("distance",'asc')
        ->get();

        // Return merchant data
        return response()->json($merchants);
    }
}

