<div class="row row-offcanvas row-offcanvas-right">
	<div class="row">
		<div class="table-responsive">

			<button type="button" style="margin-left: 10px" class="btn btn-info" onclick="location.href='index.php?pg=23'">
				Nova Poder
			</button>

			<table class="table table-hover" id="example">
				<thead>
					<tr>
						<th>#</th>
						<th>Nome</th>
						<th>Op&ccedil;&otilde;es</th>
					</tr>
				</thead>
				<tbody id="myTable">
					<?php 

					require_once 'conexao/conn.php';
                    
					$sql = "select p.id, p.nome
							from poder p
							order by nome";
					$rs = mysqli_query($conexao, $sql);
					$num = 0;

					while ($linha = mysqli_fetch_array($rs)) {
			           	 $num++;
			           	 ?>
					<tr>
						<td><?php echo $num?></td>
						<td><?php echo $linha['nome']?></td>
						<td>
							<button onclick="location.href='index.php?pg=23&acao=a&id=<?php echo $linha['id']?>'">
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
<script>
	function excluir(id){
		var pag = "funcao/gravar-funcao.php?acao=e&id="+id;
		if (confirm("Tem certeza que deseja excluir esta função?")){
			location.href = pag;
		}
	}
</script>

