<div class="row row-offcanvas row-offcanvas-right">
	<div class="row">
		<div class="table-responsive">

			<button type="button" class="btn btn-info" onclick="location.href='index.php?pg=9'">
				Novo Posto Graduação
			</button>

			<table class="table table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>C&oacute;digo</th>
						<th>Ordem</th>
						<th>Sigla</th>
						<th>Nome</th>
						<th>Op&ccedil;&otilde;es</th>
					</tr>
				</thead>
				<tbody id="myTable">
					<?php 

					require_once 'conexao/conn.php';
                    
					$sql = "select * 
							from posto_graduacao p order by CAST(ordem as SIGNED) ";
					$rs = mysqli_query($conexao, $sql);
					$num = 0;

					while ($linha = mysqli_fetch_array($rs)) {
			           	 $num++;
			           	 ?>
					<tr>
						<td><?php echo $num?></td>
						<td><?php echo $linha['id']?></td>
						<td><?php echo $linha['ordem']?></td>
						<td><?php echo $linha['sigla']?></td>
						<td><?php echo $linha['nome']?></td>
						<td>
							<button class="btn btn-default" onclick="location.href='index.php?pg=9&acao=a&id=<?php echo $linha['id']?>'">
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
<div class="col-md-12 text-center">
	<ul class="pagination" id="myPager"></ul>
</div>
<script src="js/paginacao.js"></script>
<script>
	function excluir(id){
		var pag = "posto-graduacao/gravar-posto-graduacao.php?acao=e&id="+id;
		if (confirm("Tem certeza que deseja excluir este posto de graduação?")){
			location.href = pag;
		}
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

