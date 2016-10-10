<?php

// Recebe o id do serviço
$servico = $argv[1];

print_r(shell_exec("cat ../sql/mysql_user.txt"));



// $mysqli = new mysqli("localhost", "root", "4334N@k0N", "cksrv");


// $servico_tmp = $mysqli->query("select * from servicos where id=$servico;", MYSQLI_USE_RESULT);

// foreach ($servico_tmp as $servico) {
// 	$servico_id = $servico['id'];
// 	$tipo_servico_id = $servico['tipo_servico_id'];
// 	$servidor_ip = $servico['ip'];
// }

// $mysqli->close();


// $mysqli = new mysqli("localhost", "root", "4334N@k0N", "cksrv");
// $tipo_servico_tmp = $mysqli->query("select servico from tipo_servicos where id=$tipo_servico_id;", MYSQLI_USE_RESULT);

// foreach ($tipo_servico_tmp as $tipo_servico) {
// 	$tipo = $tipo_servico['servico'];
// }

// $mysqli->close();






// 	print_r($tipo_servico_tmp);


	
// 	$tipo_servico_id = $servico['tipo_servico_id'];
// 	$tipo_servico_tmp = $mysqli->query("select servico from tipo_servicos where id=$tipo_servico_id;", MYSQLI_USE_RESULT);


	// foreach ($tipo_servico_tmp as $tipo) {
	// 	$tipo_servico = $tipo['servico'];
	// }

	// $ip_servidor=$servico['ip'];

	// $subject = "Alerta CKSRV - servidor $ip_servidor - $tipo_servico";
	// $body = "O servidor $ip_servidor está com situação em WARNING, favor verificar.";

	// require("PHPMailer/class.phpmailer.php");
	// $mail = new PHPMailer;

	// $users = $mysqli->query("SELECT * FROM usuarios", MYSQLI_USE_RESULT);
	// foreach ($users as $user) {

	// 	date_default_timezone_set('Etc/UTC');
	// 	$mail->isSMTP();
	// 	$mail->SMTPDebug = 0;
	// 	$mail->Debugoutput = 'html';
	// 	$mail->Host = 'ssl://smtp.gmail.com'; // SMTP DO SEU EMAIL
	// 	$mail->Port = 465;
	// 	$mail->SMTPAuth = true;
	// 	$mail->Username = "cksrv2016@gmail.com"; // SEU EMAIL
	// 	$mail->Password = "cksrv@k0N"; // SUA SENHA
	// 	$mail->setFrom('cksrv2016@gmail.com', 'cksrv');
	// 	$mail->addReplyTo('cksrv2016@gmail.com', 'Reply');
	// 	$mail->addAddress($user['email'], 'allan');
	// 	$mail->Subject = $subject;
	// 	$mail->Body = $body;

	// 	if (!$mail->send()) {
	// 	   echo "Ocorreu algum problema e não conseguimos entregar o seu email: " . $mail->ErrorInfo;
	// 	} else {
	// 	   echo "Mensagem enviada!";
	// 	}
// }	

?>
