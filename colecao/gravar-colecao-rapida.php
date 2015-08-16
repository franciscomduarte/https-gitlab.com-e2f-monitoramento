<?php 
include '../conexao/conn.php';

$acao  = $_REQUEST['acao'];
$id	   = $_REQUEST['id'];



$elementosPortugues = explode(chr(13),$_POST['arrayPortugues']);
$elementosIngles    = explode(chr(13),$_POST['arrayIngles']);
$elementosEspanha   = explode(chr(13),$_POST['arrayEspanha']);

#dados do formulario

##################### PORTUGUES ############################
$colecao_portugues   = str_replace("'", "\'",trim($elementosPortugues[0]));
$contido   		     = $_REQUEST['contido'];
$resposta_correta    = $_REQUEST['resposta_correta'];
$categoria_id		 = $_REQUEST['categoria'];
#elementos
$elemento1_portugues = str_replace("'", "\'",trim($elementosPortugues[1]));
$elemento2_portugues = str_replace("'", "\'",trim($elementosPortugues[2]));
$elemento3_portugues = str_replace("'", "\'",trim($elementosPortugues[3]));
$elemento4_portugues = str_replace("'", "\'",trim($elementosPortugues[4]));
$elemento5_portugues = str_replace("'", "\'",trim($elementosPortugues[5]));
$elemento6_portugues = str_replace("'", "\'",trim($elementosPortugues[6]));
$elemento7_portugues = str_replace("'", "\'",trim($elementosPortugues[7]));
$elemento8_portugues = str_replace("'", "\'",trim($elementosPortugues[8]));

##################### INGLES ###############################

$colecao_ingles = str_replace("'", "\'",trim($elementosIngles[0]));
#elementos
$elemento1_ingles = str_replace("'", "\'",trim($elementosIngles[1]));
$elemento2_ingles = str_replace("'", "\'",trim($elementosIngles[2]));
$elemento3_ingles = str_replace("'", "\'",trim($elementosIngles[3]));
$elemento4_ingles = str_replace("'", "\'",trim($elementosIngles[4]));
$elemento5_ingles = str_replace("'", "\'",trim($elementosIngles[5]));
$elemento6_ingles = str_replace("'", "\'",trim($elementosIngles[6]));
$elemento7_ingles = str_replace("'", "\'",trim($elementosIngles[7]));
$elemento8_ingles = str_replace("'", "\'",trim($elementosIngles[8]));


################### espanha ##################################

$colecao_espanha   = str_replace("'", "\'",trim($elementosEspanha[0]));
#elementos
$elemento1_espanha = str_replace("'", "\'",trim($elementosEspanha[1]));
$elemento2_espanha = str_replace("'", "\'",trim($elementosEspanha[2]));
$elemento3_espanha = str_replace("'", "\'",trim($elementosEspanha[3]));
$elemento4_espanha = str_replace("'", "\'",trim($elementosEspanha[4]));
$elemento5_espanha = str_replace("'", "\'",trim($elementosEspanha[5]));
$elemento6_espanha = str_replace("'", "\'",trim($elementosEspanha[6]));
$elemento7_espanha = str_replace("'", "\'",trim($elementosEspanha[7]));
$elemento8_espanha = str_replace("'", "\'",trim($elementosEspanha[8]));


#condiчуo que verifica se uma das aчѕes foram passadas
if ($acao == "n" || $acao == "e" || $acao == "a" ){
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
			#echo $sql;

		}catch (Exception $e){
			mysqli_rollback($conexao);
			echo $e;
		}

	}elseif ($acao == "e"){
		//Esta aчуo nуo exclui o usuсrio, apenas inativa.
		$sql = "delete from agrupador where id = $id;";
		mysqli_query($conexao, $sql);
		
	}elseif ($acao == "a"){
		
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
			
			mysqli_query($conexao, $sqlPortugues);
			mysqli_query($conexao, $sqlIngles);
			mysqli_query($conexao, $sqlEspanha);
			
			mysqli_commit($conexao);
			
		} catch (Exception $e) {
			mysqli_rollback($conexao);
		}
		
		
	}

}else{
	#colocar um erro...
}
header("Location: ../index.php?pg=80");


?>