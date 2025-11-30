<?php

namespace App\Http\Controllers;

use App\Helpers\GlobalHelper;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getCities(Request $request)
    {
        // Fetch cities by provinsi_id
        // $cities = City::where('provinsi_kode', $request->parent_id)->get(['kabkota_kode', 'kabkota_nama']); // Adjust based on your database structure
        $cities = GlobalHelper::getCities($request->parent_id);

        return response()->json([
            'items' => $cities,
        ]);
    }

    public function getSubDistricts(Request $request)
    {
        $parentId = $request->query('parent_id');  // This is the proper way to retrieve query params
        $subDistricts = GlobalHelper::getSubDistricts($parentId);

        return response()->json([
            'items' => $subDistricts,
        ]);
    }
    public function getVillages(Request $request)
    {
        $parentId = $request->query('parent_id');  // This is the proper way to retrieve query params
        $subDistricts = GlobalHelper::getVillages($parentId);

        return response()->json([
            'items' => $subDistricts,
        ]);
    }


}
