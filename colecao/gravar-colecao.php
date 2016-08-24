<?php 
include '../conexao/conn.php';

$acao  = $_REQUEST['acao'];
$id	   = $_REQUEST['id'];
#dados do formulario

##################### PORTUGUES ############################
$colecao_portugues   = str_replace("'", "\'",$_REQUEST['colecao_portugues']);
$contido   		     = $_REQUEST['contido'];
$resposta_correta    = $_REQUEST['resposta_correta'];
$categoria_id		 = $_REQUEST['categoria'];
$verificado			 = $_REQUEST['situacao'];

#elementos
$elemento1_portugues = str_replace("'", "\'", $_REQUEST['elemento1_portugues']);
$elemento2_portugues = str_replace("'", "\'",$_REQUEST['elemento2_portugues']);
$elemento3_portugues = str_replace("'", "\'",$_REQUEST['elemento3_portugues']);
$elemento4_portugues = str_replace("'", "\'",$_REQUEST['elemento4_portugues']);
$elemento5_portugues = str_replace("'", "\'",$_REQUEST['elemento5_portugues']);
$elemento6_portugues = str_replace("'", "\'",$_REQUEST['elemento6_portugues']);
$elemento7_portugues = str_replace("'", "\'",$_REQUEST['elemento7_portugues']);
$elemento8_portugues = str_replace("'", "\'",$_REQUEST['elemento8_portugues']);

##################### INGLES ###############################

$colecao_ingles = str_replace("'", "\'",$_REQUEST['colecao_ingles']);
#$contido_ingles = $_REQUEST['contido_ingles'];
#elementos
$elemento1_ingles = str_replace("'", "\'",$_REQUEST['elemento1_ingles']);
$elemento2_ingles = str_replace("'", "\'",$_REQUEST['elemento2_ingles']);
$elemento3_ingles = str_replace("'", "\'",$_REQUEST['elemento3_ingles']);
$elemento4_ingles = str_replace("'", "\'",$_REQUEST['elemento4_ingles']);
$elemento5_ingles = str_replace("'", "\'",$_REQUEST['elemento5_ingles']);
$elemento6_ingles = str_replace("'", "\'",$_REQUEST['elemento6_ingles']);
$elemento7_ingles = str_replace("'", "\'",$_REQUEST['elemento7_ingles']);
$elemento8_ingles = str_replace("'", "\'",$_REQUEST['elemento8_ingles']);


################### espanha ##################################

$colecao_espanha   = str_replace("'", "\'",$_REQUEST['colecao_espanha']);
#$contido_espanha  = $_REQUEST['contido_espanha'];
#elementos
$elemento1_espanha = str_replace("'", "\'",$_REQUEST['elemento1_espanha']);
$elemento2_espanha = str_replace("'", "\'",$_REQUEST['elemento2_espanha']);
$elemento3_espanha = str_replace("'", "\'",$_REQUEST['elemento3_espanha']);
$elemento4_espanha = str_replace("'", "\'",$_REQUEST['elemento4_espanha']);
$elemento5_espanha = str_replace("'", "\'",$_REQUEST['elemento5_espanha']);
$elemento6_espanha = str_replace("'", "\'",$_REQUEST['elemento6_espanha']);
$elemento7_espanha = str_replace("'", "\'",$_REQUEST['elemento7_espanha']);
$elemento8_espanha = str_replace("'", "\'",$_REQUEST['elemento8_espanha']);


