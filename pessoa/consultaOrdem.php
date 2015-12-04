<?php

	include_once '../conexao/conn.php';
	
	$id = $_REQUEST['id'];
	$sql = "select * from funcao where id =".$id;		
	$rs = mysqli_query($conexao, $sql);
	$ordem = "";
	while ($linha = mysqli_fetch_array($rs)) {
		$ordem               = $linha['ordem'];
	}
		
	echo $ordem;