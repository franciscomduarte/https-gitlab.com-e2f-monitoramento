<?php 
	include 'conexao/conn.php';
	
	$id 	= $_REQUEST['id'];
	$acao   = $_REQUEST['acao'];
	
	if ($acao == "a"){
		
		$sql = "select * from pessoa where id = $id";		
		$rs = mysqli_query($conexao, $sql);
		
		while ($linha = mysqli_fetch_array($rs)) {
			
			$foto                = $linha['foto'];
			$ordem               = $linha['ordem'];
			$nome                = $linha['nome'];
			$email        		 = $linha['email'];
			$telefone_1   		 = $linha['telefone_1'];
			$telefone_2   		 = $linha['telefone_2'];
			$data_criacao 		 = $linha['data_criacao'];
			$posto_graduacao_id  = $linha['posto_graduacao_id'];
			$funcao_id           = $linha['funcao_id'];
			$usuario_cadastro_id = $linha['usuario_cadastro_id'];
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
		
		<form action="pessoa/gravar-pessoa.php?acao=<?php echo $acao?>" method="post">
			<input type="hidden" name="id" value="<?php echo $id?>">
			<div class="col-lg-6">
			
				<div class="input-group">
					<span class="input-group-addon">Foto</span> 
					<input type="text" name="foto" value="<?php echo $foto?>" class="form-control" placeholder="Foto" required>
				</div>
				
				<div class="input-group">
					<span class="input-group-addon">Ordem</span> 
					<input type="text" name="ordem" value="<?php echo $ordem ?>" class="form-control" placeholder="Digite a Ordem" required>
				</div>
			
				<div class="input-group">
					<span class="input-group-addon">Nome</span> 
					<input type="text" name="nome" value="<?php echo $nome?>" class="form-control" placeholder="Digite o Nome" required>
				</div>
				
				<div class="input-group">
					<span class="input-group-addon">Email</span> 
					<input type="text" name="email" value="<?php echo $email ?>" class="form-control" placeholder="Digite o Email" required>
				</div>
				
				<div class="input-group">
					<span class="input-group-addon">Telefone 1</span> 
					<input type="text" name="telefone_1" value="<?php echo $telefone_1?>" class="form-control" placeholder="Digite o Telefone 1" required>
				</div>
				
				<div class="input-group">
					<span class="input-group-addon">Telefone 2</span> 
					<input type="text" name="telefone_2" value="<?php echo $telefone_2?>" class="form-control" placeholder="Digite o Telefone 2" required>
				</div>
								
				<div class="row" style="margin-left: 2px;margin-bottom: 5px;">
					<span class="input-group-btn"> 
							<div class="input-group">
                               <span class="input-group-addon">Posto Graduação:</span>
                               <select name="posto_graduacao_id" class="form-control" style="width:400px" required>
                                  	<option value='' selected>-- Escolha uma cidade --</option>
                                  	<?php 
                                  		
                                  		$sqlPosto = " select * from posto_graduacao ";
                                  		$rsPosto = mysqli_query($conexao, $sqlPosto);
                                  		while($linha=mysqli_fetch_array($rsPosto)){
                                  			if ($linha['id'] == $posto_graduacao_id){
                                  				$escolhido = "selected";
                                  			}else{
                                  				$escolhido = "";
                                  			}
											$opcao = "<option value='".$linha['id']."' ".$escolhido.">".$linha['nome']."-".$linha['sigla']."</option>";
                                  			echo $opcao;
                                  		}	
                                  	
                                  	?>
                                </select>
                            </div>
					</span>
				</div>
				
				<div class="row" style="margin-left: 2px;margin-bottom: 5px;">
					<span class="input-group-btn"> 
							<div class="input-group">
                               <span class="input-group-addon">Função:</span>
                               <select name="funcao_id" class="form-control" style="width:400px" required>
                                  	<option value='' selected>-- Escolha uma cidade --</option>
                                  	<?php 
                                  		
                                  		$sqlFuncao = " select * from funcao ";
                                  		$rsFuncao = mysqli_query($conexao, $sqlFuncao);
                                  		while($linha=mysqli_fetch_array($rsFuncao)){
                                  			if ($linha['id'] == $funcao_id){
                                  				$escolhido = "selected";
                                  			}else{
                                  				$escolhido = "";
                                  			}
											$opcao = "<option value='".$linha['id']."' ".$escolhido.">".$linha['nome']."</option>";
                                  			echo $opcao;
                                  		}	
                                  	
                                  	?>
                                </select>
                            </div>
					</span>
				</div>
				
				<span class="input-group-btn" style="padding-top: 10px">
					<button class="btn btn-info" type="submit">Cadastrar</button>
				</span>
			</div>
		</form>
		</p>

	</div>
</div>
