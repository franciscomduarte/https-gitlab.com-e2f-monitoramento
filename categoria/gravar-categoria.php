<?php 
	include '../conexao/conn.php';
	
	$acao  = $_REQUEST['acao'];
	$id	   = $_REQUEST['id'];
	
	#dados do formulario
	$categoria_portugues = $_REQUEST['categoria_portugues'];
	$categoria_ingles	 = $_REQUEST['categoria_ingles'];
	$categoria_espanha 	 = $_REQUEST['categoria_espanha'];
	
	#condi��o que verifica se uma das a��es foram passadas
	if ($acao == "n" || $acao == "e" || $acao == "a" ){
		if ($acao == "n"){
			$sql = "INSERT INTO categoria VALUES(null, '$categoria_portugues', '$categoria_ingles', '$categoria_espanha')";
		}elseif ($acao == "e"){
			//Esta a��o n�o exclui o usu�rio, apenas inativa.
			echo "<script>alert('A exclus�o de categoria n�o � permitida.');history.go(-1);</script>";
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