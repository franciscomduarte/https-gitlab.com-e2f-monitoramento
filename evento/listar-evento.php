<div class="row row-offcanvas row-offcanvas-right">
	<div class="row">
		<div class="table-responsive">

			<button type="button" class="btn btn-info" style="margin-left: 10px" onclick="location.href='index.php?pg=14'">
				Novo Evento
			</button>

			<table class="table table-hover" id="example">
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
						<th width="190px">Op&ccedil;&otilde;es</th>
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
							where 1 = 1 
								and   e.ativo = 1 
					            and   e.local_id = l.id
								and   l.cidade_id = c.id
								and   u.id = c.uf_id
								and   us.id = e.usuario_cadastro_id
								order by data_inicio desc";
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
						<td width="20%">
							<button onclick="location.href='index.php?pg=14&acao=a&id=<?php echo $linha['id']?>'">
								<span class="glyphicon glyphicon-edit" title="Editar"></span>
							</button>
							<button onclick="location.href='index.php?pg=17&acao=a&id=<?php echo $linha['id']?>'">
								<span class="glyphicon glyphicon-tasks" title="Pr&eacute; Nominata"></span>
							</button>
							<button onclick="location.href='index.php?pg=18&acao=a&id=<?php echo $linha['id']?>'">
								<span class="glyphicon glyphicon-align-justify" title="Nominata"></span>
							</button>
							<button onclick="location.href='index.php?pg=19&acao=a&id=<?php echo $linha['id']?>'">
								<span class="glyphicon glyphicon-user" title="Convidados"></span>
							</button>
							<button onclick="chamaRelatorio(<?php echo $linha['id']?>);">
								<span class="glyphicon glyphicon-save-file" title="Exportar para PDF"></span>
							</button>
							<button onclick="excluir(<?php echo $linha['id']?>)">
									<span class="glyphicon glyphicon-trash" title="Excluir"></span>
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
<script>
	function excluir(id){
		var pag = "evento/gravar-evento.php?acao=e&id="+id;
		if (confirm("Tem certeza que deseja excluir este evento?")){
			location.href = pag;
		}
	}
	function chamaRelatorio(id){
		pagina = '/scc_cerimonial/relatorios/encaminha.php?id='+id;
		window.open(pagina,'_blank');
	}
</script>

