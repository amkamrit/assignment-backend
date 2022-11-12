<?php 
namespace App\DownloadImage;
use \Unsplash as Unsplash;

class ConnectImageServer implements Image{
    public function connect($applicationId, $secret, $callbackUrl, $utmSource){
        Unsplash\HttpClient::init([
            'applicationId'	=> $applicationId,
            'secret'	=> $secret,
            'callbackUrl'	=>$callbackUrl,
            'utmSource' => $utmSource
        ]);
        return true;
    }
}