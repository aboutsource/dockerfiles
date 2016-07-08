<?php

abstract class BaseRunner {

    const EXTENSIONS = 'php,phtml';
    const EXCLUDES = '*/vendor/*';
    const PHPCS_STANDARDS = 'aboutsource-WordPress';
    const PHPMD_STANDARDS = 'cleancode,codesize,design,unusedcode';
    const PHPMD_OUTPUT = 'text';
    const DEFAULT_TIMEZONE = 'UTC';

    protected $_paths;
    protected $_options;

    public function __construct($argv) {

        $paths = array_filter(array_slice($argv, 1), function($arg) {
            return strpos($arg, '--') !== 0;
        });

        $paths = is_array($paths) ? $paths : [$paths];

        $this->_paths = array_map('trim', $paths);
        $this->_paths = array_unique($this->_paths);
        $this->_paths = array_map(function($path) {
           return strpos($path, '/') === 0 ? $path : "application/wp-content/{$path}";
        }, $this->_paths);

        $this->_options = getopt('', $this->getOptionDefinition());

        // non-value options are saved with value 'false' when they are set
        foreach($this->getOptionDefinition() as $def) {
            if(strpos($def, ':') === false && array_key_exists($def, $this->_options) && $this->_options[$def] === false) {
                $this->_options[$def] = true;
            }
        }
    }

    protected function runCommand($commandTemplate, $args) {
        $exitCode = -1;
        $args = is_array($args) ? $args : array($args);
        $command = vsprintf($commandTemplate, $args);
        echo "* Running command: {$command}...\n";
        system($command, $exitCode);
        echo "* Command exited with code {$exitCode}\n";
        return $exitCode;
    }

    protected function getOption($key, $default = null)
    {
        return isset($this->_options[$key]) ? $this->_options[$key] : $default;
    }

    abstract public function execute();
    abstract protected function showBanner();
    abstract protected function getOptionDefinition();

}

