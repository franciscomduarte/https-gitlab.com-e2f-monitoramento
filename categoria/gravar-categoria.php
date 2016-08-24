<?php 
	include '../conexao/conn.php';
	
	$acao  = $_REQUEST['acao'];
	$id	   = $_REQUEST['id'];
	
	#dados do formulario
	$categoria_portugues = $_REQUEST['categoria_portugues'];
	$categoria_ingles	 = $_REQUEST['categoria_ingles'];
	$categoria_espanha 	 = $_REQUEST['categoria_espanha'];
	
	#condição que verifica se uma das ações foram passadas
	if ($acao == "n" || $acao == "e" || $acao == "a" ){
		if ($acao == "n"){
			$sql = "INSERT INTO categoria VALUES(null, '$categoria_portugues', '$categoria_ingles', '$categoria_espanha')";
		}elseif ($acao == "e"){
			//Esta ação não exclui o usuário, apenas inativa.
			echo "<script>alert('A exclusão de categoria não é permitida.');history.go(-1);</script>";
			exit();
		}elseif ($acao == "a"){
			$sql = "UPDATE categoria set 
					 categoria_portugues = '$categoria_portugues',
					 categoria_ingles = '$categoria_ingles',
					 categoria_espanha = '$categoria_espanha'
					where id = $id";
		}
		
		mysqli_query($conexao, $sql);
	}else{
		#colocar um erro... 
	}
	header("Location: ../index.php?pg=8");
	

?>