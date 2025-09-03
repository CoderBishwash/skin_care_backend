<?php
// app/Http/Controllers/API/SkinTypeController.php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SkinType;

class SkinTypeController extends Controller
{
    public function index()
    {
        $skins = SkinType::all();

        $skins->transform(function ($skin) {
            $skin->image_url = asset('storage/skins/' . $skin->image);
            return $skin;
        });

        return response()->json($skins);
    }

    public function show($id)
    {
        $skin = SkinType::findOrFail($id);
        $skin->image_url = asset('storage/skins/' . $skin->image);
        return response()->json($skin);
    }
}
