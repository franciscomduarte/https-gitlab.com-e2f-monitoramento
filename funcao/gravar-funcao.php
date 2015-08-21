<?php 
	include '../conexao/conn.php';
	session_start();
	
	
	$acao  = $_REQUEST['acao'];
	$id	   = $_REQUEST['id'];
	
	#dados do formulario
	$ordem      = $_REQUEST['ordem'];
	$nome       = $_REQUEST['nome'];
	$poder_id   = $_REQUEST['poder_id'];
	
	#condi磯 que verifica se uma das a絥s foram passadas
	if ($acao == "n" || $acao == "e" || $acao == "a" ){
		if ($acao == "n"){
			$sql = "INSERT INTO funcao VALUES(null, '$nome', '$ordem','$poder_id')";
		}elseif ($acao == "e"){
			//Esta a não exclui apenas inativa.
			echo "<script>alert('A exclusão de função não é permitida.');history.go(-1);</script>";
			exit();
		}elseif ($acao == "a"){
			$sql = "UPDATE funcao set 
					 ordem = '$ordem',
					 nome = '$nome',
					 poder_id = '$poder_id'
					where id = $id";
		}
		
		mysqli_query($conexao, $sql);
	}else{
		#colocar um erro... 
	}
	header("Location: ../index.php?pg=2");
	

?>