<?php

namespace App\Http\Controllers\jobAd;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use Illuminate\Http\Request;

class MarkedAdController extends Controller
{
    public function markedAd(Request $request){


        $ids = $request->input('id');
        $selectedRecords = Advertisement::whereIn('id', $ids)->get();
        $user = auth()->user();

        $user->job_ad()->attach($selectedRecords);
        return response()->json([
           'message'=> 'marked job' ,
            'makrked job'=> $user
        ]);

    }


}
