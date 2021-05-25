# bradesco-online

SDK PHP para registros de boletos online Bradesco, a partir da API disponibilizada pela mesma.

## Requisitos
* PHP >= 7.3

## Instalação
Via Composer
```bash
composer require rlucasfm/bradesco-online
```
## Parâmetros
Parâmetro | Obrigatório | Padrão | Comentário
------------ | ------------- | ------------- | -------------
ENDPOINT | Sim | "https://cobranca.bradesconetempresa.b.br/ibpjregistrotitulows/registrotitulohomologacao" | 
CERT_PATH | Sim | nomedoarquivocertificado.pfx | Nome do certificado PKCS#7 em formato .pfx, deverá ser colocado dentro da pasta "vendor/rlucasfm/bradesco-online/src"
CERT_PASS | Sim | 123456 | Utilizar ambiente de Homologação (true) ou Produção (false)
TIMEOUT | Não | 30 | Timeout em segundos para estabelecer conexão com a API (Não está sendo utilizado ainda)
CACERTPATH | Não | "C:\wamp64\bin\php\php7.4.9\\extras\ssl\cacert.pem" | Caminho para os certificados SSL, para garantir conexão HTTPS. (Não está sendo utilizado ainda. Verificação do CURL está desativada).

## Como usar
1) Os parâmetros podem ser definidos no arquivo ```Config.php```, dentro de "vendor/rlucasfm/bradesco-online/src":
```php
define('ENDPOINT', 'https://cobranca.bradesconetempresa.b.br/ibpjregistrotitulows/registrotitulohomologacao');  
define('CERT_PATH', 'nomedoarquivocertificado.pfx');
define('CERT_PASS', '123456');
define('TIMEOUT', 30);  
define('CACERTPATH', "C:\wamp64\bin\php\php7.4.9\\extras\ssl\cacert.pem");

```
2) Crie um `array` com as informações conforme a documentação do Bradesco:
```php
$data = [
    "nuCPFCNPJ" => "123456789",
    "filialCPFCNPJ" => "0001",
    "ctrlCPFCNPJ" => "39",
    "cdTipoAcesso" => "2",
    "clubBanco" => "0",
    "cdTipoContrato" => "0",
    "nuSequenciaContrato" => "0",
    "idProduto" => "09",
    "nuNegociacao" => "123400000001234567",
    "cdBanco" => "237",
    "eNuSequenciaContrato" => "0",
    "tpRegistro" => "1",
    "cdProduto" => "0",
    "nuTitulo" => "0",
    "nuCliente" => "123456",
    "dtEmissaoTitulo" => "25.05.2017",
    "dtVencimentoTitulo" => "20.06.2017",
    "tpVencimento" => "0",
    "vlNominalTitulo" => "100",
    "cdEspecieTitulo" => "04",
    "tpProtestoAutomaticoNegativacao" => "0",
    "prazoProtestoAutomaticoNegativacao" => "0",
    "controleParticipante" => "",
    "cdPagamentoParcial" => "",
    "qtdePagamentoParcial" => "0",
    "percentualJuros" => "0",
    "vlJuros" => "0",
    "qtdeDiasJuros" => "0",
    "percentualMulta" => "0",
    "vlMulta" => "0",
    "qtdeDiasMulta" => "0",
    "percentualDesconto1" => "0",
    "vlDesconto1" => "0",
    "dataLimiteDesconto1" => "",
    "percentualDesconto2" => "0",
    "vlDesconto2" => "0",
    "dataLimiteDesconto2" => "",
    "percentualDesconto3" => "0",
    "vlDesconto3" => "0",
    "dataLimiteDesconto3" => "",
    "prazoBonificacao" => "0",
    "percentualBonificacao" => "0",
    "vlBonificacao" => "0",
    "dtLimiteBonificacao" => "",
    "vlAbatimento" => "0",
    "vlIOF" => "0",
    "nomePagador" => "Cliente Teste",
    "logradouroPagador" => "rua Teste",
    "nuLogradouroPagador" => "90",
    "complementoLogradouroPagador" => "",
    "cepPagador" => "12345",
    "complementoCepPagador" => "500",
    "bairroPagador" => "bairro Teste",
    "municipioPagador" => "Teste",
    "ufPagador" => "SP",
    "cdIndCpfcnpjPagador" => "1",
    "nuCpfcnpjPagador" => "12345648901234",
    "endEletronicoPagador" => "",
    "nomeSacadorAvalista" => "",
    "logradouroSacadorAvalista" => "",
    "nuLogradouroSacadorAvalista" => "0",
    "complementoLogradouroSacadorAvalista" => "",
    "cepSacadorAvalista" => "0",
    "complementoCepSacadorAvalista" => "0",
    "bairroSacadorAvalista" => "",            
    "municipioSacadorAvalista" => "",
    "ufSacadorAvalista" => "",
    "cdIndCpfcnpjSacadorAvalista" => "0",
    "nuCpfcnpjSacadorAvalista" => "0",
    "endEletronicoSacadorAvalista" => ""
];
```

