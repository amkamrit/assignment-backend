<?php
use \Unsplash as Unsplash;
use App\Models\Unplash;

if(!function_exists('unsplash_init')){
    function unsplash_init(){
        // client id get form login user auth 
        $conf=Unplash::where('client_id', 1)->first();
        Unsplash\HttpClient::init([
            'applicationId'	=> $conf->applicationId,
            'secret'	=> $conf->secret,
            'callbackUrl'	=>$conf->callbackUrl,
            'utmSource' => $conf->utmSource
        ]);
        return true;
    }
}

