<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function store($weddingID, Request $request) {
        $saveData = Schedule::create([
            'wedding_id' => $weddingID,
            'title' => $request->title,
            'date' => $request->date." ".$request->time,
            'address' => $request->address,
            'gmaps_link' => $request->gmaps_link,
        ]);

        return response()->json([
            'message' => "Berhasil menambahkan jadwal acara"
        ]);
    }
    public function delete(Request $request) {
        $data = Schedule::where('id', $request->schedule_id);
        $schedule = $data->first();
        $deleteData = $data->delete();

        return response()->json([
            'message' => "Berhasil menghapus jadwal " . $schedule->title,
        ]);
    }
    public function update(Request $request) {
        $data = Schedule::where('id', $request->schedule_id);
        $data->update([
            'title' => $request->title,
            'date' => $request->date." ".$request->time,
            'address' => $request->address,
            'gmaps_link' => $request->gmaps_link,
        ]);
        
        return response()->json([
            'message' => "Berhasil menyimpan perubahan jadwal acara"
        ]);
    }
}
