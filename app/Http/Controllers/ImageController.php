<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;
class ImageController extends Controller
{
    public function create()
    {
        return view('upload_image');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240', // 10MB max
        ]);
    
        $imagePath = $request->file('image')->store('original_images');
    
        // Compress the image (you can adjust the quality here)
        $compressedImagePath = $this->compressImage($imagePath, 75); // 75% quality
    
        // Save the compressed image path to the database
        Image::create([
            'image_path' => $compressedImagePath,
        ]);
    
        return redirect()->back()->with('success', 'Image uploaded and compressed successfully.');
    }
    
    private function compressImage($imagePath, $quality)
    {
        $image = imagecreatefromstring(file_get_contents(storage_path('app/' . $imagePath)));
        ob_start();
        imagejpeg($image, null, $quality);
        $compressedImage = ob_get_contents();
        ob_end_clean();
        $compressedImagePath = 'compressed_images/' . pathinfo($imagePath, PATHINFO_FILENAME) . '.jpg';
        Storage::put($compressedImagePath, $compressedImage);
    
        // Delete the original image after compression
        Storage::delete($imagePath);
    
        return $compressedImagePath;
    }
    
}
