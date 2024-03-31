<?php

namespace App\Http\Controllers;

use App\Models\PersonalResume;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function saveFile(Request $request)
    {

        $file = $request->file('file');
        $name = time().$file->getClientOriginalName();
        $file->move('files',$name);
        $resume = new PersonalResume();
        $resume -> file = $name;
        $resume->save();


    }

}
