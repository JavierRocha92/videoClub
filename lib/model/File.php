<?php
/**
 * class to represent file object built by attributes such us path and header
 */
class CustomFile {
    /**
     * 
     * @var string specific path for a file in the proyect directory
     */
    public $path;
    /**
     * 
     * @var string header to write a head to file
     */
    public $header;
    /**
     * Function to create a new file by taking parameters such us path and header, by calling other function to exception manage
     * 
     * @param string $path specific path of object file in poyect directory
     * @param string $header head to write into created file
     */
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
    /**
     * Function to get object file path
     * 
     * @return string file path
     */
    public function getPath() {
        return $this->path;
    }
    /**
     * Function to get object file header
     * 
     * @return string file header
     */
    public function setPath($path): void {
        $this->path = $path;
    }
    /**
     * Funciont to set path value into file object
     * 
     * @return string
     */
    public function getHeader() {
        return $this->header;
    }
    /**
     * Funciont to set header value into file object
     * 
     * @return string
     */
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
