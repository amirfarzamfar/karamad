<?php

namespace App\Http\Controllers\Karfarma\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminLogoutController extends Controller
{
    public function __invoke(Request $request)
    {

        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'logged out.'
        ]);
    }

}
