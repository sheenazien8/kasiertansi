<?php
namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class FileUploadService
{
    private $extension;
    public function getExtension($ext)
    {
        $this->extension = $ext;

        return $this;
    }
    public function fileUploadPhotoProfile($file)
    {
        $carbon = Carbon::now();
        $uniqueFileName = 'PP'.$carbon->format('Ymdhis').$this->extension;
        $uploaded = Storage::disk('photo-profile')->put($uniqueFileName, $file);

        return './storage/photo-profile/'.$uniqueFileName;
    }
}
