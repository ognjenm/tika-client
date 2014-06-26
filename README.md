Cliente de Apache Tika para Laravel
===================
Este es un fork al proyecto https://github.com/marcelomx/tika-client al cual se le agrego un ServiceProvider para ser instalado en Laravel 4. Espero les sirva, a mi mucho, xD

Instalar Java
-
```ssh
sudo apt-get -y install openjdk-7-jdk
```

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
