<?php 
	include 'conexao/conn.php';
	
	$id 	= isset($_REQUEST['id']) ? $_REQUEST['id'] : "";
	$acao   = isset($_REQUEST['acao']) ?  $_REQUEST['acao'] : "";
	
	$nome      = "";
	$endereco  = "";
	$cidade_id = "";
	
	if ($acao == "a"){
		
		$sql = "select * from local where id = $id";		
		$rs = mysqli_query($conexao, $sql);
		
		while ($linha = mysqli_fetch_array($rs)) {
			$nome      = $linha['nome'];
			$endereco  = $linha['endereco'];
			$cidade_id = $linha['cidade_id'];
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
		
		<form action="local/gravar-local.php?acao=<?php echo $acao?>" method="post">
			<input type="hidden" name="id" value="<?php echo $id?>">
			<div class="col-lg-6">
				<div class="input-group" style="margin: 5px">
					<span class="input-group-addon">Nome</span> 
					<input type="text" name="nome" value="<?php echo $nome?>" class="form-control" placeholder="Digite o Nome do Local" required>
				</div>
								
				<div class="input-group" style="margin: 5px">
					<span class="input-group-addon">Endereço</span>
					<input type="text" name="endereco" value="<?php echo $endereco?>" class="form-control" placeholder="Digite o endereço" required>
				</div>
				
				<div class="input-group" style="margin: 5px">
					<span class="input-group-btn"> 
							<div class="input-group">
                               <span class="input-group-addon">Cidade:</span>
                               <select name="cidade_id" class="form-control" style="width:400px" required>
                                  	<option value='' selected>-- Escolha uma cidade --</option>
                                  	<?php 
                                  		
                                  		$sqlCidade = "select c.id, c.nome, u.sigla 
                                  		             from cidade c, uf u 
                                  		             where c.uf_id = u.id
                                  		             order by id";
                                  		$rsCidade = mysqli_query($conexao, $sqlCidade);
                                  		while($linha=mysqli_fetch_array($rsCidade)){
                                  			if ($linha['id'] == $cidade_id){
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
				
					<button class="btn btn-info" type="submit">Cadastrar</button>
			</div>
		</form>
		</p>

	</div>
</div>
