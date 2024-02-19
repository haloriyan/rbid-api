<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Wedding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReservationController extends Controller
{
    public function reserve($slug, Request $request) {
        $wedding = Wedding::where('slug', $slug)->first();
        $schedules = $request->schedules;
        
        foreach ($schedules as $scheduleID) {
            Log::info($scheduleID);
        }

        // $saveData = Reservation::create([
        //     'wedding_id' => $wedding->id,
        //     'guest_id' => $request->guest_id,
        // ]);
    }
}
