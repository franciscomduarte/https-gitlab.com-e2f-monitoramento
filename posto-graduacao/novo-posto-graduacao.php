<?php 
	$id 	= $_REQUEST['id'];
	$acao   = $_REQUEST['acao'];
	
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

			<fieldset legend="Pesquisar">
				<form method="post" action="index.php?pg=2">
					<div class="row">
						<div class="col-lg-6">

							<span class="input-group-btn">
								<button class="btn btn-info" type="button"
									onclick="history.go(-1);">Voltar</button>
							</span>

						</div>
					</div>
					<!-- /.row -->
				</form>
			</fieldset>
		</div>
		<p>
		
		<form action="posto-graduacao/gravar-posto-graduacao.php?acao=<?php echo $acao?>" method="post">
			<input type="hidden" name="id" value="<?php echo $id?>">
			<div class="col-lg-6">
				
				<div class="input-group">
					<span class="input-group-addon">Sigla</span> 
					<input type="text" name="sigla" value="<?php echo $sigla?>" class="form-control" placeholder="Digite a sigla" required>
				</div>
				
				<div class="input-group">
					<span class="input-group-addon">Nome</span> 
					<input type="text" name="nome" value="<?php echo $nome?>" class="form-control" placeholder="Digite o Posto" required>
				</div>
				
				<span class="input-group-btn" style="padding-top: 10px">
					<button class="btn btn-info" type="submit">Cadastrar</button>
				</span>
			</div>
		</form>
		</p>

	</div>
</div>
