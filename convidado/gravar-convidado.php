<?php 
include '../conexao/conn.php';
session_start();

$acao  = $_REQUEST['acao'];
$id	   = $_REQUEST['id'];
$evento = $_SESSION['evento'];
#dados do formulario

switch ($acao) {
	case "convidar":
		
		$sql = "INSERT INTO convidado (id, pessoa_id, evento_id, data_hora_chegada, 
									   usuario_check_id, nominata, pre_nominata) 
				VALUES (null, '$id', '$evento', NULL, NULL, '0', '0');";
	break;
	
	default:
		;
	break;
}

if ($acao == "n" || $acao == "e" || $acao == "a" ){
	if ($acao == "n"){
			
		//Funcao para fazer upload da foto.
		if ($foto){
			try {
				uploadFotos($foto, $nome_foto, $nome_foto_pequena, $path_foto,$tipo_arquivo);
			} catch (Exception $e) {
				echo "<script>alert('Erro ao incluir Pessoa');history.go(-1);</script>";
				exit();
			}
		}
			
		$sql = "INSERT INTO pessoa(id,foto,ordem,nome,email,telefone_1,telefone_2,
								   data_criacao,posto_graduacao_id,funcao_id,
								   usuario_cadastro_id)
								   VALUES		
								   (null,'$nome_foto','$ordem','$nome',
									'$email', '$telefone_1',
									'$telefone_2',now(),
									'$posto_graduacao_id',
									'$funcao_id',
									'$usuario_cadastro_id');";
	}elseif ($acao == "e") {
		//Esta a não exclui apenas inativa.
		echo "<script>alert('A exclusão de pessoa não é permitida.');history.go(-1);</script>";
		exit();
	}elseif ($acao == "a") {
			
		//Funcao para fazer upload da foto.
		if ($foto){
			$nome_foto_alterar = $_REQUEST['nome_foto_alterar'];	
			try {
				uploadFotos($foto, $nome_foto, $nome_foto_pequena, $path_foto,$tipo_arquivo,$nome_foto_alterar);
			} catch (Exception $e) {
				echo "<script>alert('Erro ao incluir Pessoa');history.go(-1);</script>";
				exit();
			}
		}
		#################################################################
			
		$sql = "UPDATE pessoa SET ";
			
		if ($foto)
			$sql .= "foto = '$nome_foto', ";
		if ($posto_graduacao_id)
			$sql .= "posto_graduacao_id = '$posto_graduacao_id', ";

		$sql .= "ordem = '$ordem',
		nome = '$nome',
		email = '$email',
		telefone_1 = '$telefone_1',
		telefone_2 = '$telefone_2',
		funcao_id = '$funcao_id',
		usuario_cadastro_id = '$usuario_cadastro_id'
		WHERE id = '$id'";
		#echo "SQL = ".$sql;
		#exit();
	}

	mysqli_query($conexao, $sql);
}else{
	#colocar um erro...
}

ob_clean();

header("Location: ../index.php?pg=10");


?>