<?php

namespace BradescoOnline;

include('Config.php');

/**
 * Classe que abstrai a comunicação com a API do Bradesco
 *
 * @author Richard Lucas F. de Mendonça
 * @version 1.0
 * @access public
 */
class Api
{
    /**
     * @var string[]
     */
    protected $arr = [];   
    /** 
     * @var string 
     */ 
    protected $cert_path = CERT_PATH;
    /**
     * @var string
     */
    protected $cert_pass = CERT_PASS;    
    /**
     * @var string
     */
    protected $certKey;
    /**
     * @var string
     */
    protected $privateKey;
    /**
     * @var string
     */
    protected $signed;

    /**
     * Método construtor do objeto, passando o array de dados de informação
     *
     * @param array $array Array de informações
     * @return Api $this
     */
    public function __construct(array $array)
    {
        $this->set_arr($array);                       
        $this->setCertKeys();

        $this->signed = $this->encryptData($this->arr);
        return $this;        
    }

    /**
     * Retorna o corpo JSON assinado através do certificado
     *     
     * @return string
     */
    public function get_signed()
    {
        return $this->signed;
    }

    /**
     * 'Seta' as informações a serem enviadas
     *     
     * @param array $array
     */
    public function set_arr($array)
    {
        $this->arr = $array;
    }


    /**
     * Lê o certificado .pfx a partir do arquivo e senha informados
     * e recupera a chave de certificado e a chave privada
     * 
     * @return void
     */
    public function setCertKeys()
    {
        $cert_file = file_get_contents(__DIR__ . '\\' . $this->cert_path);
        if (!openssl_pkcs12_read($cert_file, $result, $this->cert_pass)) {
            throw new \Exception('Unable to read certificate file .pfx. Please check the certificate password.');
        }

        $this->certKey = openssl_x509_read($result['cert']);
        $this->privateKey = openssl_pkey_get_private($result['pkey'], $this->cert_pass);
    }

    /**
     * Encripta o corpo JSON a ser enviado a partir das informações
     * do certificado
     * 
     * @param array $data Informações a serem enviadas
     * @return string
     */
    private function encryptData($data)
    {
        $msgFile = __DIR__ . 'jsonFile';
        $signedFile = __DIR__ . 'signedFile';
        file_put_contents($msgFile, $data);

        openssl_pkcs7_sign(
            $msgFile, $signedFile, $this->certKey, $this->privateKey, [], PKCS7_BINARY | PKCS7_TEXT
        );

        $signature = file_get_contents($signedFile);
        $parts = preg_split("#\n\s*\n#Uis", $signature);
        $signedMessageBase64 = $parts[1];

        unlink($msgFile);
        unlink($signedFile);

        return $signedMessageBase64;
    }
}

