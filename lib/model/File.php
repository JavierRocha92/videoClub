<?php

class CustomFile {

    public $path;
    public $header;

    public function __construct($path, $header = '') {
        $this->path = $path;
        $this->header = $header;
        //Conditional to check if file with this path does not exist for creating
        if (!file_exists($this->path)) {
            //Calign function to create a file based on object path
            touch($this->path);
            //Conditional to check if file exists
            if (file_exists($this->path)) {
                //Callign function to write info into file
                $this->writeFile($this->header, 'w');
            }
        }
    }

    public function getPath() {
        return $this->path;
    }

    public function setPath($path): void {
        $this->path = $path;
    }

    public function getHeader() {
        return $this->header;
    }

    public function setHeader($header): void {
        $this->header = $header;
    }

    /**
     * Function to write info into file object
     * 
     * @param string $content
     */
    public function writeFile($content, $mode) {
        //Consitional to check if file exists
        if (file_exists($this->path)) {
            //Constional to check if value return from rhis function is set
            $resource = fopen($this->path, $mode);
            if ($resource) {
                //Calling function to write info into file
                fwrite($resource, $content);
                //Calling function to close pointer
                fclose($resource);
            }
        }
    }
}
