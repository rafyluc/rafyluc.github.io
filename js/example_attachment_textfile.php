<?php require '../class.simple_mail.php';
echo '<h1>Simple Mail</h1>';
/* @var SimpleMail $mail */
$mail = new SimpleMail();
$mail->setTo('emanueledellaporta@gmail.com', "Emanuele Della Porta")
     ->setFrom('raffaeledellaporta@gmail.com', 'Raffaele Della Porta')
     ->setSubject('This is a test message')
     ->addAttachment('dati.txt')
     ->setMessage('HALLO');
$send = $mail->send();
//echo $mail->debug();
if ($send) {
    echo 'Email sent successfully';
}
else {
    echo 'Could not send email';
}