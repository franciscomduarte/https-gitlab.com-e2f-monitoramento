<?php 
	include '../conexao/conn.php';
	
	
	$acao  = $_REQUEST['acao'];
	$id	   = $_REQUEST['id'];
	
	#dados do formulario
	
	$foto                = $_REQUEST['foto'];
	$ordem               = $_REQUEST['ordem'];
	$nome                = $_REQUEST['nome'];
	$email        		 = $_REQUEST['email'];
	$telefone_1   		 = $_REQUEST['telefone_1'];
	$telefone_2   		 = $_REQUEST['telefone_2'];
	$data_criacao 		 = date('Y-m-d');
	$posto_graduacao_id  = $_REQUEST['posto_graduacao_id'];
	$funcao_id           = $_REQUEST['funcao_id'];
	$usuario_cadastro_id = $_SESSION["id_usuario"];
	
	#condição que verifica se uma das ações foram passadas
	if ($acao == "n" || $acao == "e" || $acao == "a" ){
		if ($acao == "n"){
			
			$sql = "INSERT INTO pessoa
								(id,
								foto,
								ordem,
								nome,
								email,
								telefone_1,
								telefone_2,
								data_criacao,
								posto_graduacao_id,
								funcao_id,
								usuario_cadastro_id)
					VALUES
					(null,
					'$foto', 
				    '$ordem',
					'$nome',
					'$email',
					'$telefone_1',
					'$telefone_2',
					'$data_criacao',
					'$posto_graduacao_id',
					'$funcao_id',
					'$usuario_cadastro_id'
					);";
		}elseif ($acao == "e") {
			//Esta a não exclui apenas inativa.
			echo "<script>alert('A exclusão de pessoa não é permitida.');history.go(-1);</script>";
			exit();
		}elseif ($acao == "a") {
			
			echo $sql = "UPDATE e2f08.pessoa
					SET
					foto = '$foto',
					ordem = '$ordem',
					nome = '$nome',
					email = '$email',
					telefone_1 = '$telefone_1',
					telefone_2 = '$telefone_2',
					data_criacao = '$data_criacao',
					posto_graduacao_id = '$posto_graduacao_id',
					funcao_id = '$funcao_id',
					usuario_cadastro_id = '$usuario_cadastro_id'
					WHERE id = '$id'";
		}
		
		mysqli_query($conexao, $sql);
	}else{
		#colocar um erro... 
	}
	header("Location: ../index.php?pg=10");
	

?>