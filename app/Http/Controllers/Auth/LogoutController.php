<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function __invoke(Request $request)
    {
       $user = auth()->user();
       dd($user);
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'logged out.'
        ]);
    }

}
