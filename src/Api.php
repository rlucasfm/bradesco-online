<?php

namespace BradescoOnline;

include('Config.php');

class Api
{
    protected $arr = [];    
    protected $cert_path = CERT_PATH;
    protected $cert_pass = CERT_PASS;    
    protected $certKey;
    protected $privateKey;
    protected $signed;

    public function __construct(array $array)
    {
        $this->set_arr($array);                       
        $this->setCertKeys();

        $this->signed = $this->encryptData($this->arr);
        return $this;        
    }

    public function get_signed()
    {
        return $this->signed;
    }

    public function set_arr($array)
    {
        $this->arr = $array;
    }


    public function setCertKeys()
    {
        $cert_file = file_get_contents(__DIR__ . '\\' . $this->cert_path);
        if (!openssl_pkcs12_read($cert_file, $result, $this->cert_pass)) {
            throw new \Exception('Unable to read certificate file .pfx. Please check the certificate password.');
        }

        $this->certKey = openssl_x509_read($result['cert']);
        $this->privateKey = openssl_pkey_get_private($result['pkey'], $this->cert_pass);
    }

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

