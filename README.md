Apache Tika client for Laravel 4
===================
Este es un fork al proyecto https://github.com/marcelomx/tika-client al cual se le agrego un ServiceProvider para ser instalado en Laravel 4. Espero les sirva, a mi mucho, xD

Install Java
-
```ssh
sudo apt-get -y install openjdk-7-jdk
```

Include in composer.json
-
```json
"require": {
	"kattatzu/tika-client": "1.*"
},
```

Add service provider in app/config/app.php
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

Use examples (taken from original documentation)
-

```php
    // se obtiene una instancia de la clase (más adelante implementare Facades)
    $tika = new TikaClient();

    // Obtener el texto plano de un documento
    $text = $tika->getText('file.doc');

    // Obtener el contenido de un documento en formato HTML
    $html = $tika->getHtml('file.doc');

    // Obtener el contenido de un documento en formato XHTML
    $xhtml = $tika->getXhtml('file.doc');

    // Get language
    $lang = $tika->getLanguage('file.doc');

    // Obtener el content-type de un documento
    $type = $tika->getContentType('file.doc');

    // Extraer todos los attachments de un archivo word
    $target = '/tmp/'; // target directory
    $tika->extract('file.doc', $target);
```

Si prefieres, puedes usar TikaWrapper para encapsular todas las operaciones del mismo archivo, ejemplo:

```php
    use Kattatzu\TikaClient\TikaWrapper;
    
    $wrapper = new TikaWrapper('file.doc', $tika);

    // Get text
    $text = $wrapper->getText();

    // Get html text
    $html = $wrapper->getHtml();

    // Get xhtml text
    $xhtml = $wrapper->getXhtml();

    // Get language
    $lang = $wrapper->getLanguage();

    // Get content type
    $type = $wrapper->getContentType('file.doc');
```
