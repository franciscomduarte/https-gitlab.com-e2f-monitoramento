<?php 
include_once '../header_exportar.php';

if ($_GET['id']){
	$pagina = "lista-de-convidados.php?id=".$_GET['id'];
}else{ 
	$pagina = "lista-de-funcoes.php";
}

?>
<meta
	http-equiv="refresh"
	content="0; url=<?php echo $pagina?>">

<center>
	<div class="panel panel-default">
		<div class="alert alert-success" role="alert">
			Aguarde a exporta&ccedil;&atilde;o Para PDF, esta
			opera&ccedil;&atilde;o pode demorar alguns minutos. <img
				src="../img/load_bar.gif" align="center">
		</div>
	</div>
</center>
