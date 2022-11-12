<?php 
namespace App\DownloadImage;

use Illuminate\Support\Facades\Log;
use \Unsplash as Unsplash;

class ConnectImageServer implements Image{
    public function connect($applicationId, $secret, $callbackUrl, $utmSource){
       Log::info('image server is not define');
    }
}