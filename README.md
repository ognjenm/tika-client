tika-client-laravel
===================

Instalar Java
sudo apt-get -y install openjdk-7-jdk

Incluir en composer.json
"require": {
	"kattatzu/tika-client": "1.*"
},

Agregar en app/config/app.php
'providers' => array(
	'Kattatzu\TikaClient\TikaClientServiceProvider'
),

y

'aliases' => array(
	'TikaClient' 	  => 'Kattatzu\TikaClient\TikaClient'
),