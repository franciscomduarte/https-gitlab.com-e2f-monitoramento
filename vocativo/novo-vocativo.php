<?php 
	include 'conexao/conn.php';
	
	$id 	= isset($_REQUEST['id']) ? $_REQUEST['id'] : "";
	$acao   = isset($_REQUEST['acao']) ?  $_REQUEST['acao'] : "";
	$nome     = "";
	
	if ($acao == "a"){
		
		$sql = "select * from vocativo where id = $id";		
		$rs = mysqli_query($conexao, $sql);
		
		while ($linha = mysqli_fetch_array($rs)) {
			$nome     = $linha['descricao'];
		}
	}else{
		$acao = "n";
	}
	
?>
<div class="row row-offcanvas row-offcanvas-right">
	<div class="row">
			<fieldset legend="Pesquisar">
				<form method="post" action="index.php?pg=40">
					<div class="row">
						<div class="col-lg-6" style="margin-left: 10px">

								<button class="btn btn-info" type="button"
									onclick="history.go(-1);">Voltar</button>

						</div>
					</div>
					<!-- /.row -->
				</form>
			</fieldset>
		<p>
		
		<form action="vocativo/gravar-vocativo.php?acao=<?php echo $acao?>" method="post">
			<input type="hidden" name="id" value="<?php echo $id?>">
			<div class="col-lg-6">
				
				<div class="input-group" style="margin: 5px">
					<span class="input-group-addon">Descrição</span> 
					<input type="text" name="descricao" value="<?php echo $nome?>" class="form-control" placeholder="Digite o Nome da Vocativo" required>
				</div>
				
				<button class="btn btn-info" type="submit">Cadastrar</button>
			</div>
		</form>
		</p>

	</div>
</div>
