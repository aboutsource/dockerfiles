<?php
/**
 * @author: Robert Pritzkow <robert.pritzkow@aboutsource.net>
 */

namespace AboutsourceDebugTools;

/**
 * Direct all mail traffic via local mx host
 *
 * Make sure to link the fpm and the mx container
 *
 * Class MaildevBridge
 * @package AboutsourceDebugTools
 */
class MaildevBridge {

    protected static $_instance;
    const HOOK_ORDER = PHP_INT_MAX;

    public static function getInstance() {
        if(!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function enable() {
        add_action('phpmailer_init', array($this, 'modifyPhpMailer'), self::HOOK_ORDER);
    }

    public function disable() {
        remove_action('phpmailer_init', array($this, 'modifyPhpMailer'), self::HOOK_ORDER);
    }

    public function modifyPhpMailer(\PHPMailer $phpmailer) {
        $phpmailer->isSMTP();
        $phpmailer->SMTPAutoTLS = false;
        $phpmailer->Host = 'mx';
        $phpmailer->Port = 25;
    }

}