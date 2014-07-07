<?php

/**
 * Handles file inclusion and iteration
 *
 * @author craig
 */
class FileReader {

    public $file;
    private $_dir, $_filename;

    /**
     * Construct a new file reader object
     * @param  {String} $dir      Directory of file
     * @param  {String} $filename The name of the file
     */
    public function __construct($dir, $filename) {
        $this->_dir = $dir;
        $this->_filename = $filename . ".steel";
        $this->openFile();
    }

    /**
     * Check if at end of the File
     * @return {Boolean} True if at end, false otherwise
     */
    public function atEOF() {
        return feof($this->file);
    }

    /**
     * Get the next line in the file
     * @return {String} The next line in the file
     */
    public function getNextLine() {
        return fgets($this->file);
    }

    /**
     * Open a stream to the file
     */
    public function openFile() {
         $this->file = fopen($this->_dir . $this->_filename,"r");
    }

    /**
     * Close off the stream to the file
     */
    public function closeFile() {
        fclose($this->file);
    }
}
