<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\FileUploadService;
use Illuminate\Http\Request;

class UploadFilecontroller extends Controller
{
    public function uploadPhotoProfile(Request $request)
    {
        $fileUPloadServices = new FileUploadService();
        $fileName = $fileUPloadServices->fileUploadPhotoProfile($request->file('file'));

        return response()->json($fileName);
    }
}
