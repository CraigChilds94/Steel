<?php

/**
 * Class to store all of the tokens
 *
 * @author craig
 */
class RuleList {
    private $_tokens;

    /**
     * Construct the list
     * @param  {Array} $list An existing list of tokens
     */
    public function __construct($list) {
        $this->_tokens = $list;
    }

    /**
     * Add a new token
     * @param {String} $key The key for the token
     * @param {Object} $f   The Value for the token
     */
    public function add($key, $f) {
        $this->_tokens[$key] = $f;
    }

    /**
     * @return {Array} Return the list of tokens
     */
    public function getTokens() {
        return $this->_tokens;
    }

    /**
     * Check if a key exists in the list
     * @param {String} $key
     * @return {Boolean} true if exists, false otherwise
     */
    public function inList($key) {
        return isset($this->_tokens[$key]) &&  !empty($this->_tokens[$key]);
    }

    /**
     * Call a token in the list as a function
     * @param  {String} $key  [description]
     * @param  {Object} $data = "hello world" This is the data passed as a parameter to the called function
     */
    public function call($key, $data = "hello world") {
        $this->_tokens[$key]($data);
    }
}
