<?php 

define('ENDPOINT', 'https://cobranca.bradesconetempresa.b.br/ibpjregistrotitulows/registrotitulohomologacao');  
define('CERT_PATH', 'nomedoarquivocertificado.pfx'); // Insira o nome do seu arquivo certificado. Coloque-o dentro da pasta src  
define('CERT_PASS', '123456'); // A senha do certificado .pfx aqui
define('TIMEOUT', 30);  
define('CACERTPATH', "C:\wamp64\bin\php\php7.4.9\\extras\ssl\cacert.pem"); // Edite para onde estiverem os seus certificados. Não é necessário. 
