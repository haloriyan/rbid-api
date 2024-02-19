<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use App\Models\Wedding;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GuestController extends Controller
{
    public function store(Request $request) {
        $wedding = Wedding::where('id', $request->wedding_id)->first();
        $name = $request->name;
        $code = Str::slug($name);

        $check = Guest::where([
            ['wedding_id', $wedding->id],
            ['code', $code]
        ])->get(['id']);

        if ($check->count() > 0) {
            $code = $code."-".$check->count() + 1;
        }

        $saveData = Guest::create([
            'wedding_id' => $wedding->id,
            'user_id' => $wedding->user_id,
            'code' => $code,
            'name' => $name,
            'phone' => '62'.$request->phone,
        ]);

        return response()->json([
            'message' => "Berhasil menambahkan data tamu"
        ]);
    }
    public function delete(Request $request) {
        $data = Guest::where('id', $request->guest_id);
        $guest = $data->first();
        $deleteData = $data->delete();

        return response()->json([
            'message' => "Berhasil menghapus " . $guest->name . " dari data tamu"
        ]);
    }
}
