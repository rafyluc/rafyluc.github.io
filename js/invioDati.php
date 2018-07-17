<?php

 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
 require "..//PHPMailer-master//src//PHPMailer.php";
 require "..//PHPMailer-master//src//Exception.php";
 require "..//PHPMailer-master//src//SMTP.php";
 //$messaggioPHP = new PHPMailer\PHPMailer\PHPMailer();
 $nome = $_POST['name'];
 $email = $_POST['email'];
 $numero = $_POST['phone'];
 /*$receivers = implode(' ,', [
    'Giuseppe Polese <gpolese@unisa.it>',
    'Loredana Caruccio <lcaruccio@unisa.it>',
    'Vincenzo Deufemia<deufemia@unisa.it>',
]);*/
//$mail_destinatario="r.dellaporta5@studenti.unisa.it";
 
 //$subject="Assistenza"; 
 $messaggio = $_POST['message'];
 $data = date("d/m/Y", time());
 $error="true";

/*$mail_headers = "From: " .  $nome . " <" .  $email . ">\r\n";
$mail_headers .= "Reply-To: " .  $email . "\r\n";
$mail_headers .= "X-Mailer: PHP/" . phpversion();*/

 $messaggioPHP=new PHPMailer;
 $messaggioPHP->From= $_POST['email'];
 //$messaggioPHP->AddAddress("gpolese@unisa.it");
 //$messaggioPHP->AddAddress("deufemia@unisa.it");
// $messaggioPHP->AddAddress("lcaruccio@unisa.it");
 $messaggioPHP->AddAddress("r.dellaporta5@studenti.unisa.it");
 $messaggioPHP->AddReplyTo($_POST['email']); 
 $messaggioPHP->Subject="Email con allegato";
 $messaggioPHP->Body='Invio file';
 
// l’escape di alcuni caratteri tramite la direttiva magic_quotes_gpc.
// Il risultato ottenuto con magic_quotes_gpc attivo può essere generato manualmente 
// anche con la funzione addslashes() che va ad aggiungere un carattere backspace prima di apici singoli,
// apici doppi, altri backspace o caratteri NUL.
/*una stringa con apici doppi passata via get, post o cookie: “stringa”
viene trasformata da magic_quotes_gpc: \”stringa\”
aggiungendo anche addslashes() il risultato è: \\\”stringa\\\”*/

 if ( ! get_magic_quotes_gpc() ) {
  $_POST['name'] = addslashes($_POST['name']);
}

if ( ! get_magic_quotes_gpc() ) {
  $_POST['email'] = addslashes($_POST['email']);
}

if ( ! get_magic_quotes_gpc() ) {
  $_POST['phone'] = addslashes($_POST['phone']);
}

if ( ! get_magic_quotes_gpc() ) {
  $_POST['message'] = addslashes($_POST['message']);
}


if($nome == '' || $email == '' || $messaggio == '') {
     echo 'Inserisci tutti i valori';
     $error = true; 
	} 
	else if(!preg_match("/^[ a-z]{3,25}$/i",$nome))   {
			echo "campo nome compreso tra 5 e 25 caratteri alfanumerici";
			$error=true;
	}
	else if(!preg_match("/^[ a-z]{3,150}$/i",$messaggio))   {
			echo "campo messaggio compreso tra 5 e 150 caratteri alfanumerici";
			$error=true;
	}else if(!preg_match("/^[_a-z0-9+-]+(\.[_a-z0-9+-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)+$/",$email)){ 
				echo "Spiacenti, E-mail vuota o errata!<br />"; 
				$error = true; 
					} else {
$filepath="dati.txt";
$fhandler=fopen($filepath,"a");
//$fp=fopen("dati.txt","a");
fwrite($fhandler, "$nome,$email,$numero,$messaggio,$data\r\n ");
//mail($receivers, $subject, $messaggio, $mail_headers);
$messaggioPHP->AddAttachment('dati.txt');
if(!$messaggioPHP->Send()){
  echo $messaggioPHP->ErrorInfo; 
}else{ 
  echo 'Email inviata correttamente!';
}

}
$messaggioPHP->SmtpClose();
unset($messaggioPHP); 

fclose($fhandler);

?>