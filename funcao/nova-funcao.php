<?php 
	include 'conexao/conn.php';
	
	$id 	= $_REQUEST['id'];
	$acao   = $_REQUEST['acao'];
	
	if ($acao == "a"){
		
		$sql = "select * from funcao where id = $id";		
		$rs = mysqli_query($conexao, $sql);
		
		while ($linha = mysqli_fetch_array($rs)) {
			$ordem    = $linha['ordem'];
			$nome     = $linha['nome'];
			$poder_id = $linha['poder_id'];
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
		
		<form action="funcao/gravar-funcao.php?acao=<?php echo $acao?>" method="post">
			<input type="hidden" name="id" value="<?php echo $id?>">
			<div class="col-lg-6">
				
				<div class="input-group">
					<span class="input-group-addon">Ordem</span> 
					<input type="text" name="ordem" value="<?php echo $ordem?>" class="form-control" placeholder="Digite a ordem" required size='5' maxlength='5'>
				</div>
				
				<div class="input-group">
					<span class="input-group-addon">Nome</span> 
					<input type="text" name="nome" value="<?php echo $nome?>" class="form-control" placeholder="Digite o Nome da Função" required>
				</div>
				
				<div class="row" style="margin-left: 2px;margin-bottom: 5px;">
					<span class="input-group-btn"> 
							<div class="input-group">
                               <span class="input-group-addon">Poder:</span>
                               <select name="poder_id" class="form-control" style="width:400px" required>
                                  	<option value='' selected>-- Escolha um poder --</option>
                                  	<?php 
                                  		
                                  		$sqlPoder = "select * from poder order by id";
                                  		$rsPoder = mysqli_query($conexao, $sqlPoder);
                                  		while($linha=mysqli_fetch_array($rsPoder)){
                                  			if ($linha['id'] == $poder_id){
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
