<?php

// Recebe o id do serviço
$servico = $argv[1];

$conecta = mysql_connect("127.0.0.1", "root", "4334N@k0N") or print (mysql_error()); 
mysql_select_db("cksrv", $conecta) or print(mysql_error()); 

$servico_tmp = mysql_query("select * from servicos where id=$servico;"); 
$servico = mysql_fetch_row($servico_tmp);

$tipo_servico = $servico[1];
$servidor_id = $servico[2];
$ip = $servico[3];
$warning = $servico[5];
$particao = $servico[6];
$resultado = $servico[7];

$tipo_servico_tmp = mysql_query("select * from tipo_servicos where id=$tipo_servico;"); 
$tipo_servico = mysql_fetch_row($tipo_servico_tmp);
$tipo = $tipo_servico[1];

$subject = "Alerta CKSRV - servidor $ip - $tipo";
$body = "O servidor $ip está com situação em WARNING, favor verificar.";

require("PHPMailer/class.phpmailer.php");
	$mail = new PHPMailer;

$user_tmp = mysql_query("select * from usuarios where status_id=1;"); 
while ($user = mysql_fetch_row($user_tmp)) {
	$email = $user[4];

	date_default_timezone_set('Etc/UTC');

	$mail->isSMTP();

	$mail->SMTPDebug = 0;
	$mail->Debugoutput = 'html';
	$mail->Host = 'ssl://smtp.gmail.com'; // SMTP DO SEU EMAIL
	$mail->Port = 465;
	$mail->SMTPAuth = true;
	$mail->Username = "cksrv2016@gmail.com"; // SEU EMAIL
	$mail->Password = "cksrv@k0N"; // SUA SENHA
	$mail->setFrom('cksrv2016@gmail.com', 'cksrv');
	$mail->addReplyTo('cksrv2016@gmail.com', 'Reply');
	$mail->addAddress($email, 'allan');
	$mail->Subject = $subject;
	$mail->Body = $body;

	if (!$mail->send()) {
	   echo "Ocorreu algum problema e não conseguimos entregar o seu email: " . $mail->ErrorInfo;
	} else {
	   echo "Mensagem enviada!";
	}; 
}

mysql_close($conecta); 

?>