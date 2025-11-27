<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DBDownloadController extends Controller
{
    public function DbDownload(): BinaryFileResponse
    {
        $app_name = env('APP_NAME');

        Artisan::call('backup:run --filename='.$app_name.'.zip --only-db');

        $file = public_path().'/uploads/Laravel/'.$app_name.'.zip';

        return Response::download($file, ''.$app_name.'.zip')->deleteFileAfterSend(true);

    }
}
