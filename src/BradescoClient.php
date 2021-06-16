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
            // $response = $this->client->request('POST', '', ['body' => $this->enc_data]);
            $response = $this->client_request($this->enc_data);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return $response;
    }

    private function client_request($post_data)
    {
        $ch = curl_init(ENDPOINT);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $retorno = curl_exec($ch);
        if (curl_errno($ch)) {
            $info = curl_getinfo($ch);
            throw new \Exception('Não foi possível registrar o boleto. ' . 'Erro:' . curl_errno($ch) . '.<br>' . $info);
        }

        $doc = new \DOMDocument();
        $doc->loadXML($retorno);
        $retorno = $doc->getElementsByTagName('return')->item(0)->nodeValue;
        $retorno = preg_replace('/, }/i', '}', $retorno); 
        $retorno = json_decode($retorno);
        
        echo "RETORNO<br>";
        print_r($retorno);
        
        if (!empty($retorno->cdErro)) {
            throw new \Exception('Não foi possível registrar o boleto. ' . $retorno->msgErro);
        }
    }
}

