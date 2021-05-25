<?php

namespace BradescoOnline;

// require '../vendor/autoload.php';
require 'Api.php';

use BradescoOnline\Api;
use GuzzleHttp\Client;

/**
 * Classe que implementa a interface do pacote
 *
 * @author Richard Lucas F. de Mendonça
 * @version 1.0
 * @access public
 */
class BradescoClient 
{    
    /**
     * @var string
     */
    protected $client;

    /**
     * @var string
     */
    protected $enc_data;

    /**
     * Método construtor do objeto, passando o array de dados de informação
     *
     * @param array $data Array de informações     
     */
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

    /**
     * Envia a requisição para o ENDPOINT configurado
     * e retorna um objeto de resposta GuzzleHttp
     * 
     * @return \Psr\Http\Message\ResponseInterface 
     */
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

