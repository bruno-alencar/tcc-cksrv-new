<?php

// Recebe o id do serviço
$servico = $argv[1];

$mysql_user = shell_exec("cat sql/mysql_user.txt");
$mysql_password = shell_exec("cat sql/mysql_password.txt");
$mysql_server = shell_exec("cat sql/mysql_server.txt");
$mysql_database = shell_exec("cat sql/mysql_database.txt");


$mysqli = new mysqli(trim($mysql_server), trim($mysql_user), trim($mysql_password), trim($mysql_database));


$servico_tmp = $mysqli->query("select * from servicos where id=$servico;", MYSQLI_USE_RESULT);

foreach ($servico_tmp as $servico) {
	$servico_id = $servico['id'];
	$tipo_servico_id = $servico['tipo_servico_id'];
	$servidor_ip = $servico['ip'];
}

$mysqli->close();


$mysqli = new mysqli(trim($mysql_server), trim($mysql_user), trim($mysql_password), trim($mysql_database));
$tipo_servico_tmp = $mysqli->query("select servico from tipo_servicos where id=$tipo_servico_id;", MYSQLI_USE_RESULT);

foreach ($tipo_servico_tmp as $tipo_servico) {
	$tipo = $tipo_servico['servico'];
}

$mysqli->close();



$subject = "Alerta CKSRV - servidor $servidor_ip - $tipo";
$body = "O servidor $servidor_ip está com situação em WARNING, favor verificar.";

require("email/PHPMailer/class.phpmailer.php");
$mail = new PHPMailer;

$mysqli = new mysqli(trim($mysql_server), trim($mysql_user), trim($mysql_password), trim($mysql_database));
$users = $mysqli->query("SELECT * FROM usuarios", MYSQLI_USE_RESULT);
foreach ($users as $user) {

	$mail->CharSet = "UTF-8";
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
	$mail->addAddress($user['email'], 'allan');
	$mail->Subject = $subject;
	$mail->Body = $body;

	if (!$mail->send()) {
	   echo "Ocorreu algum problema e não conseguimos entregar o seu email: " . $mail->ErrorInfo;
	} else {
	   echo "Mensagem enviada!";
	}
}	
?>
