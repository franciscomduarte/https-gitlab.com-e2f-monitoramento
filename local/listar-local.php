<div class="row row-offcanvas row-offcanvas-right">
	<div class="row">
		<div class="table-responsive">

			<button type="button" class="btn btn-info" onclick="location.href='index.php?pg=12'">
				Novo Local
			</button>

			<table class="table table-hover">
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
							<button onclick="excluir(<?php echo $linha['id']?>)">Excluir</button>
							<button onclick="location.href='index.php?pg=12&acao=a&id=<?php echo $linha['id']?>'">Alterar</button>
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
		var pag = "local/gravar-local.php?acao=e&id="+id;
		if (confirm("Tem certeza que deseja excluir este local?")){
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

