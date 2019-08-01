<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Owner;
use App\Models\User;
use App\Services\FileUploadService;
use Illuminate\Http\Request;

class UploadFilecontroller extends Controller
{
    public function uploadPhotoProfile(Request $request)
    {
        $fileUPloadServices = new FileUploadService();
        $fileName = $fileUPloadServices->fileUploadPhotoProfile($request->file('file'));
        if (auth()->user()->userable instanceof Owner) {
            $owner = Owner::find(auth()->user()->userable->id);
            $owner->photo = $fileName;
            $owner->save();
        } elseif (auth()->user()->userable instanceof Employee) {
            $employee = Employee::find(auth()->user()->userable->id);
            $employee->photo = $fileName;
            $employee->save();
        }

        return response()->json($fileName);
    }
}
