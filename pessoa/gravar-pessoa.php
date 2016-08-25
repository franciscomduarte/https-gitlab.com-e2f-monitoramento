<?php 
ini_set("memory_limit","256M");

include '../conexao/conn.php';
session_start();

require_once 'funcoes_files.php';

ob_start();

$acao  = $_REQUEST['acao'];
$id	   = $_REQUEST['id'];

#dados do formulario

$foto                = $_FILES['foto'];

$ordem               = $_REQUEST['ordem'];
$nome                = $_REQUEST['nome'];
$email        		 = $_REQUEST['email'];
$telefone_1   		 = $_REQUEST['telefone_1'];
$telefone_2   		 = $_REQUEST['telefone_2'];
$cargo  	 		 = $_REQUEST['cargo'];


$funcao_id           = $_REQUEST['funcao_id'];
$vocativo_id           = $_REQUEST['vocativo_id'];
$usuario_cadastro_id = $_SESSION["id_usuario"];
$tipo_arquivo		 = isset($foto['type']) ? $foto['type'] : "";
if($tipo_arquivo) {
	$tipo_arquivo 		 = explode("/",$tipo_arquivo)[1];
}
if(!empty($foto['name'])){
	$nome_foto			 = md5($foto['name'].date('d-m-Y H:m:s'));
	$nome_foto_pequena	 = $nome_foto."_tumb.".$tipo_arquivo;
	$nome_foto			 = $nome_foto.".".$tipo_arquivo;
}

$path_foto			 = $_SERVER['DOCUMENT_ROOT']."/scc_cerimonial/fotos/";

#condição que verifica se uma das ações foram passadas
if ($acao == "n" || $acao == "e" || $acao == "a" ){
	if ($acao == "n"){
			
		//Funcao para fazer upload da foto.
		if(!empty($foto['name'])){
			try {
				uploadFotos($foto, $nome_foto, $nome_foto_pequena, $path_foto,$tipo_arquivo);
				
				
				$sql = "INSERT INTO pessoa(id,foto,ordem,nome,email,telefone_1,telefone_2,
						data_criacao,funcao_id,
						usuario_cadastro_id, 
						vocativo_id,
						cargo)
						VALUES
						(null,'$nome_foto','$ordem','$nome',
						'$email', '$telefone_1',
						'$telefone_2',now(), 
						'$funcao_id',
						'$usuario_cadastro_id',
						'$vocativo_id',
						'$cargo');";
					
			} catch (Exception $e) {
				echo "<script>alert('Erro ao incluir Pessoa');history.go(-1);</script>";
				exit();
			}
		}else{
			$sql = "INSERT INTO pessoa(id,foto,ordem,nome,email,telefone_1,telefone_2,
					data_criacao,funcao_id,
					usuario_cadastro_id,
					vocativo_id,
					cargo)
					VALUES
					(null,null,'$ordem','$nome',
					'$email', '$telefone_1',
					'$telefone_2',now(),
					'$funcao_id',
					'$usuario_cadastro_id', 
					'$vocativo_id',
					'$cargo');";
		}
			
		
	} elseif ($acao == "e") {
		
		$sql = " UPDATE pessoa SET ativo = 0 where id = '$id'";
		
	}elseif ($acao == "a") {
		//Funcao para fazer upload da foto.
		if(!empty($foto['name'])){
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
			
		if(!empty($foto['name']))
			$sql .= "foto = '$nome_foto', ";

		$sql .= "ordem = '$ordem',
		nome = '$nome',
		email = '$email',
		telefone_1 = '$telefone_1',
		telefone_2 = '$telefone_2',
		funcao_id = '$funcao_id',
		usuario_cadastro_id = '$usuario_cadastro_id',
		vocativo_id = '$vocativo_id',
		cargo = '$cargo'
		WHERE id = '$id'";
		
	}

	mysqli_query($conexao, $sql);
}else{
	#colocar um erro...
}

ob_clean();

header("Location: ../index.php?pg=10");


?>