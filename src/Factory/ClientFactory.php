<?php

namespace App\Factory;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Uri;

class ClientFactory
{
    public function get3dPackagestClient()
    {
        return new Client([
            'base_uri' => new Uri('https://eu.api.3dbinpacking.com'),
        ]);
    }
}
