<?php 
	include 'conexao/conn.php';
	
	$id	   = $_REQUEST['cliente_id'];	
	$senha = $_REQUEST['senha'];
	
	$sql = "UPDATE cliente SET senha = md5('$senha') where id = $id";
	#echo $sql."<br>";
	mysqli_query($conexao, $sql);
	echo "<script>alert('Senha alterada com sucesso.');</script>";
	header("Location: esqueci-senha.php?erro=5");
	
	

?>
