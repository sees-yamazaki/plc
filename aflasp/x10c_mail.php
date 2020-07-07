<?php

function sendMailFromAdmin($to, $subject, $message)
{
    $sys = getSystem();
    $subject2 = "【".$sys->site_title."】".$subject;
    $headers = 'From:"'.mb_encode_mimeheader($sys->mail_name).'" <'. trim($sys->mail_address).'>';
    mb_send_mail($to, $subject2, $message, $headers);
}

function sendMail4Admin($sys, $subject, $message)
{
    //$sys = getSystem();
    $to = $sys->mail_address;
    $subject2 = "【".$sys->site_title."】".$subject;
    $headers = 'From:"'.mb_encode_mimeheader($sys->mail_name).'" <'. trim($sys->mail_address).'>';
    mb_send_mail($to, $subject2, $message, $headers);
}
