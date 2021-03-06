<?php

require_once '../src/BradescoClient.php';
use BradescoOnline\BradescoClient;

// $data = [
//     "nuCPFCNPJ" => "123456789",
//     "filialCPFCNPJ" => "0001",
//     "ctrlCPFCNPJ" => "39",
//     "cdTipoAcesso" => "2",
//     "clubBanco" => "0",
//     "cdTipoContrato" => "0",
//     "nuSequenciaContrato" => "0",
//     "idProduto" => "09",
//     "nuNegociacao" => "123400000001234567",
//     "cdBanco" => "237",
//     "eNuSequenciaContrato" => "0",
//     "tpRegistro" => "1",
//     "cdProduto" => "0",
//     "nuTitulo" => "0",
//     "nuCliente" => "123456",
//     "dtEmissaoTitulo" => "25.05.2017",
//     "dtVencimentoTitulo" => "20.06.2017",
//     "tpVencimento" => "0",
//     "vlNominalTitulo" => "100",
//     "cdEspecieTitulo" => "04",
//     "tpProtestoAutomaticoNegativacao" => "0",
//     "prazoProtestoAutomaticoNegativacao" => "0",
//     "controleParticipante" => "",
//     "cdPagamentoParcial" => "",
//     "qtdePagamentoParcial" => "0",
//     "percentualJuros" => "0",
//     "vlJuros" => "0",
//     "qtdeDiasJuros" => "0",
//     "percentualMulta" => "0",
//     "vlMulta" => "0",
//     "qtdeDiasMulta" => "0",
//     "percentualDesconto1" => "0",
//     "vlDesconto1" => "0",
//     "dataLimiteDesconto1" => "",
//     "percentualDesconto2" => "0",
//     "vlDesconto2" => "0",
//     "dataLimiteDesconto2" => "",
//     "percentualDesconto3" => "0",
//     "vlDesconto3" => "0",
//     "dataLimiteDesconto3" => "",
//     "prazoBonificacao" => "0",
//     "percentualBonificacao" => "0",
//     "vlBonificacao" => "0",
//     "dtLimiteBonificacao" => "",
//     "vlAbatimento" => "0",
//     "vlIOF" => "0",
//     "nomePagador" => "Cliente Teste",
//     "logradouroPagador" => "rua Teste",
//     "nuLogradouroPagador" => "90",
//     "complementoLogradouroPagador" => "",
//     "cepPagador" => "12345",
//     "complementoCepPagador" => "500",
//     "bairroPagador" => "bairro Teste",
//     "municipioPagador" => "Teste",
//     "ufPagador" => "SP",
//     "cdIndCpfcnpjPagador" => "1",
//     "nuCpfcnpjPagador" => "12345648901234",
//     "endEletronicoPagador" => "",
//     "nomeSacadorAvalista" => "",
//     "logradouroSacadorAvalista" => "",
//     "nuLogradouroSacadorAvalista" => "0",
//     "complementoLogradouroSacadorAvalista" => "",
//     "cepSacadorAvalista" => "0",
//     "complementoCepSacadorAvalista" => "0",
//     "bairroSacadorAvalista" => "",            
//     "municipioSacadorAvalista" => "",
//     "ufSacadorAvalista" => "",
//     "cdIndCpfcnpjSacadorAvalista" => "0",
//     "nuCpfcnpjSacadorAvalista" => "0",
//     "endEletronicoSacadorAvalista" => ""
// ];
$data = [
    "nuCPFCNPJ"=>"005492078",
    "filialCPFCNPJ"=>"0001",
    "ctrlCPFCNPJ"=>"94",
    "cdTipoAcesso"=>"2",
    "clubBanco"=>"0",
    "cdTipoContrato"=>"0",
    "nuSequenciaContrato"=>"0",
    "idProduto"=>"09",
    "nuNegociacao"=>"221800000000017970",
    "cdBanco"=>"237",
    "eNuSequenciaContrato"=>"0",
    "tpRegistro"=>"1",
    "cdProduto"=>"0",
    "nuTitulo"=>"0",
    "nuCliente"=>"123456",
    "dtEmissaoTitulo"=>"12.06.2021",
    "dtVencimentoTitulo"=>"20.06.2021",
    "tpVencimento"=>"0",
    "vlNominalTitulo"=>"1000",
    "cdEspecieTitulo"=>"02",
    "tpProtestoAutomaticoNegativacao"=>"0",
    "prazoProtestoAutomaticoNegativacao"=>"0",
    "controleParticipante"=>"",
    "cdPagamentoParcial"=>"",
    "qtdePagamentoParcial"=>"0",
    "percentualJuros"=>"0",
    "vlJuros"=>"0",
    "qtdeDiasJuros"=>"0",
    "percentualMulta"=>"0",
    "vlMulta"=>"0",
    "qtdeDiasMulta"=>"0",
    "percentualDesconto1"=>"0",
    "vlDesconto1"=>"0",
    "dataLimiteDesconto1"=>"",
    "percentualDesconto2"=>"0",
    "vlDesconto2"=>"0",
    "dataLimiteDesconto2"=>"",
    "percentualDesconto3"=>"0",
    "vlDesconto3"=>"0",
    "dataLimiteDesconto3"=>"",
    "prazoBonificacao"=>"0",
    "percentualBonificacao"=>"0",
    "vlBonificacao"=>"0",
    "dtLimiteBonificacao"=>"",
    "vlAbatimento"=>"0",
    "vlIOF"=>"0",
    "nomePagador"=>"EUDES RODRIGUES SILVA",
    "logradouroPagador"=>"AV DOM PEDRO II",
    "nuLogradouroPagador"=>"628",
    "complementoLogradouroPagador"=>"",
    "cepPagador"=>"65900",
    "complementoCepPagador"=>"734",
    "bairroPagador"=>"UNIAO",
    "municipioPagador"=>"IMPERATRIZ",
    "ufPagador"=>"MA",
    "cdIndCpfcnpjPagador"=>"1",
    "nuCpfcnpjPagador"=>"40182436349",
    "endEletronicoPagador"=>"",
    "nomeSacadorAvalista"=>"",
    "logradouroSacadorAvalista"=>"",
    "nuLogradouroSacadorAvalista"=>"0",
    "complementoLogradouroSacadorAvalista"=>"",
    "cepSacadorAvalista"=>"0",
    "complementoCepSacadorAvalista"=>"0",
    "bairroSacadorAvalista"=>"",
    "municipioSacadorAvalista"=>"",
    "ufSacadorAvalista"=>"",
    "cdIndCpfcnpjSacadorAvalista"=>"0",
    "nuCpfcnpjSacadorAvalista"=>"0",
    "endEletronicoSacadorAvalista"=>""
];

$api = new BradescoClient($data);
$response = $api->send_request();

echo $response;