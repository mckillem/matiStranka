<?php

/**
 * Created by PhpStorm.
 * User: matej
 * Date: 08/06/16
 * Time: 09:13
 */
class EmailsSender
{
    public function send($to, $subject, $message, $from)
    {
        $head = "From: " . $from;
        $head .= "\nMIME-Version: 1.0\n";
        $head .= "Content-Type: text/html; charset=\"utf-8\"\n";
        if (!mb_send_mail($to, $subject, $message, $head))
            throw new UserError('Email se nepodařilo odeslat.');
    }

    public function sendWithAntispam($year, $to, $subject, $message, $from)
    {
        if ($year != date("Y"))
            throw new UserError('Chybně vyplněný antispam.');
        $this->send($to, $subject, $message, $from);
    }
}