#condiчуo que verifica se uma das aчѕes foram passadas
if ($acao == "n" || $acao == "e" || $acao == "a" || $acao == "v"){
	if ($acao == "n"){
		try{
			mysqli_autocommit($conexao, FALSE);

			$sqlAgrupador = "INSERT INTO agrupador VALUES(null,sysdate(), ".$_SESSION['id_usuario'].",$categoria_id,0,null)";

			mysqli_query($conexao,$sqlAgrupador);
			$agrupador_id = mysqli_insert_id($conexao);

			#SQL INSERINDO QUESTOES

			$cabecachoSql = "INSERT INTO colecao VALUES ";

			$sqlPortugues =  "(null, '$colecao_portugues', 1,
			'$elemento1_portugues', '$elemento2_portugues', '$elemento3_portugues',
			'$elemento4_portugues','$elemento5_portugues', '$elemento6_portugues',
			'$elemento7_portugues','$elemento8_portugues',
			'$resposta_correta', $agrupador_id, '$contido')";

			$sqlIngles   = "(null, '$colecao_ingles', 2,
			'$elemento1_ingles', '$elemento2_ingles', '$elemento3_ingles',
			'$elemento4_ingles','$elemento5_ingles', '$elemento6_ingles',
			'$elemento7_ingles','$elemento8_ingles',
			'$resposta_correta', $agrupador_id, '$contido')";

			$sqlEspanha   = "(null, '$colecao_espanha', 3,
			'$elemento1_espanha', '$elemento2_espanha', '$elemento3_espanha',
			'$elemento4_espanha','$elemento5_espanha', '$elemento6_espanha',
			'$elemento7_espanha','$elemento8_espanha',
			'$resposta_correta', $agrupador_id, '$contido')";

			$sql = $cabecachoSql.$sqlPortugues.", ".$sqlIngles.", ".$sqlEspanha.";";

			mysqli_query($conexao,$sql);
			mysqli_commit($conexao);

		}catch (Exception $e){
			mysqli_rollback($conexao);
			echo $e;
		}

	}elseif ($acao == "e"){
		//Esta aчуo nуo exclui o usuсrio, apenas inativa.
		$sql = "delete from agrupador where id = $id;";
		mysqli_query($conexao, $sql);

	}elseif ($acao == "a"){

		if ($verificado){
			$sqlAgrupador = "UPDATE agrupador set categoria_id = $categoria_id,
			verificado = $verificado,
			data_verificacao = sysdate()
			where id = '$id'";
		}else{
			$sqlAgrupador = "UPDATE agrupador set categoria_id = $categoria_id,
			verificado = $verificado,
			data_verificacao = null
			where id = '$id'";
		}

		$sqlPortugues = "UPDATE colecao c SET
		nome = '$colecao_portugues',
		elemento_1 = '$elemento1_portugues',
		elemento_2 = '$elemento2_portugues',
		elemento_3 = '$elemento3_portugues',
		elemento_4 = '$elemento4_portugues',
		elemento_5 = '$elemento5_portugues',
		elemento_6 = '$elemento6_portugues',
		elemento_7 = '$elemento7_portugues',
		elemento_8 = '$elemento8_portugues',
		elemento_correto = '$resposta_correta',
		contido = '$contido'
		where agrupador_id = '$id'
		and idioma_id = '1'";

		$sqlIngles = "UPDATE colecao c SET
		nome = '$colecao_ingles',
		elemento_1 = '$elemento1_ingles',
		elemento_2 = '$elemento2_ingles',
		elemento_3 = '$elemento3_ingles',
		elemento_4 = '$elemento4_ingles',
		elemento_5 = '$elemento5_ingles',
		elemento_6 = '$elemento6_ingles',
		elemento_7 = '$elemento7_ingles',
		elemento_8 = '$elemento8_ingles',
		elemento_correto = '$resposta_correta',
		contido = '$contido'
		where agrupador_id = '$id'
		and idioma_id = '2'";

		$sqlEspanha = "UPDATE colecao c SET
		nome = '$colecao_espanha',
		elemento_1 = '$elemento1_espanha',
		elemento_2 = '$elemento2_espanha',
		elemento_3 = '$elemento3_espanha',
		elemento_4 = '$elemento4_espanha',
		elemento_5 = '$elemento5_espanha',
		elemento_6 = '$elemento6_espanha',
		elemento_7 = '$elemento7_espanha',
		elemento_8 = '$elemento8_espanha',
		elemento_correto = '$resposta_correta',
		contido = '$contido'
		where agrupador_id = '$id'
		and idioma_id = '3'";

		try {
			mysqli_autocommit($conexao, FALSE);
			#executando atualizaчѕes

			mysqli_query($conexao, $sqlAgrupador);
			mysqli_query($conexao, $sqlPortugues);
			mysqli_query($conexao, $sqlIngles);
			mysqli_query($conexao, $sqlEspanha);

			mysqli_commit($conexao);

		} catch (Exception $e) {
			mysqli_rollback($conexao);
		}


	}elseif($acao == "v"){
		$sqlAgrupador = "UPDATE agrupador set verificado = 1,
		data_verificacao = sysdate()
		where id = '$id'";
		
		try {
			mysqli_autocommit($conexao, FALSE);
			mysqli_query($conexao, $sqlAgrupador);
			mysqli_commit($conexao);

		} catch (Exception $e) {
			mysqli_rollback($conexao);
		}
	}
}else{
	#colocar erro

}
header("Location: ../index.php?pg=2");


?>