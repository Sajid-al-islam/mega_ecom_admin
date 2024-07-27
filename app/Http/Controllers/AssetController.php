<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AssetController extends Controller
{
    public function cache($req_file_name)
    {
        $file_name = public_path($req_file_name);
        $filePath = Storage::drive('public')->get($req_file_name);

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file_name);
        $lastModified = filemtime($file_name);
        finfo_close($finfo);

        if (strpos($file_name, '.css')) {
            $mimeType = "text/css; charset=UTF-8";
        } else if (strpos($file_name, '.js')) {
            $mimeType = "application/javascript";
        } else if (strpos($file_name, '.ico')) {
            $mimeType = "image/vnd.microsoft.icon";
        } else if (strpos($file_name, '.svg')) {
            $mimeType = "image/svg+xml";
        }
        // dd($image_name, $mimeType, strpos($image_name, '.css'));

        $cache_days = 1;
        $one_day_secs = 86400;
        if(request()->cache_days && request()->cache_days > 1){
            $cache_days = request()->cache_days;
        }
        $cache_seconds = round($one_day_secs * $cache_days);
        $headers = [
            'Content-Type' => $mimeType,
            'Cache-Control' => 'public, max-age='.$cache_seconds,
            'Expires' => gmdate('D, d M Y H:i:s \G\M\T', time() + $cache_seconds),
            'Last-Modified' => gmdate('D, d M Y H:i:s \G\M\T', $lastModified),
        ];

        return response()->make($filePath, 200, $headers);
    }
}
