<?php 
	include '../conexao/conn.php';
	session_start();
	
	
	$acao  = $_REQUEST['acao'];
	$id	   = $_REQUEST['id'];
	
	#dados do formulario
	$descricao       = $_REQUEST['descricao'];
	
	#condi磯 que verifica se uma das a絥s foram passadas
	if ($acao == "n" || $acao == "e" || $acao == "a" ){
		if ($acao == "n"){
			$sql = "INSERT INTO vocativo VALUES(null, '$descricao')";
		}elseif ($acao == "e"){

			$sql = "UPDATE vocativo set ativo = 0 where id = $id";
			
		}elseif ($acao == "a"){
			$sql = "UPDATE vocativo set 
					 descricao = '$descricao'
					where id = $id";
		}
		
		mysqli_query($conexao, $sql);
	}else{
		#colocar um erro... 
	}
	header("Location: ../index.php?pg=40");
	

?>