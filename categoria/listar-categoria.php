<div class="row row-offcanvas row-offcanvas-right">
	<div class="row">
		<div class="table-responsive">

			<button type="button" class="btn btn-default btn-lg" onclick="location.href='index.php?pg=9'">
				Nova Categoria
			</button>

			<table class="table table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>C&oacute;digo</th>
						<th>Portugues</th>
						<th>Ingles</th>
						<th>Espanhol</th>
						<th>Total</th>
						<th>Op&ccedil;&otilde;es</th>
					</tr>
				</thead>
				<tbody id="myTable">
					<?php 

					require_once 'conexao/conn.php';

					$sql = "select *, 
							(select count(a.categoria_id) from agrupador a where a.categoria_id = c.id) as total_cadastro 
							from categoria c";
					$rs = mysqli_query($conexao, $sql);
					$num = 0;

					while ($linha = mysqli_fetch_array($rs)) {
			           	 $num++;
			           	 ?>
					<tr>
						<td><?php echo $num?></td>
						<td><?php echo $linha['id']?></td>
						<td><?php echo $linha['categoria_portugues']?></td>
						<td><?php echo $linha['categoria_ingles']?></td>
						<td><?php echo $linha['categoria_espanha']?></td>
						<td><?php echo $linha['total_cadastro']?></td>
						<td>
							<button onclick="excluir(<?php echo $linha['id']?>)">Excluir</button>
							<button onclick="location.href='index.php?pg=9&acao=a&id=<?php echo $linha['id']?>'">Alterar</button>
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
		var pag = "categoria/gravar-categoria.php?acao=e&id="+id;
		if (confirm("Tem certeza que deseja desativar essa categoria?")){
			location.href = pag;
		}
	}

	$(document).ready(function(){
	    		
	  $('#myTable').pageMe(
	    {
		  pagerSelector:'#myPager',
		  showPrevNext:true,
		  hidePageNumbers:false,
		  perPage:5,
		  totalPages:5
		 }); 
	  
	  });
</script>

