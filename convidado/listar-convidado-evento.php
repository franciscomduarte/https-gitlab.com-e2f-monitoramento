<div class="row row-offcanvas row-offcanvas-right">
	<div class="row">
		<div class="table-responsive">

			<fieldset legend="Pesquisar">
				<form method="post" action="index.php?pg=15" name="formulario" id="formulario_busca">
					<div class="row">
						<div class="col-lg-6">

						</div>
						<!-- /.col-lg-6 -->
						<div class="col-lg-6">
							<div class="input-group">
								<input type="text" class="form-control" name="busca" value="<?php echo isset($_POST['busca']) ? $_POST['busca'] : "" ?>" 
									   placeholder="Digite o nome, local ou detalhes do Evento"> 
								<span
									class="input-group-btn" >
									<button class="btn btn-default" type="submit">Procurar</button>
								</span>
							</div>
							<!-- /input-group -->
						</div>
						<!-- /.col-lg-6 -->
					</div>
					<!-- /.row -->
				</form>

			</fieldset>


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
						<th>C&oacute;digo</th>
						<th>Nome</th>
						<th>Periodo</th>
						<th>Convidados</th>
						<th>Descrição</th>
						<th>Local</th>
						<th>Usuário</th>
						<th>Op&ccedil;&otilde;es</th>
					</tr>
				</thead>
				<tbody id="myTable">
					<?php 

					require_once 'conexao/conn.php';
                    
					$sql = "select e.id, e.nome, date_format(e.data_inicio,'%d/%m/%Y %H:%i') as data_inicio, 
							date_format(e.data_fim,'%d/%m/%Y %H:%i') as data_fim,
							e.descricao, (select count(*) from convidado where evento_id = e.id) as total,
					        concat(l.nome,'<br>' ,l.endereco,' - ',c.nome,' - ',u.sigla) as nome_local,
					        us.nome as nome_usuario
							from evento e, local l, cidade c, uf u, usuario us
							where e.local_id = l.id
							and   l.cidade_id = c.id
							and   u.id = c.uf_id
							and   us.id = e.usuario_cadastro_id 
							and   e.data_inicio >= curdate() ";

					if (isset($_REQUEST["busca"])){
						$sql .= "and (e.nome like '%".$_REQUEST['busca']."%' 
								or e.descricao  like '%".$_REQUEST['busca']."%' 
								or concat(l.nome,'<br>' ,l.endereco,' - ',c.nome,' - ',u.sigla) like '%".$_REQUEST['busca']."%') ";
					}
					
					$sql .= "order by data_inicio desc";
					#echo $sql;
					
					$rs = mysqli_query($conexao, $sql);
					$num = 0;

					while ($linha = mysqli_fetch_array($rs)) {
			           	 $num++;
			           	 ?>
					<tr>
						<td><?php echo $num?></td>
						<td><?php echo $linha['id']?></td>
						<td><?php echo $linha['nome']?></td>
						<td style="font-size: 12px"><?php echo $linha['data_inicio']."<br/>".$linha['data_fim']?></td>
						<td align="right"><?php echo $linha['total']?></td>
						<td><?php echo $linha['descricao']?></td>
						<td style="font-size: 11px"><?php echo $linha['nome_local']?></td>
						<td style="font-size: 11px"><?php echo $linha['nome_usuario']?></td>
						<td>
							<!-- <button onclick="excluir(<?php echo $linha['id']?>)" 
									<?php echo $linha['total'] > 0 ? "disabled title='Evento possui convidados.'" : ""?>>Excluir</button> -->
							<button class="btn btn-info" onclick="location.href='index.php?pg=16&acao=a&id=<?php echo $linha['id']?>'">Incluir Convidados</button>
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
<div class="col-md-12 text-center">
	<ul class="pagination" id="myPager"></ul>
</div>
<script src="js/paginacao.js"></script>
<script>
	function excluir(id){
		var pag = "evento/gravar-evento.php?acao=e&id="+id;
		if (confirm("Tem certeza que deseja excluir este evento?")){
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

