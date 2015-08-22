<?php 
include '../conexao/conn.php';
session_start();


$acao  = $_REQUEST['acao'];
$id	   = $_REQUEST['id'];
$evento =  $_REQUEST['evento_id'];
$id_usuario = $_SESSION['id_usuario'];
#dados do formulario

switch ($acao) {
	case "confirmar":
		$sql = "UPDATE convidado SET data_hora_chegada = NOW(), usuario_check_id = '$id_usuario'
				WHERE pessoa_id = '$id' and evento_id = '$evento'";
		break;
		
	case "desconfirmar":
			$sql = "UPDATE convidado SET data_hora_chegada = null, usuario_check_id = '$id_usuario'
			WHERE pessoa_id = '$id' and evento_id = '$evento'";
		break;
}

if ($sql){
	mysqli_query($conexao, $sql);
}

ob_clean();

header("Location: ../index.php?pg=21&id=".$evento);


?>