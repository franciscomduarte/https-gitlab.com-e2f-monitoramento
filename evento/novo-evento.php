<?php 
	include 'conexao/conn.php';
	
	$id 	= $_REQUEST['id'];
	$acao   = $_REQUEST['acao'];
	
	if ($acao == "a"){
		
		$sql = "select * from evento where id = $id";		
		$rs = mysqli_query($conexao, $sql);
		
		while ($linha = mysqli_fetch_array($rs)) {
			$nome                  = $linha['nome'];
			$data_inicio           = $linha['data_inicio'];
			$data_fim              = $linha['data_fim'];
			$descricao             = $linha['descricao'];
			$local_id              = $linha['local_id'];
			$usuario_cadastro_id   = $linha['usuario_cadastro_id'];
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
		
		<form action="evento/gravar-evento.php?acao=<?php echo $acao?>" method="post">
			<input type="hidden" name="id" value="<?php echo $id?>">
			<div class="col-lg-12">
				<div class="input-group" style="margin:5px">
					<span class="input-group-addon">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nome&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> 
					<input type="text" name="nome" value="<?php echo $nome?>" class="form-control" placeholder="Digite o Nome do Evento" required>
				</div>
			</div>
			
			<span padding-top="5px"></span>				
			
			<div class="col-lg-4">
				<div class="input-group" style="margin:5px">
					<span class="input-group-addon">Data Evento</span> 
					<input type="date" name="data_inicio" size="12" value="<?php echo $data_inicio?>" class="form-control" placeholder="Início" required>
    		        <input type="date" name="data_fim" value="<?php echo $data_fim?>" class="form-control" placeholder="Fim" required>
    		    </div>
		    </div>

		    <div class="row col-lg-12" style="padding-top: 5px;">
				<span class="input-group-btn"> 
					<div class="input-group">
                       <span class="input-group-addon">&nbsp;&nbsp;&nbsp;&nbsp;Cidade&nbsp;&nbsp;&nbsp;&nbsp;</span>
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
			
			<div class="row col-lg-12" style="margin:5px">
			    <span class="input-group-btn" style="padding-top: 10px">
					<button class="btn btn-info" type="submit">Cadastrar</button>
				</span>
			</div>
		</form>
		</p>

	</div>
</div>
