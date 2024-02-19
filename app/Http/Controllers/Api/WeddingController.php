<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Greeting;
use App\Models\Guest;
use App\Models\Schedule;
use App\Models\Wedding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class WeddingController extends Controller
{
    public function getBySlug($slug, Request $request) {
        $guest = null;
        $guestCode = $request->guest_code;
        $wedding = Wedding::where('slug', $slug)->first();
        if ($wedding != null) {
            $wedding->schedules = Schedule::where('wedding_id', $wedding->id)->orderBy('date')->get();
            $wedding->galleries = Gallery::where('wedding_id', $wedding->id)->orderBy('priority')->get();
            $wedding->greetings = Greeting::where('wedding_id', $wedding->id)->orderBy('created_at')->get();
        }

        if ($guestCode != null) {
            $code = str_replace("untuk-", "", $guestCode);
            $guest = Guest::where('code', $code)->first();
        }

        return response()->json([
            'wedding' => $wedding,
            'guest' => $guest,
        ]);
    }
    public function create(Request $request) {
        $user = UserController::me($request->token);
        $timezone = $request->timezone ?? "Asia/Jakarta";

        $groomPhoto = $request->file('groom_photo');
        $groomPhotoName = Str::random(8)."_".$groomPhoto->getClientOriginalName();
        $bridePhoto = $request->file('bride_photo');
        $bridePhotoName = Str::random(8)."_".$bridePhoto->getClientOriginalName();
        
        $saveData = Wedding::create([
            'user_id' => $user->id,
            'groom_name' => $request->groom_name,
            'groom_photo' => $groomPhotoName,
            'groom_father' => $request->groom_father,
            'groom_mother' => $request->groom_mother,
            'bride_name' => $request->bride_name,
            'bride_photo' => $bridePhotoName,
            'bride_father' => $request->bride_father,
            'bride_mother' => $request->bride_mother,
            'slug' => $request->slug,
            'title' => $request->title,
            'timezone' => $timezone,
            'template' => "default",
            'fees_paid_by' => "ME",
            'status' => "ACTIVE"
        ]);

        $groomPhoto->storeAs('public/groom_photos', $groomPhotoName);
        $bridePhoto->storeAs('public/bride_photos', $bridePhotoName);

        // storing galeri
        foreach ($request->file('galleries') as $gallery) {
            $imageFileName = $saveData->id . "_" . $gallery->getClientOriginalName();
            Gallery::create([
                'wedding_id' => $saveData->id,
                'filename' => $imageFileName,
                'priority' => 0,
            ]);

            $gallery->storeAs('public/gallery_images', $imageFileName);
        }

        // Creating 2 schedules
        $akad = Schedule::create([
            'wedding_id' => $saveData->id,
            'title' => "Akad Nikah",
            'date' => $request->date . " 08:00:00",
            'capacity' => 0,
            'capacity_start' => 0,
        ]);
        $resepsi = Schedule::create([
            'wedding_id' => $saveData->id,
            'title' => "Resepsi",
            'date' => $request->date . " 10:00:00",
            'capacity' => 0,
            'capacity_start' => 0,
        ]);

        return response()->json([
            'message' => "Berhasil membuat undangan"
        ]);
    }

    public function guest($id) {
        $guests = Guest::where('wedding_id', $id)->paginate(25);

        return response()->json([
            'guests' => $guests
        ]);
    }
    public function schedule($id) {
        $schedules = Schedule::where('wedding_id', $id)->orderBy('date', 'ASC')->get();

        return response()->json([
            'schedules' => $schedules
        ]);
    }
    public function gallery($id) {
        $images = Gallery::where('wedding_id', $id)->get();
        
        return response()->json([
            'images' => $images
        ]);
    }
    public function greetings($id) {
        $greetings = Greeting::where('wedding_id', $id)->get();
        
        return response()->json([
            'greetings' => $greetings
        ]);
    }

    public function saveSettings($id, Request $request) {
        $toUpdate = [
            'title' => $request->title,
            'intro' => $request->intro,
            'stream_url' => $request->stream_url,
            'timezone' => $request->timezone,
        ];

        $data = Wedding::where('id', $id);
        $wedding = $data->first();

        $data->update($toUpdate);

        return response()->json([
            'message' => "Berhasil mengubah undangan"
        ]);
    }
}
