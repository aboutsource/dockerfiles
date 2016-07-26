<?php

/**
 * @param bool $return
 * @param bool $prependOrigin
 * @param bool $htmlMode
 *
 * @return \AboutsourceDebugTools\VarDumpPretty
 */
function _vd($return = false, $prependOrigin = false, $htmlMode = true) {
    return new AboutsourceDebugTools\VarDumpPretty($return, $prependOrigin, $htmlMode);
}

/**
 * @return \AboutsourceDebugTools\MaildevBridge
 */
function _mx_catchall() {
    return AboutsourceDebugTools\MaildevBridge::getInstance();
}