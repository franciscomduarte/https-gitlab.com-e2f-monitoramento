<?php 
	
	$id 	= isset($_REQUEST['id']) ? $_REQUEST['id'] : "";
	$acao   = isset($_REQUEST['acao']) ?  $_REQUEST['acao'] : "";
	$sigla = "";
	$nome  = "";
	
	if ($acao == "a"){
		include 'conexao/conn.php';
		$sql = "select * from posto_graduacao where id = $id";		
		$rs = mysqli_query($conexao, $sql);
		
		while ($linha = mysqli_fetch_array($rs)) {
			$sigla = $linha['sigla'];
			$nome  = $linha['nome'];
		}
	}else{
		$acao = "n";
	}
	
?>
<div class="row row-offcanvas row-offcanvas-right">
	<div class="row">
		<div class="table-responsive">
		
		<form method="post" action="index.php?pg=2">
			<button class="btn btn-info" type="button" onclick="history.go(-1);">Voltar</button>
		</form>
	
		<form action="posto-graduacao/gravar-posto-graduacao.php?acao=<?php echo $acao?>" method="post">
			<input type="hidden" name="id" value="<?php echo $id?>">
			<div class="col-lg-6">
				
				<div class="input-group" style="margin: 5px">
					<span class="input-group-addon">Sigla</span> 
					<input type="text" name="sigla" value="<?php echo $sigla ?>" class="form-control" placeholder="Digite a sigla" required>
				</div>
				
				<div class="input-group" style="margin: 5px">
					<span class="input-group-addon">Nome</span> 
					<input type="text" name="nome" value="<?php echo $nome?>" class="form-control" placeholder="Digite o Posto" required>
				</div>
				
					<button class="btn btn-info" type="submit">Cadastrar</button>
			</div>
		</form>
		</div>
	</div>
</div>
