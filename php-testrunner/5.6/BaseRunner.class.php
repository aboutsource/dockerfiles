<?php

abstract class BaseRunner {

    const EXTENSIONS = 'php,phtml';
    const EXCLUDES = '*/vendor/*';
    const PHPCS_STANDARDS = 'aboutsource-WordPress';
    const PHPMD_STANDARDS = 'cleancode,codesize,design,unusedcode';
    const PHPMD_OUTPUT = 'text';
    const DEFAULT_TIMEZONE = 'UTC';

    protected $_paths;

    public function __construct($paths) {
        $paths = is_array($paths) ? $paths : array($paths);

        $this->_paths = array_map('trim', $paths);
        $this->_paths = array_unique($this->_paths);
        $this->_paths = array_map(function($path) {
           return strpos($path, '/') === 0 ? $path : "application/wp-content/{$path}";
        }, $this->_paths);
    }

    protected function runCommand($commandTemplate, $args) {
        $exitCode = -1;
        $args = is_array($args) ? $args : array($args);
        $command = vsprintf($commandTemplate, $args);
        echo "Running command: {$command}...\n";
        system($command, $exitCode);
        return $exitCode;
    }

    abstract public function execute();
    abstract protected function showBanner();

}

