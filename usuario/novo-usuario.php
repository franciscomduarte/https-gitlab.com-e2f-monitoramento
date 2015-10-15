<?php 
	$id 	= $_REQUEST['id'];
	$acao   = $_REQUEST['acao'];
	
	if ($acao == "a"){
		include 'conexao/conn.php';
		$sql = "select * from usuario where id = $id";		
		$rs = mysqli_query($conexao, $sql);
		
		while ($linha = mysqli_fetch_array($rs)) {
			$nome 	  = $linha['nome'];
			$email 	  = $linha['email'];
			$ativo    = $linha['ativo'];
			$perfil   = $linha['perfil'];
		}
	}else{
		$acao = "n";
	}
	
?>
<div class="row row-offcanvas row-offcanvas-right">
	<div class="row">
		<div class="table-responsive">

				<form method="post" action="index.php?pg=2">
					<div class="row">
						<div class="col-lg-6">

								<button class="btn btn-info" type="button"
									onclick="history.go(-1);">Voltar</button>

						</div>
					</div>
					<!-- /.row -->
				</form>
		</div>
		<p>
		
		<form action="usuario/gravar-usuario.php?acao=<?php echo $acao?>" method="post">
			<input type="hidden" name="id" value="<?php echo $id?>">
			<div class="col-lg-6">
				
				<div class="input-group" style="margin: 5px">
					<span class="input-group-addon">Nome:</span> 
					<input name="nome" value="<?php echo $nome?>" class="form-control" placeholder="Digite o nome" required>
				</div>
				
				<div class="input-group" style="margin: 5px">
					<span class="input-group-addon">Email:</span> 
					<input type="email" name="email" value="<?php echo $email?>" class="form-control" placeholder="Digite o email" required>
				</div>
				
				<div class="input-group" style="margin: 5px">
					<span class="input-group-addon">Senha:</span> 
					<input type="password" required name="senha" class="form-control" <?php echo $acao=='a' ? 'disabled':''?>>
				</div>
				
				<div class="input-group" style="margin: 5px">
					<span class="input-group-addon">Status:</span> 
					<input type="radio" required name="situacao" value="1" <?php if ($ativo == 1) echo 'checked'?>>Ativo
					<input type="radio" required name="situacao" value="0" <?php if ($ativo == 0) echo 'checked'?>>Inativo
				</div>
				
				
				<div class="input-group" style="margin: 5px">
					<span class="input-group-addon">Perfil:</span> 
					<input type="radio" required name="perfil" value="0" <?php if ($perfil == 0) echo 'checked'?>>Administrador
					<input type="radio" required name="perfil" value="1" <?php if ($perfil == 1) echo 'checked'?>>Usuário
				</div>
				
					<button class="btn btn-info" type="submit">Cadastrar</button>
			</div>
		</form>

	</div>
</div>
