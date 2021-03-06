<div class="row row-offcanvas row-offcanvas-right">
	<div class="row">
		<div class="table-responsive">

			<table class="table table-hover" id="example">
				<thead>
					<tr>
						<th>#</th>
						<th>C&oacute;digo</th>
						<th width="50%">Nome</th>
						<th>Periodo</th>
						<th width="8%">Convidados</th>
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
							where e.ativo = 1
							and   e.local_id = l.id
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
						<td><?php echo $linha['data_inicio']."<br/>".$linha['data_fim']?></td>
						<td align="center" style="font-size : 18px"><?php echo $linha['total']?></td>
						<td>
							<!-- <button onclick="excluir(<?php echo $linha['id']?>)" 
									<?php echo $linha['total'] > 0 ? "disabled title='Evento possui convidados.'" : ""?>>Excluir</button> -->
							<button class="btn btn-success btn-lg" onclick="location.href='index.php?pg=21&acao=a&id=<?php echo $linha['id']?>'">Confirmar Presen&ccedil;a</button>
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
</script>

