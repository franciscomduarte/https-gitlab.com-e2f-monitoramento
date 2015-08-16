<?php 
	include '../conexao/conn.php';
	
	
	$acao  = $_REQUEST['acao'];
	$id	   = $_REQUEST['id'];
	
	#dados do formulario
	$nome         = $_REQUEST['nome'];
	$data_inicio  = $_REQUEST['data_inicio'];
	$data_fim     = $_REQUEST['data_fim'];
	$descricao    = $_REQUEST['descricao'];
	$local        = $_REQUEST['descricao'];
	
	
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