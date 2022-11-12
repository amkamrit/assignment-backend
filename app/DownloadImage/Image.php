<?php 
namespace App\DownloadImage;

interface Image
{
    public function connect($applicationId, $secret, $callbackUrl, $utmSource);
}