<?php 
include 'conexao/conn.php';

	$id 	= isset($_REQUEST['id']) ? $_REQUEST['id'] : "";
	$acao   = isset($_REQUEST['acao']) ?  $_REQUEST['acao'] : "";
	
	$nome                  = "";
	$data_inicio           = "";
	$data_fim              = "";
	$descricao             = "";
	$local_id              = "";
	$usuario_cadastro_id   = "";

if ($acao == "a"){

	$sql = "select e.id, e.nome, 
			date_format(e.data_inicio,'%Y-%m-%d') as data_inicio, 
			date_format(e.data_fim,'%Y-%m-%d') as data_fim, 
			trim(e.descricao) as descricao, e.local_id, e.usuario_cadastro_id 
			from evento e 
			where id = $id";
	$rs = mysqli_query($conexao, $sql);

	while ($linha = mysqli_fetch_array($rs)) {
		$nome                  = $linha['nome'];
		$data_inicio           = $linha['data_inicio'];
		$data_fim              = $linha['data_fim'];
		$descricao             = trim($linha['descricao']);
		$local_id              = $linha['local_id'];
		$usuario_cadastro_id   = $linha['usuario_cadastro_id'];
	}
}else{
	$acao = "n";
}

?>
<div class="row row-offcanvas row-offcanvas-right">
	<div class="row">
		<div>
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
		
		<form action="evento/gravar-evento.php?acao=<?php echo $acao?>" method="post">
			<input type="hidden" name="id" value="<?php echo $id?>">

			<div class="input-group" style="margin: 5px">
					<span class="input-group-addon">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nome&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
					<input type="text" name="nome" value="<?php echo $nome?>"
						class="form-control" placeholder="Digite o Nome do Evento"
						required>
			</div>

			<span padding-top="1px"></span>

			<div class="row" style="margin: 5px">
				<div class="input-group col-xs-6 col-md-3">
					<span class="input-group-addon">Data Evento</span> <input
						type="date" name="data_inicio" value="<?php echo $data_inicio?>"
						class="form-control" required> <input type="date" name="data_fim"
						value="<?php echo $data_fim?>" class="form-control">
				</div>
			</div>

			<div class="row" style="margin: 5px">
				<div class="input-group col-xs-8 col-md-6">
					<span class="input-group-addon">&nbsp;&nbsp;Descri&ccedil;&atilde;o&nbsp;&nbsp;</span> 
						<textarea name="descricao" rows="3" cols="230" class="form-control" style="text-align: inherit;" maxlength="150" required><?php echo $descricao?></textarea>
				</div>
			</div>

			<div class="row" style="margin: 5px;">
				<span class="input-group-btn">
					<div class="input-group col-xs-8 col-md-4">
						<span class="input-group-addon">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Local&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
						<select name="local_id" class="form-control" style="width: 400px"
							required>
							<option value='' selected>-- Escolha um local --</option>
							<?php 

							$sqlLocal = "select lc.id,lc.nome as nome_local,
										 c.nome as nome_cidade, u.sigla
										 from local lc, cidade c, uf u
										 where lc.cidade_id = c.id
										 and  c.uf_id = u.id order by lc.nome asc";
							$rsLocal = mysqli_query($conexao, $sqlLocal);

							while($linha=mysqli_fetch_array($rsLocal)){
								$nome_local = $linha['nome_local']." - ".$linha['nome_cidade']."/".$linha['sigla'];
                              	if ($linha['id'] == $local_id){
                           			$escolhido = "selected";
                       			}else{
                       				$escolhido = "";
                       			}
                              		$opcao = "<option value='".$linha['id']."' ".$escolhido.">".$nome_local."</option>";
                              		echo $opcao;
                            }
                              		 
                           ?>
						</select>
				
				</span>
			</div>
	
	</div>

	<div class="row" style="margin: 5px;">
				<button class="btn btn-info" type="submit">Cadastrar</button>
	</div>

	</form>
	
</div>
