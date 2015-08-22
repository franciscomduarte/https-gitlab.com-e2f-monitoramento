<div class="row row-offcanvas row-offcanvas-right">
	<div class="row">
		<div>
			<form method="post" action="index.php?pg=10" name="formulario" id="formulario_busca">
				<div class="row">
					<div class="col-lg-6">
							<button class="btn btn-info" type="button"
								onclick="location.href='index.php?pg=11'">Criar Novo</button>
					</div>
						<!-- /.col-lg-6 -->
					<div class="col-lg-6">
						<div class="input-group">
							<input type="text" class="form-control" name="busca" id="busca" value="<?php echo isset($_POST['busca']) ? $_POST['busca'] : "" ?>" 
								   placeholder="Digite sua pesquisa..."> 
							<span class="input-group-btn" >
								<button class="btn btn-default" type="submit">Procurar</button>
							</span>
						</div>
							<!-- /input-group -->
					</div>
						<!-- /.col-lg-6 -->
				</div>
					<!-- /.row -->
			</form>
		</div>
		
	</div>
</div>
<div class="row row-offcanvas row-offcanvas-right">
	<div class="row">
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Foto</th>
						<th>Ordem</th>
						<th>Nome</th>
						<th>Inclus&atilde;o</th>
						<th>E-mail</th>
						<th>Telefone(s)</th>
						<th>Op&ccedil;&otilde;es</th>
					</tr>
				</thead>
				<tbody id="myTable">
					<?php
					require_once 'conexao/conn.php';
				
					$sql = "select p.id, p.nome as nome_pessoa, p.foto, p.ordem, p.email, p.telefone_1, p.telefone_2,
								date_format(data_criacao,'%d/%m/%Y %T') as data_cadastro_formatada,
								p.posto_graduacao_id, 
								f.nome as nome_funcao, pp.nome as nome_poder
								from pessoa p, funcao f, poder pp
								where p.funcao_id = f.id
								and pp.id = f.poder_id ";
			
					if (isset($_REQUEST['busca']))
						$sql .= "and p.nome like '%".$_REQUEST['busca']."%' ";
					
					$sql.= "order by p.ordem";
					
					$rs = mysqli_query($conexao, $sql);
					$num = 0;
			
					while ($linha = mysqli_fetch_array($rs)) {
			                        $num++;
			                        ?>
					<tr>
						<td><?php echo $num ?></td>
						<td>
							<?php 
								if ($linha['foto']){
									$arrayFoto 	  = explode(".",$linha['foto']);
									$foto_pequena = $arrayFoto[0]."_tumb".".".$arrayFoto[1];
									echo "<img src='fotos/".$foto_pequena."' width='40' height='40'>";
								}else{
									echo "<img src='img/icone_perfil.fw.png' width='40' height='40'>";	
								}
			
							?>
						</td>
						<td><?php echo $linha['ordem'] ?></td>
						<td><?php 
								if ($linha['posto_graduacao_id']){
									$sqlPosto = "select * from posto_graduacao where id = ".$linha['posto_graduacao_id'];
									$rsPosto  = mysqli_query($conexao, $sqlPosto);
									if($linha_posto = mysqli_fetch_array($rsPosto)){
										echo "<i><b>".$linha_posto['nome']."&nbsp;</b></i>";
									}
								}
								echo $linha['nome_pessoa']."<br />(".$linha['nome_funcao'].")"; 
							?>
						</td>
						<td><?php echo $linha['data_cadastro_formatada']?></td>
						<td><?php echo $linha['email'] ?></td>
						<td><?php 
								echo $linha['telefone_1'];
								if ($linha['telefone_2'])
									echo  "<br/>".$linha['telefone_2'];
							?>
						</td>
						
						<td>
							<button onclick="location.href='index.php?pg=11&acao=a&id=<?php echo $linha['id']?>'">
								<span class="glyphicon glyphicon-edit" title="Editar"></span>
							</button>
						</td>
			
					</tr>
			
					<?php
			           }
			        ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="row">
	<?php echo mysqli_num_rows($rs)?> Registros encontrados
	<div class="col-md-12 text-center">
		<ul class="pagination" id="myPager"></ul>
	</div>
</div>
<script src="js/paginacao.js"></script>
<script>
	function excluir(id){
		var pag = "pessoa/gravar-pessoa.php?acao=e&id="+id;
		if (confirm("Tem certeza que deseja excluir esta pessoa?")){
			location.href = pag;
		}
	}

	function chamaPesquisa(){
		$('#formulario_busca').submit();
		//formulario.submit();
	}
	
	$(document).ready(function(){
	  $('#myTable').pageMe(
	    {
		  pagerSelector:'#myPager',
		  showPrevNext:true,
		  hidePageNumbers:false,
		  perPage:10,
		  totalPages:5
		 }); 

	 
	  });
	 
</script>

