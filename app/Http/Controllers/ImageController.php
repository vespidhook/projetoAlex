<?php

// app/Http/Controllers/ImageController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{
    public function getImage()
    {
        $count = Image::count();
        $randomIndex = rand(0, $count - 1);
        $image = Image::offset($randomIndex)->first();

        return response()->json(['id' => $image->id, 'image_url' => $image->image_url]);
    }

    public function checkAnswer(Request $request)
    {
        $request->validate([
            'image_id' => 'required|exists:images,id',
            'user_input' => 'required|string',
        ]);

        $image = Image::find($request->input('image_id'));

        if (!$image) {
            return response()->json(['message' => 'Image not found.'], 404);
        }

        if (strtolower($image->correct_name) == strtolower(trim($request->input('user_input')))) {
            return response()->json(['message' => 'Correct! 🎉']);
        } else {
            return response()->json(['message' => 'Try again. 🤔']);
        }
    }
}
