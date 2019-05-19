<?php
namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class FileUploadService
{
    public function fileUploadPhotoProfile($file)
    {
        $carbon = Carbon::now();
        $uniqueFileName = 'PP'.$carbon->format('Ymdhis').'.'.$file->getClientOriginalExtension();
        $uploaded = Storage::disk('photo-profile')->put($uniqueFileName, File::get($file));

        return $uniqueFileName;
    }
}
