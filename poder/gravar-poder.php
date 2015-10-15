<?php 
	include '../conexao/conn.php';
	session_start();
	
	
	$acao  = $_REQUEST['acao'];
	$id	   = $_REQUEST['id'];
	
	#dados do formulario
	$nome       = $_REQUEST['nome'];
	
	#condi磯 que verifica se uma das a絥s foram passadas
	if ($acao == "n" || $acao == "e" || $acao == "a" ){
		if ($acao == "n"){
			$sql = "INSERT INTO poder VALUES(null, '$nome')";
		}elseif ($acao == "e"){

			$sql = "UPDATE poder set ativo = 0 where id = $id";
			
		}elseif ($acao == "a"){
			$sql = "UPDATE poder set 
					 nome = '$nome'
					where id = $id";
		}
		
		mysqli_query($conexao, $sql);
	}else{
		#colocar um erro... 
	}
	header("Location: ../index.php?pg=22");
	

?>