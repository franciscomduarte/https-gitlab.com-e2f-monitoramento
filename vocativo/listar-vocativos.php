<div class="row row-offcanvas row-offcanvas-right">
	<div class="row">
		<div class="table-responsive">

			<button type="button" style="margin-left: 10px" class="btn btn-info" onclick="location.href='index.php?pg=41'">
				Novo Vocativo
			</button>

			<table class="table table-hover" id="example">
				<thead>
					<tr>
						<th>#</th>
						<th>Descrição</th>
						<th>Op&ccedil;&otilde;es</th>
					</tr>
				</thead>
				<tbody id="myTable">
					<?php 

					require_once 'conexao/conn.php';
                    
					$sql = "select p.id, p.descricao
							from vocativo p
							order by descricao";
					$rs = mysqli_query($conexao, $sql);
					$num = 0;

					while ($linha = mysqli_fetch_array($rs)) {
			           	 $num++;
			           	 ?>
					<tr>
						<td><?php echo $num?></td>
						<td><?php echo $linha['descricao']?></td>
						<td>
							<button onclick="location.href='index.php?pg=41&acao=a&id=<?php echo $linha['id']?>'">
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
		var pag = "vocativo/gravar-vocativo.php?acao=e&id="+id;
		if (confirm("Tem certeza que deseja excluir este vocativo?")){
			location.href = pag;
		}
	}
</script>

