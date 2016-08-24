<?php 
	include '../conexao/conn.php';
	
	$acao  = $_REQUEST['acao'];
	$id	   = $_REQUEST['id'];
	
	#dados do formulario
	$sigla = $_REQUEST['sigla'];
	$nome  = $_REQUEST['nome'];
	$ordem = $_REQUEST['ordem'];
	
	#condi磯 que verifica se uma das a絥s foram passadas
	if ($acao == "n" || $acao == "e" || $acao == "a" ){
		if ($acao == "n"){
			$sql = "INSERT INTO posto_graduacao (id, sigla, nome, ordem ) VALUES(null, '$sigla', '$nome','$ordem')";
		}elseif ($acao == "e"){
			//Esta a não exclui apenas inativa.
			echo "<script>alert('A exclusão do posto graduação não é permitida.');history.go(-1);</script>";
			exit();
		}elseif ($acao == "a"){
			$sql = "UPDATE posto_graduacao set 
					 sigla = '$sigla',
					 nome = '$nome',
					 ordem = '$ordem'
					where id = $id";
		}
		
		mysqli_query($conexao, $sql);
	}else{
		#colocar um erro... 
	}
	header("Location: ../index.php?pg=8");
	

?>