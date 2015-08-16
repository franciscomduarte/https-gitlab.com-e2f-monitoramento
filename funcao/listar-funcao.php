<div class="row row-offcanvas row-offcanvas-right">
	<div class="row">
		<div class="table-responsive">

			<button type="button" class="btn btn-default btn-lg" onclick="location.href='index.php?pg=4'">
				Nova Função
			</button>

			<table class="table table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>C&oacute;digo</th>
						<th>Ordem</th>
						<th>Nome</th>
						<th>Poder</th>
						<th>Op&ccedil;&otilde;es</th>
					</tr>
				</thead>
				<tbody id="myTable">
					<?php 

					require_once 'conexao/conn.php';
                    
					$sql = "select f.id, f.ordem, f.nome, p.nome as nome_poder
							from funcao f, poder p
							where f.poder_id = p.id
							order by ordem";
					$rs = mysqli_query($conexao, $sql);
					$num = 0;

					while ($linha = mysqli_fetch_array($rs)) {
			           	 $num++;
			           	 ?>
					<tr>
						<td><?php echo $num?></td>
						<td><?php echo $linha['id']?></td>
						<td><?php echo $linha['ordem']?></td>
						<td><?php echo $linha['nome']?></td>
						<td><?php echo $linha['nome_poder']?></td>
						<td>
							<button onclick="excluir(<?php echo $linha['id']?>)">Excluir</button>
							<button onclick="location.href='index.php?pg=4&acao=a&id=<?php echo $linha['id']?>'">Alterar</button>
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
		var pag = "funcao/gravar-funcao.php?acao=e&id="+id;
		if (confirm("Tem certeza que deseja excluir esta função?")){
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

