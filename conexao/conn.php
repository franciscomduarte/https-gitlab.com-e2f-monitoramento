<?php

/*
 * Arquivo para fazer a conexao com o banco de dados.
* Esse arquivo sera incluido aonde for necessario a utilizacao de conexao com o
* banco de dados.
* Autor: Flaviano O. Silva
*/

#header('Content-Type: text/html; charset=utf-8');

if ($_SERVER['REMOTE_ADDR'] != '127.0.0.1'){

	//Atributos para acesso ao banco de produção
	$servidor = "mysql.e2f.com.br";
	$usuario  = "e2f08";
	$senha    = "ebsucesso";
	$banco    = "e2f08";
}else{
	// Banco de teste
	$servidor = "mysql.e2f.com.br";
	$usuario  = "e2f08";
	$senha    = "ebsucesso";
	$banco    = "e2f08";
}

//Setando a conexao com o banco e colocando em uma variavel.
$conexao = mysqli_connect($servidor,$usuario,$senha,$banco);
//Verificando se a conexao foi efetuada com sucesso.
if (!mysqli_connect_error()){
	mysqli_query($conexao,"SET NAMES 'utf8'");
	mysqli_query($conexao,'SET character_set_connection=utf8');
	mysqli_query($conexao,'SET character_set_client=utf8');
	mysqli_query($conexao,'SET character_set_results=utf8');

	#echo "Banco conectado....";
}else{
	echo "Erro ".mysqli_connect_error();
	exit();
}
#header('Content-Type: text/html; charset=utf-8');

?>
