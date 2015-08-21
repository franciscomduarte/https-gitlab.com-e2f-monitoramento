<?php 
include '../conexao/conn.php';
session_start();

$acao  = $_REQUEST['acao'];
$id	   = $_REQUEST['id'];
$evento = $_SESSION['evento'];
#dados do formulario

switch ($acao) {
	case "convidar":
		$sql = "INSERT INTO convidado (id, pessoa_id, evento_id, data_hora_chegada,
		usuario_check_id, nominata, pre_nominata)
		VALUES (null, '$id', '$evento', NULL,
		NULL, '0', '0');";
		break;

	case "nominata":
		$sql = "INSERT INTO convidado (id, pessoa_id, evento_id, data_hora_chegada,
		usuario_check_id, nominata, pre_nominata)
		VALUES (null, '$id', '$evento', NULL,
		NULL, '1', '0');";
		break;

	case "prenominata":
		$sql = "INSERT INTO convidado (id, pessoa_id, evento_id, data_hora_chegada,
		usuario_check_id, nominata, pre_nominata)
		VALUES (null, '$id', '$evento', NULL,
		NULL, '0', '1');";
		break;
}


if ($sql){
	mysqli_query($conexao, $sql);
}

ob_clean();

header("Location: ../index.php?pg=16&id=".$evento);


?>