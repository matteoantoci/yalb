<?php
/**
 * Created by Matteo Antoci
 * Date: 15/12/13
 * Time: 15.13
 */

class Plassets {

    const YEAR = 31536000;

    protected $fileName;
    protected $extension;
    protected $filePath;
    protected $contentType;

    protected $contentTypes = array(
        'css' => 'text/css',
        'js' => 'application/javascript',
        'svg' => "image/svg+xml",
        'ttf' => "application/x-font-ttf",
        'otf' => "application/x-font-opentype",
        'woff' => "application/font-woff",
        'eot' => "application/vnd.ms-fontobject",
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'gif' => 'image/gif',
        'png' => 'image/png',
    );

    function __construct($fileName, $ext){
        $this->fileName = $fileName;
        $this->extension = $ext;
        $this->filePath = $fileName . '.' . $ext;
        $this->contentType = $this->contentTypes[$ext];
    }

    function isSafe(){
        return file_exists($this->filePath);
    }

    function isBinary()
    {
        if($this->extension != 'css' && $this->extension != 'js'){
            return true;
        }

        return false;
    }

    function getHeaders()
    {
        return array(
            'pragma' => 'cache',
            'age' => self::YEAR,
            'cache-control' => 'max-age=' . self::YEAR . ', public, must-revalidate',
            'expires' => gmdate('D, d M Y H:i:s \G\M\T', $_SERVER['REQUEST_TIME'] + self::YEAR),
            'content-type' => $this->contentType . '; charset: UTF-8',
            'Etag' => md5_file($this->filePath)
        );
    }

    function render(){
        readfile($this->filePath);
    }

} 