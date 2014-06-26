Cliente de Apache Tika para Laravel
===================

Instalar Java
-
sudo apt-get -y install openjdk-7-jdk

Incluir en composer.json
-
```json
"require": {
	"kattatzu/tika-client": "1.*"
},
```

Agregar en app/config/app.php
-
```php
'providers' => array(
	'Kattatzu\TikaClient\TikaClientServiceProvider'
),
```

y

```php
'aliases' => array(
	'TikaClient' 	  => 'Kattatzu\TikaClient\TikaClient'
),
```
