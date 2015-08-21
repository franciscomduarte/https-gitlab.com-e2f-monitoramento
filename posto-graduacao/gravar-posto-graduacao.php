<?php 
	include '../conexao/conn.php';
	
	$acao  = $_REQUEST['acao'];
	$id	   = $_REQUEST['id'];
	
	#dados do formulario
	$sigla = $_REQUEST['sigla'];
	$nome  = $_REQUEST['nome'];
	
	#condi磯 que verifica se uma das a絥s foram passadas
	if ($acao == "n" || $acao == "e" || $acao == "a" ){
		if ($acao == "n"){
			$sql = "INSERT INTO posto_graduacao VALUES(null, '$sigla', '$nome')";
		}elseif ($acao == "e"){
			//Esta a não exclui apenas inativa.
			echo "<script>alert('A exclusão do posto graduação não é permitida.');history.go(-1);</script>";
			exit();
		}elseif ($acao == "a"){
			$sql = "UPDATE posto_graduacao set 
					 sigla = '$sigla',
					 nome = '$nome'
					where id = $id";
		}
		
		mysqli_query($conexao, $sql);
	}else{
		#colocar um erro... 
	}
	header("Location: ../index.php?pg=8");
	

?>