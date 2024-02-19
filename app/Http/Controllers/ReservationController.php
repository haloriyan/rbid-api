<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Wedding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReservationController extends Controller
{
    public function reserve($slug, Request $request) {
        $wedding = Wedding::where('slug', $slug)->first();
        $schedules = $request->schedules;

        Log::info(gettype($schedules));
        Log::info($schedules);

        // $saveData = Reservation::create([
        //     'wedding_id' => $wedding->id,
        //     'guest_id' => $request->guest_id,
        // ]);
    }
}
