<?php
/**
 * @author: Robert Pritzkow <robert.pritzkow@aboutsource.net>
 */

namespace AboutsourceDebugTools;


class VarDumpPretty {

    protected $_returnResult, $_htmlMode, $_prependOrigin;

    public function __construct($returnResult = false, $prependOrigin = false, $htmlMode = true) {
        $this->_returnResult = $returnResult;
        $this->_prependOrigin = $prependOrigin;
        $this->_htmlMode = $htmlMode;
    }

    protected function _printArgs($args) {
        $stream = fopen('php://memory', 'w+');
        foreach($args as $arg) {
            fwrite($stream, print_r($arg, true));
        }
        rewind($stream);
        $data = fread($stream, fstat($stream)['size']);
        fclose($stream);
        return $data;
    }

    protected function _wrapArgs($args) {
        $output = $this->_printArgs($args);
        $origin = '';
        if($this->_prependOrigin) {
            $origin = $this->_getOrigin();
            $origin = $this->_htmlMode ? "<strong>{$origin}</strong><br/>" : $origin;
        }

        if($this->_htmlMode) {
            $output = "{$origin}<pre>{$output}</pre>";
        }
        else {
            $output = $origin .' ' . $output;
        }
        return $output;
    }

    protected function _getOrigin() {
        $backtrace = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 10);
        $trace = NULL;
        foreach($backtrace as $entry) {
            if(isset($entry['file']) && strpos($entry['file'], __NAMESPACE__) === FALSE) {
                $trace = $entry;
                break;
            }
        }
        return $trace ? $entry['file'] . ':' . $entry['line'] : 'Unknown location';

    }

    /**
     * Pretty print
     *
     * @return string
     */
    public function dump() {
        $output = $this->_wrapArgs(func_get_args());
        if($this->_returnResult) {
            return $output;
        }
        else {
            echo $output;
        }
    }

    /**
     * Pretty print and exit (output-mode only)
     */
    public function dumpExit() {
        echo $this->_wrapArgs(func_get_args());
        exit();
    }

    /**
     * Pretty print via HTTP Header
     */
    public function header() {
        $this->_htmlMode = false;
        $this->_returnResult = true;
        $header = str_replace("\n", " ", $this->_printArgs(func_get_args()));
        header('X-WordPress-Debug: ' . $header);
    }

    public function error() {
        $oldValue = ini_set('display_errors', '0');
        $args = func_get_args();
        if($this->_prependOrigin) {
            trigger_error($this->_getOrigin(), E_USER_WARNING);
        }
        foreach($args as $arg)  {
            trigger_error(print_r($arg, true), E_USER_WARNING);
        }
        ini_set('display_errors', $oldValue);
    }
}
