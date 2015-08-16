<?php 
	$id 	= $_REQUEST['id'];
	$acao   = $_REQUEST['acao'];
	
	if ($acao == "a"){
		include 'conexao/conn.php';
		$sql = "select * from categoria where id = $id";		
		$rs = mysqli_query($conexao, $sql);
		
		while ($linha = mysqli_fetch_array($rs)) {
			$categoria_portugues = $linha['categoria_portugues'];
			$categoria_ingles 	 = $linha['categoria_ingles'];
			$categoria_espanha 	 = $linha['categoria_espanha'];
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
		
		<form action="categoria/gravar-categoria.php?acao=<?php echo $acao?>" method="post">
			<input type="hidden" name="id" value="<?php echo $id?>">
			<div class="col-lg-6">
				Portugues:
				<div class="input-group">
					<span class="input-group-addon">Nome</span> 
					<input type="text" name="categoria_portugues" value="<?php echo $categoria_portugues?>" class="form-control" placeholder="Categoria Portugues" required>
				</div>
				Ingles:
				<div class="input-group">
					<span class="input-group-addon">Nome</span> 
					<input type="text" name="categoria_ingles" value="<?php echo $categoria_ingles?>" class="form-control" placeholder="Categoria Ingles" required>
				</div>
				Espanhol:
				<div class="input-group">
					<span class="input-group-addon">Nome</span> 
					<input type="text" name="categoria_espanha" value="<?php echo $categoria_espanha?>" class="form-control" placeholder="Categoria Espanhol" required>
				</div>
				
				
				<span class="input-group-btn" style="padding-top: 10px">
					<button class="btn btn-info" type="submit">Cadastrar</button>
				</span>
			</div>
		</form>
		</p>

	</div>
</div>
