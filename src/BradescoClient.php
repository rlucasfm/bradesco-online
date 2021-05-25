<?php

namespace BradescoOnline;

// require '../vendor/autoload.php';
require 'Api.php';

use BradescoOnline\Api;
use GuzzleHttp\Client;

class BradescoClient 
{    
    protected $client;
    protected $enc_data;

    public function __construct($data)
    {
        $api = new Api($data);
        
        $this->client = new Client([
            'base_uri' => ENDPOINT,
            'timeout' => TIMEOUT,
            'verify' => false
        ]);

        $this->enc_data = $api->get_signed();               
    }

    public function send_request()
    {        
        try {
            $response = $this->client->request('POST', '', ['body' => $this->enc_data]);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return $response;
    }
}

