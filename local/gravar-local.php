<?php 
	include '../conexao/conn.php';
	session_start();
	
	
	$acao  = $_REQUEST['acao'];
	$id	   = $_REQUEST['id'];
	
	#dados do formulario
	$nome       = $_REQUEST['nome'];
	$endereco   = $_REQUEST['endereco'];
	$cidade_id  = $_REQUEST['cidade_id'];
	
	#condi磯 que verifica se uma das a絥s foram passadas
	if ($acao == "n" || $acao == "e" || $acao == "a" ){
		if ($acao == "n"){
			$sql = "INSERT INTO local VALUES(null, '$nome', '$endereco','$cidade_id')";
		}elseif ($acao == "e"){
			//Esta a não exclui apenas inativa.
			echo "<script>alert('A exclusão de local não é permitida.');history.go(-1);</script>";
			exit();
		}elseif ($acao == "a"){
			$sql = "UPDATE local set 
					 nome = '$nome',
					 endereco = '$endereco',
					 cidade_id = '$cidade_id'
					where id = $id";
		}
		
		mysqli_query($conexao, $sql);
	}else{
		#colocar um erro... 
	}
	header("Location: ../index.php?pg=7");
	

?>