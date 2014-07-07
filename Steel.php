<?php
/**
 * The main library file
 *
 * @author craig
 */
class Steel {

    private $_dir;
    public $lexer;

    /**
     * Construct a new Steel parser
     * @param  {String} $filename The name of the file to parse
     * @param  {String} $dir The dir to look in
     * @param  {RuleList} $r The list of rules
     */
    public function __construct($filename, $dir = "", RuleList $r = null) {
        $this->_dir = $dir;
        $this->lexer = new Lexer(new FileReader($this->_dir, $filename));
        $this->lexer->setRuleList($r);
    }

    /**
     * Run the lexer on the file or a line
     * @param  {String} $line A line to parse (Optional)
     */
    public function parse($line = false) {
        if($line != false) {
            $this->lexer->lex($line);
        } else {
            $this->lexer->lex();
        }
    }

    /**
     * Set the Rule list for this parser
     * @param {RuleList} $r The rule list object
     */
    public function setRuleList(RuleList $r) {
        $this->lexer->setRuleList($r);
    }

    /**
     * Step through the file and parse it
     */
    public function walk() {
        while(!$this->lexer->atEof()) {
            $this->parse();
        }
    }
}
