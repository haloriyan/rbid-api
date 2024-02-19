<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function store($weddingID, Request $request) {
        $image = $request->file('image');
        $imageFileName = $image->getClientOriginalName();

        $saveData = Gallery::create([
            'wedding_id' => $weddingID,
            'filename' => $imageFileName,
            'priority' => 0,
        ]);

        $image->storeAs('public/gallery_images', $imageFileName);

        return response()->json([
            'message' => "Berhasil mengupload gambar"
        ]);
    }
    public function delete($weddingID, Request $request) {
        $data = Gallery::where('id', $request->image_id);
        $image = $data->first();
        $deleteData = $data->delete();
        $deleteImage = Storage::delete('public/gallery_images/' . $image->filename);

        return response()->json([
            'message' => "Gambar berhasil dihapus"
        ]);
    }
    public function update($weddingID, Request $request) {
        $data = Gallery::where('id', $request->image_id);

        $data->update(['caption' => $request->caption]);

        return response()->json([
            'message' => "Berhasil mengubah caption"
        ]);
    }
}
