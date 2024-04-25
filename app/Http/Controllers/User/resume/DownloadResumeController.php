<?php

namespace App\Http\Controllers\User\resume;

use App\Http\Controllers\Controller;
use App\Models\Personal_resume;
use Illuminate\Support\Facades\Storage;

class DownloadResumeController extends Controller
{
    public function index(int $personalResume_id)
    {
        try {
           $personalResume = Personal_resume::find($personalResume_id);
            $file = 'files/'.$personalResume->unique_name;
            $filePath = Storage::path($file);
            return response()->download($filePath);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }
}
