<?php 
	include '../conexao/conn.php';
	session_start();
	
	$acao  = $_REQUEST['acao'];
	$id	   = $_REQUEST['id'];
	
	#dados do formulario
	$nome         = $_REQUEST['nome'];
	$data_inicio  = $_REQUEST['data_inicio'];
	$data_fim     = $_REQUEST['data_fim'];
	$descricao    = $_REQUEST['descricao'];
	$local_id     = $_REQUEST['local_id'];
	$id_usuario   = $_SESSION['id_usuario'];	
	
	#condi磯 que verifica se uma das a絥s foram passadas
	if ($acao == "n" || $acao == "e" || $acao == "a" ){
		if ($acao == "n"){
			
			if ($data_fim){
				$sql = "INSERT INTO evento VALUES
						(null, '$nome', '$data_inicio','$data_fim','$descricao','$local_id','$id_usuario')";
			}else{
				$sql = "INSERT INTO evento VALUES
					   (null, '$nome', '$data_inicio',null,'$descricao','$local_id','$id_usuario')";
			}
		}elseif ($acao == "e"){
			//Esta a não exclui apenas inativa.
			$sql = "UPDATE evento set ativo = 0 where id = $id";
		}elseif ($acao == "a"){
			if ($data_fim){
				$sql = "UPDATE evento set 
						 nome = '$nome',
						 data_inicio = '$data_inicio',
						 data_fim = '$data_fim',
						 descricao = '$descricao',
						 local_id = '$local_id'
						where id = $id";
			}else{
				$sql = "UPDATE evento set
				nome = '$nome',
				data_inicio = '$data_inicio',
				data_fim = null,
				descricao = '$descricao',
				local_id = '$local_id'
				where id = $id";
			}
		}
		
		mysqli_query($conexao, $sql);
	}else{
		#colocar um erro... 
	}
	header("Location: ../index.php?pg=13");
	

?>