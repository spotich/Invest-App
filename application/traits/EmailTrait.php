<?php

namespace InvestApp\application\traits;

trait EmailTrait
{
    public static function sendEmail($vars): bool
    {
        $to = $vars['to'];
        $subject = $vars['subject'];
        ob_start();
        require dirname(__DIR__, 1) . "/views/layouts/letter.php";
        $message = ob_get_clean();
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';
        $headers[] = 'From: Invest-App <popenko1337@gmail.com>';
        return mail($to, $subject, $message, implode("\r\n", $headers));
    }
}