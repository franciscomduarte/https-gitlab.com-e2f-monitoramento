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
		
		<form action="usuario/gravar-usuario.php?acao=<?php echo $acao?>" method="post">
			<input type="hidden" name="id" value="<?php echo $id?>">
			<div class="col-lg-6">
				Nome:
				<div class="input-group">
					<span class="input-group-addon">#</span> 
					<input name="nome" value="<?php echo $nome?>" class="form-control" placeholder="Digite o nome" required>
				</div>
				Email:
				<div class="input-group">
					<span class="input-group-addon">@</span> 
					<input type="email" name="email" value="<?php echo $email?>" class="form-control" placeholder="Digite o email" required>
				</div>
				Senha:
				<div class="input-group">
					<input type="password" required name="senha" class="form-control" <?php echo $acao=='a' ? 'disabled':''?>>
				</div>
				Status
				<div class="input-group">
					<input type="radio" required name="situacao" value="1" <?php if ($ativo == 1) echo 'checked'?>>Ativo
					<input type="radio" required name="situacao" value="0" <?php if ($ativo == 0) echo 'checked'?>>Inativo
				</div>
				
				Perfil
				<div class="input-group">
					<input type="radio" required name="perfil" value="0" <?php if ($perfil == 0) echo 'checked'?>>Administrador
					<input type="radio" required name="perfil" value="1" <?php if ($perfil == 1) echo 'checked'?>>Usuário
				</div>
				
				<span class="input-group-btn" style="padding-top: 10px">
					<button class="btn btn-info" type="submit">Cadastrar</button>
				</span>
			</div>
		</form>
		</p>

	</div>
</div>
