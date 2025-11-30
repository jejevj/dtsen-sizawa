<?php

namespace App\Http\Controllers;

use App\Helpers\GlobalHelper;
use Illuminate\Http\Request;

class LazController extends Controller
{
    //
      public function getLazBySkala(Request $request)
    {
        $skala = $request->input('skala');  // Get the selected skala from the request

        // Call the helper to get Laz data based on the selected Skala
        $lazData = GlobalHelper::getLazBySkala($skala);

        return response()->json([
            'items' => $lazData
        ]);
    }
}
