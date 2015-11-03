<?php 
include '../conexao/conn.php';
session_start();


$acao  = $_REQUEST['acao'];
$id	   = $_REQUEST['id'];
$evento =  $_REQUEST['evento_id'];
#dados do formulario

switch ($acao) {
	case "convidar":
		$sql = "REPLACE INTO convidado (id, pessoa_id, evento_id, data_hora_chegada,
		usuario_check_id, nominata, pre_nominata)
		VALUES (null, '$id', '$evento', NULL,
		NULL, '0', '0');";
		mysqli_query($conexao, $sql);
		break;

	case "nominata":
		$sql = "REPLACE INTO convidado (id, pessoa_id, evento_id, data_hora_chegada,
		usuario_check_id, nominata, pre_nominata)
		VALUES (null, '$id', '$evento', NULL,
		NULL, '1', '0');";
		mysqli_query($conexao, $sql);
		break;

	case "prenominata":
		$sql = "REPLACE INTO convidado (id, pessoa_id, evento_id, data_hora_chegada,
		usuario_check_id, nominata, pre_nominata)
		VALUES (null, '$id', '$evento', NULL,
		NULL, '0', '1');";
		mysqli_query($conexao, $sql);
		break;
	case "remover":
		$sql = "DELETE FROM convidado where evento_id=$evento and pessoa_id = $id;";	
		mysqli_query($conexao, $sql);
		break;
	
	case "convidarVarios":
		$ids = explode(",", $id);
		foreach ($ids as $id) {
			$sql = "REPLACE INTO convidado (id, pessoa_id, evento_id, data_hora_chegada,
			usuario_check_id, nominata, pre_nominata)
			VALUES (null, '$id', '$evento', NULL,
			NULL, '0', '0');";
			mysqli_query($conexao, $sql);
		}

		break;
}

ob_clean();

header("Location: ../index.php?pg=16&id=".$evento);


?>