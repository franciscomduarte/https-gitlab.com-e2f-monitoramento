<?php

require_once 'conexao/conn.php';
session_start();

$email = $_POST['email'];
$senha = md5($_POST['senha']);

if ($email && $senha){
	
	$sql = "select count(*) as total, id, email 
			from usuario 
			where email = '$email' 
			and   senha = '$senha'";
	
	$rs = mysqli_query($conexao,$sql);
	
	if($linha = mysqli_fetch_array($rs)){
		$total 		= $linha['total'];
		$id_usuario = $linha['id'];
		$email		= $linha['email'];
	}
	if ($total > 0){
		$_SESSION['id_usuario'] = $id_usuario;
		$_SESSION['email'] = $email;
		
		$sqlHistorico = "INSERT INTO historico_acesso VALUES (null, now(), '$id_usuario')";
		mysqli_query($conexao,$sqlHistorico);
		
		echo "<script>location.href='index.php';</script>";
	}else{
		$_SESSION['id_usuario'] = NULL;
		echo "<script>location.href='login.php?erro=1';</script>";
	}
	
}else{
	echo "<script>location.href='login.php?erro=1';</script>";
}

?>