3) Em seguida, instancie o pacote em seu projeto passando o `array` com as informações:
```php 
use BradescoOnline\BradescoClient;
$api = new BradescoClient($data);
```

4) Realize a requisição através da seguinte função:
```php
$response = $api->send_request();
```

A variável `$response` é um objeto Response do GuzzleHTTP. Para acessar o corpo da resposta, use:
```php
$response->getBody();
```

## Exemplo de implementação
```php
require 'vendor/autoload.php';

use BradescoOnline\BradescoClient;

$data = [
    "nuCPFCNPJ" => "123456789",
    "filialCPFCNPJ" => "0001",
    "ctrlCPFCNPJ" => "39",
    "cdTipoAcesso" => "2",
    "clubBanco" => "0",
    "cdTipoContrato" => "0",
    "nuSequenciaContrato" => "0",
    "idProduto" => "09",
    "nuNegociacao" => "123400000001234567",
    "cdBanco" => "237",
    "eNuSequenciaContrato" => "0",
    "tpRegistro" => "1",
    "cdProduto" => "0",
    "nuTitulo" => "0",
    "nuCliente" => "123456",
    "dtEmissaoTitulo" => "25.05.2017",
    "dtVencimentoTitulo" => "20.06.2017",
    "tpVencimento" => "0",
    "vlNominalTitulo" => "100",
    "cdEspecieTitulo" => "04",
    "tpProtestoAutomaticoNegativacao" => "0",
    "prazoProtestoAutomaticoNegativacao" => "0",
    "controleParticipante" => "",
    "cdPagamentoParcial" => "",
    "qtdePagamentoParcial" => "0",
    "percentualJuros" => "0",
    "vlJuros" => "0",
    "qtdeDiasJuros" => "0",
    "percentualMulta" => "0",
    "vlMulta" => "0",
    "qtdeDiasMulta" => "0",
    "percentualDesconto1" => "0",
    "vlDesconto1" => "0",
    "dataLimiteDesconto1" => "",
    "percentualDesconto2" => "0",
    "vlDesconto2" => "0",
    "dataLimiteDesconto2" => "",
    "percentualDesconto3" => "0",
    "vlDesconto3" => "0",
    "dataLimiteDesconto3" => "",
    "prazoBonificacao" => "0",
    "percentualBonificacao" => "0",
    "vlBonificacao" => "0",
    "dtLimiteBonificacao" => "",
    "vlAbatimento" => "0",
    "vlIOF" => "0",
    "nomePagador" => "Cliente Teste",
    "logradouroPagador" => "rua Teste",
    "nuLogradouroPagador" => "90",
    "complementoLogradouroPagador" => "",
    "cepPagador" => "12345",
    "complementoCepPagador" => "500",
    "bairroPagador" => "bairro Teste",
    "municipioPagador" => "Teste",
    "ufPagador" => "SP",
    "cdIndCpfcnpjPagador" => "1",
    "nuCpfcnpjPagador" => "12345648901234",
    "endEletronicoPagador" => "",
    "nomeSacadorAvalista" => "",
    "logradouroSacadorAvalista" => "",
    "nuLogradouroSacadorAvalista" => "0",
    "complementoLogradouroSacadorAvalista" => "",
    "cepSacadorAvalista" => "0",
    "complementoCepSacadorAvalista" => "0",
    "bairroSacadorAvalista" => "",            
    "municipioSacadorAvalista" => "",
    "ufSacadorAvalista" => "",
    "cdIndCpfcnpjSacadorAvalista" => "0",
    "nuCpfcnpjSacadorAvalista" => "0",
    "endEletronicoSacadorAvalista" => ""
];

$api = new BradescoClient($data);
$response = $api->send_request();

echo $response->getBody();
```