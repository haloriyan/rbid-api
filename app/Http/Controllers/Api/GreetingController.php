<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Greeting;
use App\Models\Wedding;
use Illuminate\Http\Request;

class GreetingController extends Controller
{
    public function store($slug, Request $request) {
        $wedding = Wedding::where('slug', $slug)->first(['id']);

        $saveData = Greeting::create([
            'wedding_id' => $wedding->id,
            'name' => $request->name,
            'body' => $request->body,
        ]);

        return response()->json([
            'message' => "Berhasil mengirimkan ucapan"
        ]);
    }
    public function delete($slug, Request $request) {
        $data = Greeting::where('id', $request->greeting_id);
        $data->delete();

        return response()->json([
            'message' => "Berhasil menghapus ucapan"
        ]);
    }
}
