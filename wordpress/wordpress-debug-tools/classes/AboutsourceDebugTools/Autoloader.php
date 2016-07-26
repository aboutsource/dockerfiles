<?php

namespace AboutsourceDebugTools;


class Autoloader {


    protected $_pluginPath;

    public function __construct() {

        $this->_pluginPath = dirname(dirname(dirname(__FILE__)));
        spl_autoload_register(array($this, 'autoload'));
    }

    public function autoload($className) {


        if(strpos($className, __NAMESPACE__) === 0) {

            $className = ltrim($className, '\\');
            $fileName  = '';
            $namespace = '';
            if ($lastNsPos = strrpos($className, '\\')) {
                $namespace = substr($className, 0, $lastNsPos);
                $className = substr($className, $lastNsPos + 1);
                $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
            }
            $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
            $fullPath = $this->_pluginPath . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . $fileName;

            if(!is_readable($fullPath)) {
                throw new \RuntimeException('Could not autoload ' . $className . ' (fullpath: ' . $fullPath . ' filename: ' . $filename . ' classname: ' . $className . ' namespace: ' . $namespace   . ' )');
            }
            require $fullPath;

        }


    }


}

new Autoloader();