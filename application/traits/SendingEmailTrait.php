<?php

namespace InvestApp\application\traits;

trait SendingEmailTrait
{
    private function sendEmail($vars): bool
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

    private function sendVerificationEmail(string $email, string $verificationCode): bool
    {
        $emailVars = [
            'to' => $email,
            'subject' => 'Email verification',
            'title' => 'Verify your email',
            'content' => 'Someone was trying to enter your account. If it was you, follow the link below.',
            'link_href' => PROTOCOL . '//' . HOSTNAME . '/verify/' . $verificationCode,
            'link_text' => 'Verify',
        ];
        return $this->sendEmail($emailVars);
    }

    private function sendRecoverEmail(string $email, string $recoveryCode): bool
    {
        $emailVars = [
            'to' => $email,
            'subject' => 'Password recovery',
            'title' => 'Recover password',
            'content' => 'Did you forget your password? If so, follow the link below.',
            'link_href' => PROTOCOL . '//' . HOSTNAME . '/recover/' . $recoveryCode,
            'link_text' => 'Recover',
        ];
        return $this->sendEmail($emailVars);
    }
}