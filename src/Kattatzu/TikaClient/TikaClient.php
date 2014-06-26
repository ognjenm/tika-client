<?php namespace Kattatzu\TikaClient;

use Symfony\Component\Process\Process;

class TikaClient
{
    const OUTPUT_FORMAT_TEXT   = 'text';    
    const OUTPUT_FORMAT_XHTML  = 'xml';
    const OUTPUT_FORMAT_HTML   = 'html';
    const OUTPUT_METADATA      = 'metadata';
    const OUTPUT_METADATA_JSON = 'json';
    const OUTPUT_CONTENT_TYPE  = 'detect';
    const OUTPUT_LANGUAGE      = 'language';
    const OUTPUT_EXTRACT       = 'extract';
    const OUTPUT_EXTRACT_DIR   = 'extract-dir';
    const OUTPUT_PRETTY_PRINT  = 'pretty-print';


    /**
     * Tika jar file or url to server
     *
     * @var string
     */
    protected $endPoint;

    /**
     * @param string $endPoint
     */
    public function __construct($endPoint = null)
    {
        $this->endPoint = $endPoint;
    }

    /**
     * Return end point to Apache Tika app
     *
     * @return string
     */
    public function getEndPoint()
    {
        if (!$this->endPoint) {
             $this->endPoint = realpath(__DIR__ . '/bin/tika-app-1.4.jar');
        }

        return $this->endPoint;
    }

    /**
     * @param string $source
     * @param string $format
     *
     * @return string
     * @throws \InvalidArgumentException
     */
    public function getText($resource)
    {
        $text = $this->execute($resource, static::OUTPUT_FORMAT_TEXT);

        return $text;
    }

    /**
     * @param string $resource
     * @return string
     */
    public function getXhtml($resource)
    {
        $xhtml = $this->execute($resource, array(static::OUTPUT_FORMAT_XHTML, static::OUTPUT_PRETTY_PRINT));

        return $xhtml;
    }

    /**
     * @param string $resource
     * @return string
     */
    public function getHtml($resource)
    {
        $html = $this->execute($resource, array(static::OUTPUT_FORMAT_HTML, static::OUTPUT_PRETTY_PRINT));

        return $html;
    }

    /**
     * Returns document metadata
     *
     * @param  string $resource
     * @return array
     */
    public function getMetadata($resource)
    {
        $metadata = $this->execute($resource, static::OUTPUT_METADATA_JSON);

        return json_decode($metadata, true);
    }

    /**
     * Detect resource mimetype
     *
     * @param string $resource     
     * @return string
     */
    public function getContentType($resource)
    {
        $type = trim($this->execute($resource, static::OUTPUT_CONTENT_TYPE));   

        return $type;
    }

    /**
     * Extract all attachments from resource
     *
     * @param string $resource
     * @param string $target
     *
     * @return string
     */
    public function extract($resource, $target = null)
    {
        $output = $this->execute($resource, array(static::OUTPUT_EXTRACT, static::OUTPUT_EXTRACT_DIR => $target));

        return $output;
    }

    /**
     * Detect language
     *
     * @param  string $resource
     * @return string
     */
    public function getLanguage($resource)
    {
        $language = trim($this->execute($resource, static::OUTPUT_LANGUAGE));

        return $language;
    }

    /**
     * @param string $resource
     * @param array  $parameters
     *
     * @return string
     * @throws \RuntimeException
     */
    public function execute($resource, $options = '')
    {
        $command = "java -jar " . $this->getEndPoint();

        // Add shell arguments
        if (!is_array($options)) {
            $options = array($options);
        }
        foreach ($options as $key => $value) {
            $command .= is_numeric($key) ? " --$value" : " --$key=" . $value;
        }
        $command .= ' ' . $resource;

        return $this->runProcess($command);
    }

    /**
     * @param string $command
     * @return string
     *
     * @throws \RuntimeException
     */
    protected function runProcess($command)
    {
        $process = new Process($command);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new \InvalidArgumentException($process->getErrorOutput());
        }

        return $process->getIncrementalOutput();
    }
}