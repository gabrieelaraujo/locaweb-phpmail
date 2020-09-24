<?php 
/* 
Recomendo utilizar o PHPMail, utilizando envio via SMTP
Script para facilitar na construção de formulário de contato rápido 
*/


header('Content-Type: text/html; charset=ISO-8859-1');
$emailsender='email@email.com.br';


if(PHP_OS == "Linux") $quebra_linha = "\n"; //Se for Linux
elseif(PHP_OS == "WINNT") $quebra_linha = "\r\n"; // Se for Windows
else die("Este script nao esta preparado para funcionar com o sistema operacional de seu servidor");

// Passando os dados obtidos pelo formulário para as variáveis abaixo
// Não esqueça de fazer as devidas segurança
$nomeremetente     = $_POST['nome'];
$emailremetente    = trim($_POST['email']);
$fone              = trim($_POST['telefone']);


$emaildestinatario = "email@email.com.br";
$comcopia          = "";
$comcopiaoculta    = "email@email.com.br";

/* Montando a mensagem a ser enviada no corpo do e-mail. */
$mensagemHTML = '
<p>Nome:<strong style="font-size:20px;"><b><i>'.$nomeremetente.'</i></b></strong></p>
<p>Email:<strong style="font-size:20px;"><b><i>'.$emailremetente.'</i></b></strong></p>
<p>Telefone:<strong style="font-size:20px;"><b><i>'.$fone.'</i></b></strong></p>

<hr>';


/* Montando o cabeçalho da mensagem */
$headers = "MIME-Version: 1.1".$quebra_linha;
$headers .= "Content-Type: text/html; charset=ISO-8859-1".$quebra_linha;
// Perceba que a linha acima contém "text/html", sem essa linha, a mensagem não chegará formatada.
$headers .= "From: ".$emailsender.$quebra_linha;
$headers .= "Return-Path: " . $emailsender . $quebra_linha;
// Esses dois "if's" abaixo são porque o Postfix obriga que se um cabeçalho for especificado, deverá haver um valor.
// Se não houver um valor, o item não deverá ser especificado.
if(strlen($comcopia) > 0) $headers .= "Cc: ".$comcopia.$quebra_linha;
if(strlen($comcopiaoculta) > 0) $headers .= "Bcc: ".$comcopiaoculta.$quebra_linha;
$headers .= "Reply-To: ".$emailremetente.$quebra_linha;
// Note que o e-mail do remetente será usado no campo Reply-To (Responder Para)
 
/* Enviando a mensagem */
$envio = mail($emaildestinatario, "Assunto", $mensagemHTML, $headers, "-r". $emailsender);
 
/* Mostrando na tela as informações enviadas por e-mail */
header('Content-Type: text/html; charset=ISO-8859-1');
 
if($envio)
 echo "Mensagem enviada com sucesso";
else
 echo "A mensagem não pode ser enviada";
 ?>
