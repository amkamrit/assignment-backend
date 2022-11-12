<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnplasheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Unplash::create([
            'applicationId' => '1R3LT2V-B1aY_7-OvwNHSlHTJ-Bl4-aEWQegtmU6uxU',
            'secret' => 'Y9b2mwbMjsmMprlxT-PHvVCFjEpNr9dw18H6GacL-JY',
            'callbackUrl' => 'urn:ietf:wg:oauth:2.0:oob',
            'utmSource' =>'amrit-demo',
            'client_id'=> 1
        ]);
    }
}
