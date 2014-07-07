<?php

// Set error reporting
error_reporting(E_ALL);

// Load any class that is called
function __autoload($class) {
    include_once $class . ".php";
}

// Create a new Steel object taking the dir and a token list of our rules
$parser = new Steel('test', '', new RuleList(array(
    // Language / Grammar parsing
    "run" => function($data) {
        echo "run : " . $data->param . "\n";

        // Enables grammar
        // e.g. r = run justin|cheese|cake
        $parser = new Steel('test', '', new RuleList(array(
            "justin" => function($data) {
                echo "justin : " . $data->param . "\n";
            },

            "cheese" => function($data) {
                echo "cheese\n";
            },

            "cake" => function($data) {
                echo "poo\n";
            }
        )));

        // Parse any trailing information
        $parser->parse($data->rest);
    },

    // Potential use for calling functions
    "call" => function($data) {
        $info = $data->rest;

        // means extra arguments
        if(is_array($info) && count($info) == 2) {
            if(function_exists($info[0])) {
                $info[0]($info[1]);
            }
        }
    }
)));

// Walk through the input
$parser->walk();

/**
 * Callable function, for testing the call keyword
 * @param  {String} $stuff
 */
function println($stuff) {
    echo $stuff;
    echo "\n";
}
