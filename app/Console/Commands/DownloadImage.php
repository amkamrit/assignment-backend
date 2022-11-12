<?php

namespace App\Console\Commands;

use App\DownloadImage\Image as AppImage;
use Illuminate\Console\Command;
use \Unsplash as Unsplash;
use App\Models\Unplash;
use Illuminate\Support\Facades\Log;

class DownloadImage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'download-image';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'download image from server';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(AppImage $image)
    {
        $conf=Unplash::where('client_id', 1)->first();
        $applicationId	= $conf->applicationId;
        $secret	= $conf->secret;
        $callbackUrl	=$conf->callbackUrl;
        $utmSource = $conf->utmSource;
        $image->connect($applicationId, $secret, $callbackUrl, $utmSource);
    }
}
