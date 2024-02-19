<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Wedding;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public static function me($token) {
        return User::where('token', $token)->first();
    }
    public function auth(Request $request) {
        $user = self::me($request->token);
        if ($user != null) {
            $user->weddings = Wedding::where('user_id', $user->id)->take(10)->orderBy('created_at', 'DESC')->get();
        }
        
        return response()->json([
            'user' => $user,
        ]);
    }
    public function login(Request $request) {
        $email = $request->email;
        $status = 405;
        $message = "Gagal login.";
        $token = Str::random(32);

        $u = User::where('email', $email);
        $user = $u->first();

        if ($user == null) {
            $user = User::create([
                'name' => $request->name,
                'email' => $email,
                'password' => bcrypt('withgoogle'),
                'token' => $token,
            ]);
        } else {
            $u->update([
                'token' => $token,
            ]);
            $user = $u->first();
        }

        $status = 200;
        $message = "Berhasil login";

        return response()->json([
            'message' => $message,
            'user' => $user,
        ], $status);
    }
    public function logout(Request $request) {
        // 
    }

    public function wedding(Request $request) {
        $user = self::me($request->header('UserToken'));
        $weddings = Wedding::where('user_id', $user->id)->get();

        return response()->json([
            'weddings' => $weddings,
        ]);
    }
}
