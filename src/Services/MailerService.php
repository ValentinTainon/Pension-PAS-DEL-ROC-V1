<?php

namespace App\Services;

use Symfony\Component\Mailer\MailerInterface;
Use Symfony\Component\Mime\Email;

class MailerService
{
    public function __construct (private MailerInterface $mailer) {

    }
    
    public function sendEmail(
        $from = '',
        $to = 'pensionpasdelroc@gmail.com',
        $subject = '',
        $content = '',
        ): void{
            $email = (new Email())
            ->from($from)
            ->to($to)
            ->subject($subject)
            ->text($content);
            $this->mailer->send($email);
        }
}