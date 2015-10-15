<?php 
	include '../conexao/conn.php';
	
	$acao  = $_REQUEST['acao'];
	$id	   = $_REQUEST['id'];
	
	#dados do formulario
	$email  = $_REQUEST['email'];
	$nome   = $_REQUEST['nome'];
	$senha  = md5($_REQUEST['senha']);
	$ativo  = $_REQUEST['situacao'];	
	$perfil = $_REQUEST['perfil'];	
	
	#condi磯 que verifica se uma das a絥s foram passadas
	if ($acao == "n" || $acao == "e" || $acao == "a" ){
		if ($acao == "n"){
			$sql = "INSERT INTO usuario VALUES(null, '$nome', '$email', '$senha', $ativo, now(),'$perfil')";
		}elseif ($acao == "e"){
			//Esta a磯 n㯠exclui o usuᲩo, apenas inativa.
			$sql = "UPDATE usuario set ativo = 0 where id = $id";
		}elseif ($acao == "a"){
			$sql = "UPDATE usuario set 
			        nome = '$nome',
			        email = '$email',  
					perfil = '$perfil',
					ativo = $ativo 
				   where id = $id";
		}elseif ($acao == "as"){
			$sql = "UPDATE usuario set senha = md5('123456') where id = $id";
			//adicionar uma mensagem
		}
		mysqli_query($conexao, $sql);
	}else{
		#colocar um erro... 
	}
	header("Location: ../index.php?pg=1");
	

?>