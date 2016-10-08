<?php


$nomeArquivo = $argv[0];
$servico = $argv[1];


$conecta = mysql_connect("127.0.0.1", "root", "eduardo") or print (mysql_error()); 
mysql_select_db("cksrv", $conecta) or print(mysql_error()); 



$result = mysql_query("
select s.id,s.tipo_servico_id,s.servidor_id,s.resultado,
s.modified,s.ip,t.servico,e.detalhes_so
from servicos s 
inner join tipo_servicos t on (t.id = s.tipo_servico_id)
inner join servidores e on (e.id = s.servidor_id) 
where s.id = $servico
"); 
/* pegar emails atraves da base
$usuarios = mysql_query("select email from usuarios where perfil_id = 1");

global $emails;

while ($row = mysql_fetch_array($usuarios)) {  

		$emails = $row['email'];
}
*/

require("PHPMailer/class.phpmailer.php");

$mail = new PHPMailer;


while ($row = mysql_fetch_array($result)) {  

	$id = $row['id'];
	$tipo_servico_id = $row['tipo_servico_id'];
	$servidor_id = $row['servidor_id'];
	$resultado = $row['resultado'];
	$modified = $row['modified'];
	$ip = $row['ip'];
	$servico = $row['servico'];
	$detalhes_so = $row['detalhes_so'];



	date_default_timezone_set('Etc/UTC');

	$mail->isSMTP();

	$mail->SMTPDebug = 0;
	$mail->Debugoutput = 'html';
	$mail->Host = 'smtp.live.com'; // SMTP DO SEU EMAIL
	$mail->Port = 587;
	$mail->SMTPSecure = 'tls';
	$mail->SMTPAuth = true;
	$mail->Username = "cksrv@outlook.com"; // SEU EMAIL
	$mail->Password = "Ciencia2016"; // SUA SENHA
	$mail->setFrom('cksrv@outlook.com', 'cksrv');
	$mail->addReplyTo('replyto@gmail.com', 'Reply');
	$mail->addAddress('eduardosantos058@gmail.com', 'eduardo');
	$mail->Subject = 'Alarme de problema no servidor: '.$ip;
	$mail->Body = 'Descricao do alarme: '.'IP: '.$ip.' Erro no servico: '.$servico;

	if (!$mail->send()) {
	   echo "Ocorreu algum problema e não conseguimos entregar o seu email: " . $mail->ErrorInfo;
	} else {
	   echo "Mensagem enviada!";
	}; 

}  
mysql_close($conecta); 
?>