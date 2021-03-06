<div class="row row-offcanvas row-offcanvas-right">
	<div class="row">
		<div class="table-responsive">

			<button type="button" class="btn btn-info" style="margin-left: 10px" onclick="location.href='index.php?pg=12'">
				Novo Local
			</button>

			<table class="table table-hover" id="example">
				<thead>
					<tr>
						<th>#</th>
						<th>C&oacute;digo</th>
						<th>Nome</th>
						<th>Endereço</th>
						<th>Cidade</th>
						<th>Op&ccedil;&otilde;es</th>
					</tr>
				</thead>
				<tbody id="myTable">
					<?php 

					require_once 'conexao/conn.php';
                    
					$sql = "select l.id, l.nome, l.endereco, concat(c.nome,' - ',u.sigla) as nome_cidade
							from local l, cidade c, uf u
							where l.cidade_id = c.id
							and   u.id = c.uf_id
							order by nome";
					$rs = mysqli_query($conexao, $sql);
					$num = 0;

					while ($linha = mysqli_fetch_array($rs)) {
			           	 $num++;
			           	 ?>
					<tr>
						<td><?php echo $num?></td>
						<td><?php echo $linha['id']?></td>
						<td><?php echo $linha['nome']?></td>
						<td><?php echo $linha['endereco']?></td>
						<td><?php echo $linha['nome_cidade']?></td>
						<td>
							<button onclick="location.href='index.php?pg=12&acao=a&id=<?php echo $linha['id']?>'">
								<span class="glyphicon glyphicon-edit" title="Editar"></span>
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
		var pag = "local/gravar-local.php?acao=e&id="+id;
		if (confirm("Tem certeza que deseja excluir este local?")){
			location.href = pag;
		}
	}
</script>

