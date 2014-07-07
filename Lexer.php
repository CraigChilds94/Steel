<?php
/**
 * Description of Lexer
 *
 * @author craig
 */
class Lexer {

    private $_reader, $_current;
    public $rules;

    /**
     * Construct the lexer with a new FileReader
     * @param  {FileReader} $reader
     */
    public function __construct(FileReader $reader) {
        $this->_reader = $reader;
    }

    /**
     * Set the rule list for this lexer
     * @param {RuleList} $r
     */
    public function setRuleList(RuleList $r) {
        $this->rules = $r;
    }

    /**
     * Check if the lexer is at the end of the file
     * @return {Boolean} true if at end, false otherwise
     */
    public function atEOF() {
        return $this->_reader->atEOF();
    }

    /**
     * Lex a given string
     * @param  {String} $words The stuff to lex
     */
    public function lex($words = false) {
        if($words == false) {
            $words = explode(" ", trim($this->_reader->getNextLine()));
        }

        $param = "";

        if(count(explode(":", $words[0]) == 2)) {
            $temp = explode(":", $words[0]);
            if(count($temp) > 1) {
                $param = $temp[1];
            }
            $words[0] = $temp[0];
        }

        if($this->rules->inList($words[0])) {
            $this->rules->call($words[0], (object)array(
                    "rest" => (count($words) > 1 ? array_slice($words, 1): $words[0]),
                    "param" => ($param ? $param : false)
            ));
        } else {
            if($this->rules->inList("*")) {
                //$this->rules->call("*", $words, $param);
            }
        }
    }

    /**
     * Close the file
     */
    public function closeFile() {
        $this->_reader->closeFile();
    }
}
